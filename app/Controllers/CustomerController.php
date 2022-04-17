<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Entities\Customer;
use App\Libraries\Encryptor;

class CustomerController extends BaseController
{
	use \Myth\Auth\AuthTrait;
	
	public function __construct()
	{
		$this->model = new CustomerModel();
		$this->setupAuthClasses();
	}
	
	public function index(){
	  $offset = $this->request->getVar("offset") ?? 0;
	  $limit = $this->request->getVar("limit")  ?? 50;
	  
	  return $this->response->setJson ($this->model->getCustomers($limit, $offset)); 
	}
	
	public function create()
	{
		$rules = [
		    "clothes" => "required", 
		    "name" => "required", 
		    "type" => "required",
	      "total_cost" => "required", 
	      "amount_paid" => "required",
		  ];
		  
		if (! $this->validate($rules))
		{
			return $this->response->setJson($this->validator->getErrors());
		}
		
		$allowedFields = $this->model->allowedFields;
		$customer = $this->request->getPost($allowedFields);
		$customer["created_by"] = $this->authenticate->user()->id;
		$customer["status"] = "pending";
		
		if(!$this->model->insert($customer)){
		  return $this->response->setJson($this->model->errors());
		}
		$customer_id = $this->model->insertID;
	
		$clothesModel = model("ClothesModel");
		$clothes = $this->request->getPost("clothes");
		foreach($clothes as $key => $clothe){
		  $clothes[$key]["created_by"] = $this->authenticate->user()->id;
		  $clothes[$key]["customer_id"] = $customer_id;
		  $clothes[$key]["status"] = "pending";
		  for ($i = 0; $i < $clothe["quantity"]; $i++) {
		    $clothes[$key]["actions"] = "wash, iron";
		     if(!$clothesModel->save($clothes[$key])){
		       return $this->response->setJson(
    		     [
    		       "status" => false, 
    		       "errors" => $clothesModel->errors()
    		     ] 
      		 );
		     } 
		  }
		}
		$cs = $this->model->find($customer_id);
		return $this->response->setJson(
		  [
		    "status" => "ok", 
		    "data" => $cs
		  ] 
		);
		#return $this->response->setJson($clothes);
	}
	
	public function dispense($customer_id){
	  $customer_id = $this->getId($customer_id);
	  $clothesModel = model("ClothesModel");
	  
	  if (
	   !$clothesModel
       ->set("dispensed_by", $this->authenticate->user()->id)
       ->set("status", "dispensed")
       ->where("customer_id", $customer_id)
       ->where("dispensed_by", null)
       ->update()
	   ) {
	    return $this->request->setJSON($clothesModel->errors());
	  }
	 
	  $allClothes = $clothesModel->select("id")
	                ->where("customer_id", $customer_id)
	                ->findAll();
	  $activities = model("ClotheActivities");
	  foreach($allClothes as $clothe){
  	  if (empty($activities->where("clothe_id", $clothe->id)->findAll())) {
  	    $activities->insert(
    	     [
    	       "clothe_id"=>$clothe->id, 
    	       "dispensed_at"=>date("Y-m-d h:i:s"), 
    	     ]
  	    );
  	  } else {
	      $activities
	         ->set("dispensed_at", date("Y-m-d h:i:s"))
	         ->where("clothe_id", $clothe->id)
	         ->where("dispensed_at", null)
	         ->update();
  	  } 
	  }
	  $this->model
	       ->update($customer_id, ["status" => "dispensed"]);
	 
	  return $this->response->setJSON(["status"=>"success", "data"=>$this->model->getCustomer($customer_id)]);                            
	}
	
	/**
	 * Get customer with masked id:
	 * unmask id and query db;
	 * *** WORKING VERSION ***
	*/
	public function getCustomer($customer_id){
	  $customer_id = $this->getId($customer_id);
	  $customer = (model("CustomerModel"))->find($customer_id);
	  if (empty($customer)) {
	    return $this->response->setJson([]);
	  }
    $customer->clothes = $customer->getClothes();
	  
	  return $this->response->setJson($customer);
	}
	
	/**
	 * currently redundant 
	*/
	public function getClothes($customer_id){
	  $customer = new Customer();
	  $customer->id = $customer_id;
	  return $this->response->setJson($customer->clothes);
	}
	
	public function update($id){
	  
		$allowedFields =  $this->model->allowedFields;
		
		$fields = $this->request->getPost();
		$id = $this->getId($id);
		$fields["id"] = $id;
		
		if(!$this->model->update($id, $fields)){
		  return $this->response->setJson($this->model->errors());
		}
		return $this->response->setJson(["status"=>"success", "data"=>$this->model->getCustomer($id)]);
	}
	
	public function delete($customer_id){
	  $customer_id = $this->getId($customer_id);
	  if(!$this->model->delete($customer_id)) {
        return $this->response->setJson($this->model->errors());
	  }
	  return $this->response->setJson(["success"]);
	}
	
	private function getId($id){
	  return (new Encryptor())->decode($id);
	}
	
	public function customDate($date, $count, $type){
	  $randDate = new \DateTime($date);
	  $randDate->modify("$count $type");
    return $randDate->format('Y-m-d H:i:s');
	} 
	
	public function lastMonths(){

	    $sdate = $this->customDate(date("Y-m-1 00:00:00"), "-4", "month");
	    
	    $res = $this->model
	                 ->select("strftime('%m', created_at) as month")
	                 ->selectSum("total_cost")
	                 ->where("created_at >=", $sdate)
	                 ->groupBy("strftime('%m', created_at)")
	                 ->orderBy("created_at")
	                 ->findAll();
	    $expenses = (model("ExpensesModel"))
	                 ->select("strftime('%m', created_at) as month")
	                 ->selectSum("cost")
	                 ->where("created_at >=", $sdate)
	                 ->groupBy("strftime('%m', created_at)")
	                 ->orderBy("created_at")
	                 ->findAll();
      foreach ($res as $key => $value) {
        $res[$key]->expenses = 0;
        foreach($expenses as $val) {
          if ($value->month == $val->month) {
            $res[$key]->expenses = $val->cost;
            break;
          }
        }
        $str = "2022-$value->month-1";
        $date = new \DateTime($str);
        $res[$key]->month = $date->format("F");
      }
	  return $this->response->setJson($res);
	} 
	
	public function inRange(){
	  $offset = $this->request->getVar("offset") ?? 0;
	  $limit = $this->request->getVar("limit")  ?? 50;
	  
	  $range = $this->request->getVar("range") ?? "today";
	  
	  if ($range === "today") {
	    $today = date("Y-m-d 00:00:00");
	    $res = $this->model
	         ->where("updated_at >=", $today) 
	         ->findAll();
	  }
	  elseif ($range === "this_week") {
	    $start = date("Y-m-d 00:00:00");
	    $end = date("Y-m-d 23:59:59");
	  }
	  else if ($range === "this_month") {
	    $start = date("Y-m-d 00:00:00");
	    $end = date("Y-m-d 23:59:59");
	  }
	  if ($range === "this_year") {
	    $start = date("Y-m-d 00:00:00");
	    $end = date("Y-m-d 23:59:59");
	  }
	  if ($range === "last_year") {
	    $start = date("Y-m-d 00:00:00");
	    $end = date("Y-m-d 23:59:59");
	  }
	  
	  return $this->response->setJson($res);
	}
	
}
                                                                                             
