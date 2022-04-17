<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\ClothesModel;
use App\Libraries\Encryptor;

class Customer extends Entity
{
	protected $datamap = [];
	protected $dates   = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $casts   = [];
	public $issues = null;
	
	public function getClothes()
  {
      if (empty($this->id))
      {
          throw new \RuntimeException('Customers must be created before getting clothes.');
      }

      if (empty($this->attributes["clothes"]))
      {
          $this->attributes["clothes"] = (new clothesModel())->getClothesForCustomer($this->id);
      }
      
      return $this->attributes["clothes"];
  }
                                                                                                                 
  
  public function getIssues(){
    /**
     * Address retrieving clothe issues
    */
    if (empty($this->id))
      {
          throw new \RuntimeException('Customers must be created before getting issues.');
      }

      if (empty($this->issues))
      {
          foreach ($this->clothes as $clothe){
            if(!empty($clothe->issues)){
              $this->issues[] = $clothe->issues;
            }
          }
      }

      return $this->issues;
  }
  
  /**
   *  always set the unmasked id
  */
  
  
  public function realId(){
    if(gettype($this->attributes["id"]) === "string")
      return (new Encryptor())->decode($this->attributes["id"]);
    return $this->attributes["id"];
  }
  
  
  public function init(){
    $this->getClothes();
    $this->getIssues();
    return $this;
  }
}
