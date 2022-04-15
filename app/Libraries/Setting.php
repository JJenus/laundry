<?php
namespace App\Libraries;

class Setting{
  private $groups = [];
  private $permissions = [];
  private $core = [];
  
  public function __construct(){
    #do nothing 
  } 
  
  public function exists(){
    $db = \Config\Database::connect();
    if(!$db->tableExists("setup")) 
      return null;
  } 
  
  public function getGroups($force=false):object
  {
    if(empty($this->groups) || $force){
      $groups = (model("Setup"))->where("type = ", "group")->findAll();
      
      foreach ($groups as $val){
        $this->groups[$val->action] = $val->status;
      } 
    }
    return json_decode(json_encode($this->groups));
  } 
  
  public function getPermissions($force=false):object
  {
    if(empty($this->permissions) || $force){
      $perms = (model("Setup"))->where("type = ", "permission")->findAll();
      foreach ($perms as $val){
        $this->permissions[$val->action] = $val->status;
      } 
    }
    return json_decode(json_encode($this->permissions));
  } 
  
  public function getCore($force=false):object
  {
    if(empty($this->core) || $force){
      $core = (model("Setup"))->where("type = ", "core")->findAll();
      foreach ($core as $val){
        $this->core[$val->action] = $val->status;
      } 
    }
    return json_decode(json_encode($this->core));
  } 
  
} 
                                                                                          