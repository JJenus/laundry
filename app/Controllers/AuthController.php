<?php namespace App\Controllers;

use Config\Email;
use CodeIgniter\Controller;
use Myth\Auth\Entities\User;
use CodeIgniter\Database\Seeder\Faker;
use App\Libraries\Setting;

class AuthController extends Controller
{
  
	protected $auth;
	/**
	 * @var Auth
	 */
	protected $config;

	/**
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	public function __construct()
	{
		// Most services in this controller require
		// the session to be started - so fire it up!
		$this->session = service('session');

		$this->config = config('Auth');
		$this->auth = service('authentication');
		$this->authorize = service('authorization');
		
	}
	
	
	//--------------------------------------------------------------------
	// Login/out
	//--------------------------------------------------------------------

	/**
	 * Displays the login form, or redirects
	 * the user to their destination/home if
	 * they are already logged in.
	 */
	public function login()
	{
	  /*$setup = (new Setting());
		if(!$setup || !isset($setup->getCore()->isAdminCreated) || !isset($setup->getCore()->installed))
		  return redirect()->route("setup");
		*/
		// No need to show a login form if the user
		// is already logged in.
		if ($this->auth->check()){
			#$redirectURL = session('redirect_url') ?? '/';
			$redirectURL = '/';
			unset($_SESSION['redirect_url']);
			return redirect()->to($redirectURL);
		}
        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? '/';

		return view($this->config->views['login'], ['config' => $this->config]);
	}

	/**
	 * Attempts to verify the user's credentials
	 * through a POST request.
	 */
	public function attemptLogin()
	{
		$rules = [
			'login'	=> 'required',
			'password' => 'required',
		];
		if ($this->config->validFields == ['email'])
		{
			$rules['login'] .= '|valid_email';
		}

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$login = $this->request->getPost('login');
		$password = $this->request->getPost('password');
		$remember = (bool)$this->request->getPost('remember');

		// Determine credential type
		$type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		// Try to log them in...
		if (! $this->auth->attempt([$type => $login, 'password' => $password], $remember))
		{
			return redirect()->back()->withInput()->with('error', $this->auth->error() ?? lang('Auth.badAttempt'));
		}

		// Is the user being forced to reset their password?
		if ($this->auth->user()->force_pass_reset === true)
		{
			return redirect()->to(route_to('reset-password') .'?token='. $this->auth->user()->reset_hash)->withCookies();
		}
		$userId = $this->auth->id();
		$url = ($this->authorize->inGroup("admin", $userId) || $this->authorize->hasPermission("app.manage", $userId) ) ? route_to("app/dashboard/overview"):
		       ($this->hasPermissions($userId)? route_to("app/main/") : route_to("app/laundry/"));
		#$redirectURL = session('redirect_url') ?? $url ?? '/';
		$redirectURL = $url ?? '/';
		unset($_SESSION['redirect_url']);
		
		return redirect()->to($redirectURL)->withCookies()->with('message', lang('Auth.loginSuccess'));
	}
	
	public function hasPermissions($user_id){
	  $perms = [
	      "app.clothes.dispense",
	      "app.clothes.manage"
	   ];
	  foreach ($perms as $perm){
	    if ($this->authorize->hasPermission($perm, $user_id)) {
	      return true;
	    }
	  }
	  return false;
	} 
                                                                                                                                                                                                                        
	/**
	 * Log the user out.
	 */
	public function logout()
	{
		if ($this->auth->check())
		{
			$this->auth->logout();
		}

		return redirect()->to('login');
	}

	//--------------------------------------------------------------------
	// Register
	//--------------------------------------------------------------------

	/**
	 * Displays the user registration page.
	 */
	public function register()
	{
        // check if already logged in.
		if ($this->auth->check())
		{
			return redirect()->back();
		}

        // Check if registration is allowed
		if (! $this->config->allowRegistration)
		{
			return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
		}

		return view($this->config->views['register'], ['config' => $this->config]);
	}
	
	public function generateId(){
	  $faker = \Faker\Factory::create();
	  
	  while(true){
  	  $id = $faker->word . $faker->randomDigitNotNull . $faker->randomDigit;
  	  $res = (model("UserModel"))
  	          ->where("username", $id)
  	          ->findAll();
  	  if (empty($res)) {
  	    break;
  	  }
	  } 
	  
  	return $this->response->setJson([
  	    "id" => $id
  	  ]);
	} 
	
	public function checkAvailability(){
	  $id = $this->request->getGet("id");
	  $field = $this->request->getGet("field");
	  
	  $res = (model("UserModel"))
  	          ->where($field, $id)
  	          ->findAll();
  	if (empty($res)) {
  	  return $this->response->setJson([
  	    "id" => $id
  	  ]);
  	}
  	return $this->response->setJson([
  	  "message" => $field=="email"? "Email already exists" :"Username is taken"
  	]); 
	} 
	/**
	 * Attempt to register a new user.
	 */
	public function attemptRegister()
	{
		// Check if registration is allowed
		if (! $this->config->allowRegistration)
		{
			return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
		}

		$users = model('UserModel');

		// Validate here first, since some things,
		// like the password, can only be validated properly here.
		$rules = [
			'username'  	=> 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
			'email'			=> 'required|valid_email|is_unique[users.email]',
			'password'	 	=> 'required',
			#'pass_confirm' 	=> 'required|matches[password]',
		];
		

		if (! $this->validate($rules))
		{
		  return $this->response->setJson(["errors"=> service('validation')->getErrors()]);
		}

		// Save the user
		$allowedPostFields = array_merge(["password"], $this->config->validFields, $this->config->personalFields);
		$user = new User($this->request->getPost($allowedPostFields));
		if (!$user->image_url) {
		  $user->{'image_url'} = $user->gender === "female" ? base_url(). "/assets/media/avatars/avatar-female.jpeg" : base_url(). "/assets/media/avatars/avatar-male.jpeg";
		}

		$this->config->requireActivation !== false ? $user->generateActivateHash() : $user->activate();

		// Ensure default group gets assigned if set
        $this->config->defaultUserGroup = $this->request->getPost("role");
        if (! empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

		if (! $users->save($user))
		{
			return  $this->response->setJson(["errors"=> $users->errors()]);
		}

		if ($this->config->requireActivation !== false)
		{
			$activator = service('activator');
			$sent = $activator->send($user);

			if (! $sent)
			{
				return $this->response->setJson(["errors"=> $activator->error() ?? lang('Auth.unknownError')]);
			}

			// Success!
			return $this->response->setJson(["message"=> lang('Auth.activationSuccess')]);
		}

		// Success!
		return $this->response->setJson(["message"=> lang('Auth.registerSuccess')]);
	}

	//--------------------------------------------------------------------
	// Forgot Password
	//--------------------------------------------------------------------

	/**
	 * Displays the forgot password form.
	 */
	public function forgotPassword()
	{
		if ($this->config->activeResetter === false)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		return view($this->config->views['forgot'], ['config' => $this->config]);
	}

	/**
	 * Attempts to find a user account with that password
	 * and send password reset instructions to them.
	 */
	public function attemptForgot()
	{
		if ($this->config->activeResetter === false)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		$users = model('UserModel');

		$user = $users->where('email', $this->request->getPost('email'))->first();

		if (is_null($user))
		{
			return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
		}

		// Save the reset hash /
		$user->generateResetHash();
		$users->save($user);

		$resetter = service('resetter');
		$sent = $resetter->send($user);

		if (! $sent)
		{
			return redirect()->back()->withInput()->with('error', $resetter->error() ?? lang('Auth.unknownError'));
		}

		return redirect()->route('reset-password')->with('message', lang('Auth.forgotEmailSent'));
	}

	/**
	 * Displays the Reset Password form.
	 */
	public function resetPassword()
	{
		if ($this->config->activeResetter === false)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		$token = $this->request->getGet('token');

		return view($this->config->views['reset'], [
			'config' => $this->config,
			'token'  => $token,
		]);
	}

	/**
	 * Verifies the code with the email and saves the new password,
	 * if they all pass validation.
	 *
	 * @return mixed
	 */
	public function attemptReset()
	{
		if ($this->config->activeResetter === false)
		{
			return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
		}

		$users = model('UserModel');

		// First things first - log the reset attempt.
		$users->logResetAttempt(
			$this->request->getPost('email'),
			$this->request->getPost('token'),
			$this->request->getIPAddress(),
			(string)$this->request->getUserAgent()
		);

		$rules = [
			'token'		=> 'required',
			'email'		=> 'required|valid_email',
			'password'	 => 'required|strong_password',
			'pass_confirm' => 'required|matches[password]',
		];

		if (! $this->validate($rules))
		{
			return redirect()->back()->withInput()->with('errors', $users->errors());
		}

		$user = $users->where('email', $this->request->getPost('email'))
					  ->where('reset_hash', $this->request->getPost('token'))
					  ->first();

		if (is_null($user))
		{
			return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
		}

        // Reset token still valid?
        if (! empty($user->reset_expires) && time() > $user->reset_expires->getTimestamp())
        {
            return redirect()->back()->withInput()->with('error', lang('Auth.resetTokenExpired'));
        }

		// Success! Save the new password, and cleanup the reset hash.
		$user->password 		= $this->request->getPost('password');
		$user->reset_hash 		= null;
		$user->reset_at 		= date('Y-m-d H:i:s');
		$user->reset_expires    = null;
        $user->force_pass_reset = false;
		$users->save($user);

		return redirect()->route('login')->with('message', lang('Auth.resetSuccess'));
	}

	/**
	 * Activate account.
	 *
	 * @return mixed
	 */
	public function activateAccount()
	{
		$users = model('UserModel');

		// First things first - log the activation attempt.
		$users->logActivationAttempt(
			$this->request->getGet('token'),
			$this->request->getIPAddress(),
			(string) $this->request->getUserAgent()
		);

		$throttler = service('throttler');

		if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false)
        {
			return service('response')->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));
        }

		$user = $users->where('activate_hash', $this->request->getGet('token'))
					  ->where('active', 0)
					  ->first();

		if (is_null($user))
		{
			return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));
		}

		$user->activate();

		$users->save($user);

		return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
	}

	/**
	 * Resend activation account.
	 *
	 * @return mixed
	 */
	public function resendActivateAccount()
	{
		if ($this->config->requireActivation === false)
		{
			return redirect()->route('login');
		}

		$throttler = service('throttler');

		if ($throttler->check($this->request->getIPAddress(), 2, MINUTE) === false)
		{
			return service('response')->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));
		}

		$login = urldecode($this->request->getGet('login'));
		$type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		$users = model('UserModel');

		$user = $users->where($type, $login)
					  ->where('active', 0)
					  ->first();

		if (is_null($user))
		{
			return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));
		}

		$activator = service('activator');
		$sent = $activator->send($user);

		if (! $sent)
		{
			return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
		}

		// Success!
		return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));

	}
}
