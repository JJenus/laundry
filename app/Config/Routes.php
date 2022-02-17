<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
 $routes->addRedirect("/", "app/main");
 $routes->addRedirect("app/dashboard", "app/dashboard/overview");
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group("app", ['filter' => 'login:admin,manager,receptionist,ironer,washer'], function($app){
  $app->addRedirect("/", "app/main");
  $app->get('main', 'App::index', ['filter' => 'role:admin,manager,receptionist']);
  $app->get('trial', 'App::trials');
  $app->get('laundry', 'App::laundry');
  $app->get('user', 'App::user');
  $app->get('help', 'App::help');
  $app->get('about', 'App::about');
  $app->group("hire", ['filter' => 'role:admin,manager'], function($hire){
    $hire->get('generateId', 'AuthController::generateId');
    $hire->get('checkAvailability', 'AuthController::checkAvailability');
  });
  $app->group("dashboard", ['filter' => 'role:admin,manager'], function($dashboard){
    $dashboard->addRedirect("/", "app/dashboard/overview");
    $dashboard->get("(:any)", "App::dashboard/$1");
  });
});

$routes->group("staffs", ['filter' => 'login'], function($route){
  $route->get("", "Staffs::index");
  $route->post("(:num)/update", "Staffs::update/$1");
  $route->get("(:segment)", "Staffs::staff/$1");
  $route->get("(:num)/report", "Staffs::report/$1");
});

$routes->get("auth/user", "AuthController::user");

/**
 *   Improve/update the filters 
 *   when app is fully developed 
*/
$routes->group("customers", ["filter"=>"login"], function($route){
  $route->get("/", "CustomerController::index");
  $route->post("/", "CustomerController::create");
  $route->get("range", "CustomerController::inRange");
  $route->get("lastmonths", "CustomerController::lastMonths");
  $route->get("(:segment)", "CustomerController::getCustomer/$1");
  $route->post("(:segment)/update", "CustomerController::update/$1");
  $route->get("(:segment)/delete", "CustomerController::delete/$1");
  $route->get("(:segment)/dispense", "CustomerController::dispense/$1");
});

$routes->match(
  ['get', 'post'], 
  "search/(:segment)", 
  "Search::search/$1"
);

$routes->group("issues", ['filter' => 'login'], function($route){
  $route->get("/", "Issues::index");
  $route->post("/", "Issues::create", ['filter' => 'permission:app.manage,app.clothes.manage,app.accounts.manage']);
  $route->post("update", "Issues::update", ['filter' => 'permission:app.manage,app.clothes.manage,app.accounts.manage']);
  $route->get("stats", "Issues::statistics");
  $route->get("(:segment)/delete", "Issues::delete", ['filter' => 'role:admin']);
});

$routes->group("accounts", ['filter' => 'login'], function($route){
  $route->get("/", "Accounts::index");
  $route->post("/", "Accounts::create", ['filter' => 'permission:app.manage,app.accounts.manage']);
  $route->get("stats", "Accounts::statistics");
  $route->get("(:segment)/delete", "Accounts::delete", ['filter' => 'role:admin']);
});

$routes->group("expenses", ['filter' => 'login'], function($route){
  $route->get("/", "Expenses::index");
  $route->post("/", "Expenses::create", ['filter' => 'permission:app.manage,app.clothes.manage,app.accounts.manage']);
  $route->post("edit", "Expenses::update", ['filter' => 'permission:app.manage,app.clothes.manage,app.accounts.manage']);
  $route->get("(:segment)/delete", "Expenses::delete", ['filter' => 'role:admin']);
  $route->get("range", "Expenses::inRange");
});

$routes->group("clothes", ['filter' => 'login'], function($route){
  $route->group("categories", function($route){
    $route->post("new", "Clothes::newCategory");
    $route->get("", "Clothes::categories");
    $route->post("update", "Clothes::updateCategory");
  });
  $route->get("stats/(:segment)", "Clothes::stats/$1");
  $route->get("(:segment)/wash", "Clothes::wash/$1", ["filter"=>"permission:app.clothes.manage,app.clothes.wash"]);
  $route->get("(:segment)/iron", "Clothes::iron/$1", ["filter"=>"permission:app.clothes.manage,app.clothes.iron"]);
  $route->get("(:segment)/confirm", "Clothes::confirm/$1", ["filter"=>"permission:app.clothes.manage"]);
  $route->get("(:segment)/dispense", "Clothes::dispense/$1", ["filter"=>"permission:app.clothes.manage,app.clothes.dispense"]);
});

$routes->group("setup", function($route){
  $route->get("/", "Setup::index");
  $route->post("install", "Setup::install");
  $route->post("reinstall", "Setup::reInstall");
  $route->post("create-admin", "Setup::createAdmin");
  $route->get("progress", "Setup::progress");
  $route->get("rollback", "Setup::backDoor");
});

$routes->group('',function($routes) {
    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
