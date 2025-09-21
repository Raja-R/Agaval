<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Welcome', 'Home::welcome');

$routes->get('update_member/(:num)', 'Register::index', ['filter' => 'basicauth']);
$routes->get('Dashboard', 'Dashboard::index', ['filter' => 'basicauth']);
//$routes->get('Customer', 'Customer::index', ['filter' => ['basicauth','permission']]);

$routes->group('User', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'User::index');
    $routes->get('list', 'User::index');
    $routes->get('user_list', 'User::user_list');
    $routes->get('role', 'User::role');
    $routes->get('add_role', 'User::add_role');
    $routes->get('role_list', 'User::role_list');
    $routes->get('role_list', 'User::role_list');
    $routes->get('permission', 'User::permission');
    $routes->get('permission', 'User::permission');
    $routes->get('add_permission', 'User::add_permission');
    $routes->get('permission_list', 'User::permission_list');
    $routes->get('add', 'User::add_user');
    $routes->get('role_permission', 'User::role_permission');
    $routes->get('role_permission/(:num)', 'User::role_permission');
});

$routes->group('Customer', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Customer::index');
    $routes->get('list', 'Customer::customer_list');
    $routes->get('add', 'Customer::add_customer');
    $routes->post('add', 'Customer::save_customer');
    $routes->get('update/(:num)', 'Customer::update_customer');
    $routes->get('view/(:num)', 'Customer::view_customer');
    $routes->get('delete/(:num)', 'Customer::delete_customer');
    $routes->get('delete', 'Customer::delete_customer');
});

$routes->group('Suppliers', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Suppliers::index');
    $routes->get('list', 'Suppliers::customer_list');
    $routes->get('add', 'Suppliers::add_customer');
    $routes->post('add', 'Suppliers::save_customer');
    $routes->get('update/(:num)', 'Suppliers::update_customer');
    $routes->get('view/(:num)', 'Suppliers::view_customer');
    $routes->get('delete/(:num)', 'Suppliers::delete_customer');
    $routes->get('delete', 'Suppliers::delete_customer');
});

$routes->group('Site', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Site::index');
    $routes->get('profile', 'Site::profile');
    $routes->get("application", "Site::index");
    $routes->get("tax", "Site::tax");
    $routes->get("units", "Site::units");

    $routes->get("tax_list", "Site::tax_list");
    $routes->get("unit_list", "Site::unit_list");

    $routes->post("update_setting", "Site::update_setting");
    $routes->post("update_profile", "Site::update_profile");

    $routes->post("add_tax", "Site::add_tax");
    $routes->post("add_unit", "Site::add_unit");

    $routes->post("view_tax", "Site::view_tax");
    $routes->post("view_unit", "Site::view_unit");

    $routes->post("delete_tax", "Site::delete_tax");
    $routes->post("delete_unit", "Site::delete_unit");
});

$routes->group('Expenses', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Expenses::index');
    $routes->get('list', 'Expenses::expense_list');
    $routes->get('add', 'Expenses::add_expense');
    $routes->post('add', 'Expenses::save_expense');
    $routes->get('update/(:num)', 'Expenses::update_expense');
    $routes->get('view/(:num)', 'Expenses::view_expense');
    $routes->get('delete/(:num)', 'Expenses::delete_expense');
    $routes->get('delete', 'Expenses::delete_expense');
    $routes->get('category', 'Expenses::category');
    $routes->get('category_list', 'Expenses::category_list');
    $routes->get('category_add', 'Expenses::category_add');
    $routes->post('save_category', 'Expenses::save_category');
    $routes->get('category_update/(:num)', 'Expenses::category_update');
    $routes->get('delete_category/(:num)', 'Expenses::delete_category');
});

$routes->group('Product', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Product::index');
    $routes->get('list', 'Product::list');
    $routes->get('add', 'Product::add_product');
    $routes->post('add', 'Product::save_product');
    $routes->get('update/(:num)', 'Product::add_product');
    $routes->get('view/(:num)', 'Product::view_product');
    $routes->get('delete/(:num)', 'Product::delete_product');
    $routes->get('delete', 'Product::delete_product');
    $routes->post('getPurchasePrice', 'Product::get_purchase_price');
    $routes->post('getProductByID', 'Product::getProductByID');
});

$routes->group('Category', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Category::index');
    $routes->get('list', 'Category::list');
    $routes->get('add', 'Category::add_category');
    $routes->post('add', 'Category::save_category');
    $routes->get('update/(:num)', 'Category::update_category');
    $routes->get('view/(:num)', 'Category::view_category');
    $routes->get('delete/(:num)', 'Category::delete_category');
    $routes->get('delete', 'Category::delete_category');
});

$routes->group('Brand', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Brand::index');
    $routes->get('list', 'Brand::list');
    $routes->get('add', 'Brand::add_brand');
    $routes->post('add', 'Brand::save_brand');
    $routes->get('update/(:num)', 'Brand::update_brand');
    $routes->get('view/(:num)', 'Brand::view_brand');
    $routes->get('delete/(:num)', 'Brand::delete_brand');
    $routes->get('delete', 'Brand::delete_brand');
});

$routes->group('Sales', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Sales::index');
    $routes->get('list', 'Sales::index');
    $routes->get('add', 'Sales::add');
    $routes->get('getProductList', 'Sales::getProductList');
    $routes->get('update/(:num)', 'Sales::add');
    $routes->get('delete/(:num)', 'Sales::delete');
});

$routes->group('Notes', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Notes::index');
    $routes->get('list', 'Notes::list');
    $routes->get('add', 'Notes::add');
    $routes->post('save', 'Notes::save');
    $routes->get('update/(:num)', 'Notes::update');
    $routes->get('delete/(:num)', 'Notes::delete');
});

$routes->group('Schedule', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Schedule::index');
    $routes->get('list', 'Notes::list');
    $routes->get('add', 'Notes::add');
    $routes->post('save', 'Notes::save');
    $routes->get('update/(:num)', 'Notes::add');
    $routes->get('delete/(:num)', 'Notes::delete');
});

$routes->group('Invoice', ["filter" => ['basicauth','permission']], static function ($routes) {
    $routes->get('/', 'Invoice::index');
    $routes->get('list', 'Invoice::list');
    $routes->get('get_orders_list', 'Invoice::get_orders_list');
    $routes->get('convert_order_to_invoice/(:num)', 'Invoice::convert_order_to_invoice');
    $routes->get('add', 'Invoice::add');
    $routes->post('save', 'Invoice::save');
    $routes->get('generate_number', 'Invoice::generate_number');
    $routes->get('view/(:num)', 'Invoice::view');
    $routes->get('export_pdf/(:num)', 'Invoice::export_pdf');
    $routes->get('update/(:num)', 'Invoice::update');
    $routes->get('delete/(:num)', 'Invoice::delete');
});


// $routes->group("api", ["namespace" => "App\Controllers\Api", "filter" => "basicauth"] , function($routes){
//     $routes->get("list-employee", "ApiController::listEmployee");
//     $routes->post("add-employee", "ApiController::addEmployee");
// });

// $routes->group("api", ["namespace" => "App\Controllers\Api","filter" => "loggerhandler"] , function($routes){
//     $routes->get("list-user", "Users::listUser");
//     $routes->post("add-user", "Users::addUser");
//     $routes->get("delete-user", "Users::deleteUser");
//     $routes->post("add_attendance", "Users::addAttendance");
//     $routes->get("get_attendance", "Users::getAttendance");
//     $routes->get("get_all_attendance", "Users::getAllAttendance");
//     $routes->get("get_attendance_count", "Users::getAttendanceCount");
//     $routes->post("update_qr", "Users::UpdateQR");
//     $routes->get("last_login", "Users::last_login");
//     $routes->get("user_log", "Users::user_log");
// });


$routes->group("api", ["namespace" => "App\Controllers\Api"], function ($routes) {
    $routes->post("add_token", "QRGenerate::addToken");
    $routes->post("update_token", "QRGenerate::updateToken");
    $routes->post("delete_token", "QRGenerate::deleteToken");
    $routes->get("token_list", "QRGenerate::listToken");
    $routes->get("truncate_token", "QRGenerate::truncate_token");
});

// $routes->group("api", function ($routes) {
//     $routes->post("register", "User::register");
//     $routes->post("login", "User::login");
//     $routes->post("login_web", "User::login_web");
//     $routes->get("profile", "User::details");
// });

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
