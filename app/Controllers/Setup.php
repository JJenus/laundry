<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Entities\User;
use App\Libraries\Setting; 

class Setup extends BaseController
{
  use \Myth\Auth\AuthTrait;
  private $setup;
  
  private function getSetup(){
    $setup = [
        "installed"=> false,
        "migrated"=> false,
        "createGroups"=> false,
        "isAdminCreated"=> false,
        "createPermissions"=> false,
        "setupPermissions"=> false,
        "permissions"=> [
            [
                "permission"=> "app.admin",
                "description"=> "Super user with all possible actions in the app. Only available to admin user group. Which includes create user, change user roles, delete users, manage app, manage accounting and clothes, etc. ",
                "status"=> false
            ],
            [
                "permission"=> "app.manage",
                "description"=> "users with permissions to accounting, dispense clothes, and create new users.",
                "status"=> false
            ],
            [
                "permission"=> "app.accounts.manage",
                "description"=> "users with permission to all accounting data.",
                "status"=> false
            ],
            [
                "permission"=> "app.clothes.manage",
                "description"=> "users especially employees, with all permissions to handle clothes. Create, update, and delete rights.",
                "status"=> false
            ],
            [
                "permission"=> "app.clothes.wash",
                "description"=> "users with permission to wash and activate washed on clothes.",
                "status"=> false
            ],
            [
                "permission"=> "app.clothes.iron",
                "description"=> "users with permission to iron and activate ironed on clothes.",
                "status"=> false
            ],
            [
                "permission"=> "app.clothes.dispense",
                "description"=> "users with the express permission give out clothes to customers and activate dispensed on clothes.",
                "status"=> false
            ]
        ],
        "groups"=> [
            [
                "role"=> "admin",
                "description"=> "Super user",
                "status"=> false
            ],
            [
                "role"=> "manager",
                "description"=> "General overseer in the app affairs",
                "status"=> false
            ],
            [
                "role"=> "receptionist",
                "description"=> "Ability to receive, give out, and comfirm laundry operations.",
                "status"=> false
            ],
            [
                "role"=> "ironer",
                "description"=> "Charged with the task to iron",
                "status"=> false
            ],
            [
                "role"=> "washer",
                "description"=> "An employed washer\/cleaner",
                "status"=> false
            ]
        ]
    ]; 
    $this->setup = json_decode(json_encode ($setup));
  } 
  
  public function __construct(){
    $this->session = session();
    $this->config = config('Auth');
    
    $this->getSetup();
    
  }
  
	public function index()
	{
	  // check if setup is done already;
	  return view("setup");
	}
	
	public function backDoor()
	{
	  // check if setup is done already;
	  echo print_r((new Setting())->getCore());
	}
	
	public function isInstalled(){
	  return $this->setup->installed;
	}
	
	public function progress(){
	  if($this->setup->installed){
	    $this->session->set(
	      ["installed" => $this->setup] 
	    );
	  } 
	  
	  return isset($_SESSION["installed"])? (new Setting())->getCore() : $this->response->setJson($this->setup);
	}
	
	private function saveProcess(){
	  $this->session->set(
	      ["setup_launch" => $this->setup] 
	  );
	}
	
	
	public function install(){
	  /**
	   * check response codes for failed cases
	  */
	  return $this->response->setJSON($this->startProcess());
	}
	
	public function setupPermissions(){
	  if ($this->setup->setupPermissions)
	    return true;
	  #Give Admin permissions
		      foreach ($this->setup->permissions as $group) {
  		      if (!$this->authorize->addPermissionToGroup($group->permission, 'admin')) {
  		        return [
      	        "status" => "installed", 
      	        "error" => "Failed to setup admin privileges.", 
      	      ];
  		      }
		      }
		      $this->authorize->addPermissionToGroup("app.manage", 'manager');
		      $this->authorize->addPermissionToGroup("app.clothes.manage", 'manager');
		      $this->authorize->addPermissionToGroup("app.clothes.manage", 'receptionist');
		      $this->authorize->addPermissionToGroup("app.clothes.dispense", 'receptionist');
		      $this->authorize->addPermissionToGroup("app.clothes.wash", 'washer');
		      $this->authorize->addPermissionToGroup("app.clothes.iron", 'ironer');
		      $this->setup->setupPermissions = true;
		      $this->saveProcess();
		      return true;
	} 
	
	public function startProcess(){
	  $migrate = $this->migrate();
		if ($migrate===true) {
		  $this->setupAuthClasses();
		  if($this->createPermissions()){
		    if ($this->createUserGroups()) {
		      $s_perms = $this->setupPermissions();
		      if($s_perms !== true)
		        return $s_perms;
		      
		      model("Setup")->insert([
      	    "action" => "installed", 
      	    "status" => true, 
      	    "type" => "core",
      	    "description" => "core function"
      	  ]);
		      $this->saveProcess();
		      return [
		        "status" => "installed"
		      ];
		    }
		    return [
		        "status" => false, 
		        "error" => "Failed to setup user roles.", 
		      ];
		  }
	    return [
		        "status" => false, 
		        "error" => "Failed to setup app permissions.", 
		      ];
		}
		else {
		  return [
		        "status" => false, 
		        "message" => "migration error", 
		        "error" => $migrate, 
		      ]; 
		} 
	}
	
	private function resetProgress(){
	  #Rollback then
	  foreach ($this->setup as $key => $value) {
	    if ($key !== "groups" && $key !== "permissions") {
	      $this->setup->$key = false;
	    }else {
    	  foreach ($this->setup->$key as $ikey => $value) {
    	    $this->setup->$key[$ikey]->status = false;
    	  }
	    } 
	  }
	  $this->saveProcess();
	  return true ;
	} 
	
	public function reInstall(){
	  $this->setupAuthClasses();
	  if (!$this->authenticate->check()) {
	    return $this->response->setJson(["errors" =>["user isn't logged in."]]);
	  }
	  if(!$this->authorize->inGroup("admin", $this->authenticate->user()->id) ){
	    return $this->response->setJson(["errors" =>["user does not have admin privileges"]]);
	  }
	  
	  $this->resetProgress();
	  
	  if ($this->rollbackMigrate()) {
	    return $this->response->setJson($this->startProcess());
	  }
	  return $this->response->setJson(["errors" =>["failed"]]);
	}
	
	private function migrate(){
	  if ($this->setup->migrated)
	    return true;
	  $migrate = \Config\Services::migrations();
    try
    {
      if ($migrate->latest()) {
        $this->setup->migrated = true;
        $this->saveProcess();
        return true;
      } else {
       return "Unknown error occurred";
      }
    }
    catch (\Throwable $e)
    {
      return $e;
    } 
	}
	
	public function rollbackMigrate(){
	  $migrate = \Config\Services::migrations();
    try
    {
      if ($migrate->regress(0)) {
        return true;
      } else {
       return "Unknown error occurred";
      }
    }
    catch (\Throwable $e)
    {
      return $e;
    } 
	}
	
	public function backDoior(){
	  $res = $this->rollbackMigrate();
	  $html = "<h1>$res is cm</>";
	  return $html;
	} 
	
	private function createPermissions(){
	  if ($this->setup->createPermissions)
	    return true;
	    
	  $permissions = $this->setup->permissions;
	  
	  $errors = 0;
	  
	  foreach ($permissions as $key => $perm) {
	    if ($perm->status) {
	      continue;
	    }
      $id = $this->authorize->createPermission($perm->permission, $perm->description);
    	if($id){
    	  $permissions[$key]->status = true;
    	  model("Setup")->insert([
    	    "action" => $perm->permission, 
    	    "status" => true, 
    	    "type" => "permission",
    	    "description" => $perm->description 
    	  ]);
    	} else{
    	  $errors++;
    	}
	  }
	  
	  if ($errors === 0) {
      $this->setup->createPermissions = true;
      $this->setup->permissions = $permissions;
      $this->saveProcess();
      return true;
    }
    #$_SESSION['setup_create_permissions'] = $permissions;
    return false;
	}
	
	private function createUserGroups(){
	  if ($this->setup->createGroups)
	    return true;
	  
	  $userGroups = $this->setup->groups;
	  
	  if (isset($_SESSION['setup_create_groups'])) {
	    $userGroups = $_SESSION['setup_create_groups'];
	  }
	  
	  $errors = 0;
	  
	  foreach ($userGroups as $key => $group) {
	    if ($group->status) {
	      continue;
	    }
      $id = $this->authorize->createGroup($group->role, $group->description);
    	if($id){
    	  $userGroups[$key]->status = true;
    	  model("Setup")->insert([
    	    "action" => $group->role, 
    	    "status" => true, 
    	    "type" => "group",
    	    "description" => $group->description 
    	  ]);
    	} else{
    	  $errors++;
    	}
	  }
    	
    if ($errors === 0) {
      $this->setup->createGroups = true;
      model("Setup")->insert([
    	    "action" => "createGroups", 
    	    "status" => true, 
    	    "type" => "core",
    	    "description" => "core function"
    	  ]);
      return true;
    }
    $_SESSION['setup_create_groups'] = $userGroups;
    return false;
	}
	
	public function createAdmin()
	{
	  if($this->setup->isAdminCreated === true)
	    return $this->response->setJson([
	      "errors" => ["Admin has been already created."], 
	      'redirect' => route_to('login') 
	    ]);
		// Check if registration is allowed
	

		$users = model('UserModel');

		// Validate here first, since some things,
		// like the password, can only be validated properly here.
		$rules = [
			'name'	 	=> 'required',
			'username'  	=> 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
			'email'			=> 'required|valid_email|is_unique[users.email]',
			'password'	 	=> 'required',
			'pass_confirm' 	=> 'required|matches[password]',
		];

		if (! $this->validate($rules))
		{
			return $this->response->setJson(['errors' => service('validation')->getErrors(), "type" => "validation"]);
		}

		// Save the user
		$allowedPostFields = ['name', 'email', 'username', 'password'];
		if (!isset($_POST["image_url"])) {
		  $gender = $_POST["gender"] ?? "male";
		  $_POST["image_url"] = ($gender === "female") ? base_url(). "/assets/media/avatars/avatar-female.jpeg":base_url(). "/assets/media/avatars/avatar-male.jpeg";
		}
		$user = new User($this->request->getPost($allowedPostFields));
		
		$this->config->requireActivation !== false ? $user->generateActivateHash() : $user->activate();
		
		#adding group 
		$users = $users->withGroup("admin");

		if (!$users->save($user))
		{
			return $this->response->setJson(['errors' => $users->errors()]);
		}
		
		$this->setup->isAdminCreated = true;
		model("Setup")->insert([
    	    "action" => "isAdminCreated", 
    	    "status" => true, 
    	    "type" => "core",
    	    "description" => "core function"
    	  ]);
		// Success!
		return $this->response->setJson(['success' => lang('Auth.registerSuccess'), 'redirect' => route_to('login')]);
	}
}
                                                                                                                                                     #END OF <FILE></FILE>                           