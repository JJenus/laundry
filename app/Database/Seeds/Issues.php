<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Issues extends Seeder
{
	public function run()
	{
		
		$customers = (model("CustomerModel"))->findAll();
		$customerlen = count($customers);
		$staffs = (model("UserModel"))->findAll();
		$staffLen = count($staffs);
		$issueModel = model("IssuesModel");
		$issueModel->protect(false);
		
		$clothesModel = model("ClothesModel");
		$clothesModel->afterFind = [];
		
		for ($i = 10; $i > 0; $i--) {
		  $issueCount = random_int(0, 4);
		  for ($j = 0; $j < $issueCount; $j++) {
		    $staff = $staffs[random_int(0,$staffLen-1)];
		    $customer = $customers[random_int(0,$customerlen-1)];
		    $clothes = $clothesModel->select('id')
		              ->where("customer_id", $customer->realId())
                  ->findAll();
        if(empty($clothes))
          continue;
            $kount = count($clothes)-1>0 ? count($clothes)-1:count($clothes);
        $clothe = $clothes[random_int(0,$kount)];
		    $date = $this->customDate(date("Y-m-d h:i:s"), "-$i");
		    $data = [
    		  "title" => static::faker()->sentence, 
    		  "description" => static::faker()->paragraph, 
    		  "customer_id" => $customer->realId(), 
    		  "clothe_id" => $clothe->id, 
    		  "created_by" => $staff->id, 
    		  "updated_at" => $date, 
    		  "created_at" => $date
    		]; 
    		
    		if(!$issueModel->insert($data)){
    		  $this->log($issueModel->errors());
    		} 
		  } 
		}
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
              