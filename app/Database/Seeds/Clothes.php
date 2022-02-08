<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Clothes extends Seeder
{
  public $model;
  public $staffs = [
      "manager" => [], 
      "washer" => [], 
      "receptionist" => [], 
      "ironer" => [], 
    ];
  
	public function run()
	{
	  $this->model = model("ClothesModel");
	  $this->model->protect(false);
       
		$users = (model("UserModel"))->findAll();
		foreach ($users as $user){
		  foreach ($user->roles as $role) {
		    $this->staffs[$role][] = $user;
		  }
		} 
		
		$this->createClotheCategories();
		$this->clotheCategories = (model("ClotheCategories"))->findAll();
		
		$this->generateClothes();
		
	}
	
	private function generateClothes(){
	  $dateNow = date("Y-m-d H:i:s");
	  for($day = 65; $day >= 0; $day--){
	    $selectable_types = ["manager", "receptionist"];
	    $user_type = $selectable_types[random_int(0,1)];
	    
	    $rindex = random_int(0, count($this->staffs[$user_type])-1);
	    
	    $user = $this->staffs[$user_type][$rindex];
	    
	    $custom_date = $this->customDate($dateNow, "-$day");
	    $this->custom_date = $custom_date;
  	  $gCustomers = random_int(2,7);
      $this->log("$gCustomers customers to be created. @".date("Y-m-d h:i:s"));
      for ($j = 0; $j < $gCustomers; $j++) {
        #$this->log("creating customers @".date("Y-m-d h:i:s"));
           $customer_id = $this->createCustomer($user->id, $custom_date);
           $status = ["pending", "washed", "ironed", "ready", "dispensed"];
           
  	      if($customer_id !== false){
  	        $clotheCount = random_int(2,5); 
  	        $this->log("$clotheCount clothes to be created. @".date("Y-m-d h:i:s"));
      		  for ($k = 0; $k < $clotheCount; $k++) {
      		    $clothes = $this->model;
      		    $tIndex = random_int(0,(count($this->clotheCategories)-1));
      		    $type = $this->clotheCategories[$tIndex]->id;
      		    
      		    $clothe = [
      		      "customer_id" => $customer_id, 
      		      "type" => $type, 
      		      "actions" => "wash, iron", 
      		      "status" => $status[random_int(0,count($status)-1)], 
      		      "created_at" => $custom_date, 
      		      "updated_at" => $custom_date
      		    ];
      		    
      		   
      		    if (!$clothes->save($clothe)) {
      		      $this->log($clothes->errors());
      		    }else{
      		      $insertID = $clothes->insertID();
      		      
      		      if ($clothe["status"] === "dispensed") {
      		        $this->wash($insertID);
      		        $this->iron($insertID);
      		        $this->confirm($insertID);
      		        $this->dispense($insertID);
      		      } 
      		      else if($clothe["status"] === "ready") {
      		        $this->wash($insertID);
      		        $this->iron($insertID);
      		        $this->confirm($insertID); 
      		      }
      		      else if($clothe["status"] === "ironed") {
      		        $this->wash($insertID);
      		        $this->iron($insertID);
      		      }
      		      else if($clothe["status"] === "washed") {
      		        $this->wash($insertID);
      		      }
      		    }
      		  }
    		    $this->log("_________ __________ _____________ __________________\n");
      		}
      		else{
      		  $this->log("Unknown error in saving customer");
      		}
      }
	  } 
	} 
	
	public function createClotheCategories(){
	  $categories = [
          [
            "name"=>"Sweater",
            "cost" => 300
          ], 
          [
            "name"=>"Gown",
            "cost" => 250
          ], 
          
          [
            "name"=>"Hoodies",
            "cost" => 500
          ], 
          [
            "name"=>"T-shirt",
            "cost" => 200
          ], 
          [
            "name"=>"Flip-flops",
            "cost" => 100
          ], 
          [
            "name"=>"Shorts",
            "cost" => 200
          ], 
          [
            "name"=>"Skirt",
            "cost" => 200
          ], 
          [
            "name"=>"Jeans",
            "cost" => 250
          ], 
          [
            "name"=>"Shoes",
            "cost" => 350
          ], 
          [
            "name"=>"High heels",
            "cost" => 200
          ], 
          [
            "name"=>"Suit",
            "cost" => 1200
          ], 
          [
            "name"=>"Cap",
            "cost" => 150
          ], 
          
          [
            "name"=>"Socks",
            "cost" => 100
          ], 
          [
            "name"=>"Shirt",
            "cost" => 200
          ], 
          [
            "name"=>"Bra",
            "cost" => 150
          ], 
          [
            "name"=>"Scarf",
            "cost" => 100
          ], 
          [
            "name"=>"Swimsuit",
            "cost" => 200
          ], 
          [
            "name"=>"Hat",
            "cost" => 300
          ], 
          
          [
            "name"=>"Gloves",
            "cost" => 100
          ], 
          [
            "name"=>"Jacket",
            "cost" => 200
          ], 
          [
            "name"=>"Long coat",
            "cost" => 300
          ], 
          [
            "name"=>"Boots",
            "cost" => 400
          ], 
          [
            "name"=>"Bedsheets",
            "cost" => 900
          ], 
          [
            "name"=>"Tie",
            "cost" => 100
          ], 
          [
            "name"=>"Polo shirt",
            "cost" => 200
          ], 
          [
            "name"=>"Towel",
            "cost" => 500
          ], 
          [
            "name"=>"Leather jackets",
            "cost" => 250
          ], 
          
        ];
        
        $catsModel = model("ClotheCategories");
        $catsModel->protect(false);
      
      if(empty($catsModel->findAll())){
        foreach ($categories as $data){
          $data["created_at"] = date("Y-m-d h:i:s");
          $data["updated_at"] = date("Y-m-d h:i:s");
          
          $catsModel->insert($data);
        } 
      } 
        
	}
	
	public function dispense($clothe_id){
	 # $clothe_id = $this->getId($clothe_id);
	  $days = random_int(3,6);
	  $date = $this->customDate($this->custom_date, "+$days");
	  $data = [
	      "dispensed_by" => $this->staffs["receptionist"][random_int(0,count($this->staffs["receptionist"])-1)]->id, 
	      "status" => "dispensed", 
	      "updated_at" => $date, 
	   ];
	  
	  $this->model
	       ->update($clothe_id, $data);
	       
	  $this->setActivity("dispensed_at", $clothe_id, $date);
  	   
  	  
    return true; 
	}
	
	public function wash($clothe_id){
	  /**
	   * check CI docs for better update
	   * queries 
	  */
	  $days = random_int(0,1);
	  $date = $this->customDate($this->custom_date, "+$days");
	  $data = [
	      "washer" => $this->staffs["washer"][random_int(0,count($this->staffs["washer"])-1)]->id, 
	      "status" => "washed", 
	      "updated_at" => $date, 
	   ];
	  
	  $this->model
	       ->update($clothe_id, $data);
	       
    $this->setActivity("washed_at", $clothe_id, $date);
  	  
  	return true;
	} 
	
	public function iron($clothe_id){
	  #$clothe_id = $this->getId($clothe_id);
	  $days = random_int(2,3);
	  $date = $this->customDate($this->custom_date, "+$days");
	  $data = [
	      "ironer" => $this->staffs["ironer"][random_int(0,count($this->staffs["ironer"])-1)]->id, 
	      "status" => "ironed", 
	      "updated_at" => $date, 
	   ];
	  
	  $this->model
	       ->update($clothe_id, $data);
	              
	  $this->setActivity("ironed_at", $clothe_id, $date);
  	  
  	 return true; 
	}
	
	public function confirm($clothe_id){
	  $opt = ["receptionist", "manager"];
	  $selected = $opt[random_int(0,1)]; 
	  $days = random_int(2,3);
	  $date = $this->customDate($this->custom_date, "+$days");
	  $data = [
	      "confirmed_by" => $this->staffs[$selected][random_int(0,count($this->staffs[$selected])-1)]->id, 
	      "status" => "ready", 
	      "updated_at" => $date, 
	   ];
	   
	  $this->model
          ->update($clothe_id, $data);
	              
	  $this->setActivity("ready_at", $clothe_id, $date);
  	 return true;
	} 
	
	private function setActivity($action, $clothe_id, $date){
	   $activities = model("ClotheActivities");
	   $activities->protect(false);
	   
	   if (empty($activities->where("clothe_id", $clothe_id)->findAll())) {
  	    $activities->insert(
    	     [
    	       "clothe_id"=> $clothe_id, 
    	       "$action"=>date("Y-m-d h:i:s"), 
    	       "created_at" => $date, 
    	       "updated_at" => $date, 
    	     ]
  	    );
  	  }else {
	      $activities
	         ->set("$action", date("Y-m-d h:i:s"))
	         ->set("updated_at", $date)
	         ->where("clothe_id", $clothe_id)
	         ->where("$action", null)
	         ->update();
  	  }
	} 
	
	private function createCustomer($createdBy, $date){
	  $type = ["admin", "vip", "regular"];
	  $totalAmount = random_int(200,5000);
	  $amountPaid = random_int(0, 5000);
	  $balance = $totalAmount - $amountPaid;
	  $acc_type = $balance > 0 ? "debt":"credit";
	 
	  $number = static::faker()->phoneNumber;
	  
	  $customer = [
	      "created_by" => $createdBy, 
	      "status" => "pending", 
	      "total_cost" => $totalAmount, 
	      "phone_number" => $number, 
	      "amount_paid" => $amountPaid, 
	      $acc_type => $balance < 0 ? $balance*-1:$balance,
	      "name" => static::faker(['it_IT', 'en_US', 'de_DE'])->name, 
	      "type" => $type[random_int(0, count($type)-1)], 
	      "created_at" => $date, 
	      "updated_at" => $date, 
	   ];
	   
	   $customers = model("CustomerModel");
	   $customers->protect(false);
	   
	   if(!$customers->save($customer)){
	     $this->log("Failed to create customer");
	     $this->log($customers->errors());
	     return false; 
	   }
	   $this->log("customer created @".date("Y-m-d h:i:s"));
	   $this->customer = $customer;
	   return $customers->insertID();
	}
	
	public function customDate($date, $days){
	  $randDate = new \DateTime($date);
	  $randDate->modify("$days day");
    $randDate->setTime(mt_rand(7, 21), mt_rand(0, 59));
    return $randDate->format('Y-m-d H:i:s');
	} 
	
	private function log($data){
	  if (gettype($data) === "array") {
	    $txt = "";
	    foreach ($data as $value)
	      $txt .= $value."\n";
	    $data = $txt;
	  }
	  $log = fopen(WRITEPATH."setup/logs.log", "a+");
	  fwrite($log, "\n\n".$data);
	  fclose($log);
	} 
}
