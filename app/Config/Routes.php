<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('admin/login', 'Admin\Authorisation::login');
$routes->post('admin/login', 'Admin\Authorisation::loginPost');
$routes->get('admin/logout', 'Admin\Authorisation::logout');

$routes->get('admin/dashboard', function () {
    if (!session()->get('admin_logged_in')) {
        return redirect()->to('/admin/login');
    }
    return view('admin/dashboard');
});


$routes->get('admin/cart', 'Admin\Cart::index');
$routes->post('admin/cart/update/(:num)', 'Admin\Cart::update/$1');
$routes->get('admin/cart/delete/(:num)', 'Admin\Cart::delete/$1');

$routes->group('admin', function($routes){
    $routes->get('product', 'Admin\Product::index');
    $routes->get('product/create', 'Admin\Product::create');
    $routes->post('product/store', 'Admin\Product::store');
    $routes->get('product/edit/(:num)', 'Admin\Product::edit/$1');
    $routes->post('product/update/(:num)', 'Admin\Product::update/$1');
    $routes->get('product/delete/(:num)', 'Admin\Product::delete/$1');
});
$routes->get('api/products', 'Api\ProductApi::index');
// Cart API
$routes->post('api/cart/add', 'Api\CartApi::add');
$routes->get('api/cart', 'Api\CartApi::index');
$routes->post('api/cart/update/(:num)', 'Api\CartApi::update/$1');
$routes->delete('api/cart/delete/(:num)', 'Api\CartApi::delete/$1');

//$routes->get('api/cart/add', 'Api\CartApi::add');

$routes->post('api/cart/delete/(:num)', 'Api\CartApi::delete/$1');

$routes->get('shop', 'Shop::index');
$routes->get('cart', 'CartPage::index');

$routes->post('api/cart/checkout', 'Api\CartApi::checkout');

$routes->get('admin/orders', 'Admin\Orders::index');
$routes->get('admin/orders/view/(:num)', 'Admin\Orders::view/$1');

$routes->post('api/payment/success/(:num)', 'Api\PaymentApi::success/$1');


$routes->get('admin/product', 'Admin\Product::index');
$routes->get('admin/product/create', 'Admin\Product::create');
$routes->post('admin/product/store', 'Admin\Product::store');
$routes->get('admin/product/edit/(:num)', 'Admin\Product::edit/$1');
$routes->post('admin/product/update/(:num)', 'Admin\Product::update/$1');
$routes->get('admin/product/delete/(:num)', 'Admin\Product::delete/$1');

