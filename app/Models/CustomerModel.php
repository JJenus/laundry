<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Customer;
use App\Libraries\Encryptor;

class CustomerModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'customers';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = Customer::class;
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
	    "created_by", "name", "type", 
	    "status", "amount_paid", "total_cost", 
	    "credit", "debt", "phone_number", 
	    "created_by"
	  ];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
	    "created_by" => "required|numeric",
	    "name" => "required", 
	    "type" => "required",
	    "total_cost" => "required", 
	    "amount_paid" => "required",
	  ];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	
	public function getCustomer($id){
	  $customer =  $this->find($id);
	  if (empty($customer)) {
	    return [];
	  }
	  $customer->getClothes();
	  
	  return $customer;
	}
	
	public function getCustomersLike($search, $limit, $offset){
	  $id = (new Encryptor ())->decode($search);
	  $customers = $this
	              ->like("name", $search)
	              ->orlike("total_cost", $search)
	              ->orlike("amount_paid", $search)
	              ->orlike("credit", $search)
	              ->orlike("debt", $search)
	              ->orlike("id", $id)
	              ->orderBy('id', 'ASC')
	              ->findAll($limit, $offset);
	              
	  foreach ($customers as $key => $customer){
	    $customers[$key]->getClothes();
	  }
	  
	  return $customers; 
	}
	
	public function getCustomers($limit=null, $offset=null){
	  
	  $customers = $this->orderBy('id', 'ASC')
	              ->findAll($limit, $offset);
	  
	  foreach ($customers as $key => $customer){
	    $customers[$key]->getClothes();
	  }
	  
	  return $customers;
	}
	
	public function getCustomersInRange($startDate, $endDate, $limit, $offset){
	  $customers = $this->where("created_at >= ", $startDate)
	               ->where("created_at <=", $endDate)
	               ->orderBy('id', 'ASC')
	               ->findAll($limit, $offset);
	  
	  foreach ($customers as $key => $customer){
	    $customers[$key]->getClothes();
	  }
	  
	  return $customers;
	}
}
