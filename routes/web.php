<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//maincontent
Route::get('/', 'HomeController@index');
//show category product in main content
Route::get('/product_by_category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}', 'HomeController@show_product_by_manufacture');
Route::get('/view_product/{product_id}', 'HomeController@product_detailes_by_id');

//checkout system.........
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer_register','CheckoutController@customer_register');
Route::post('/customer_login','CheckoutController@customer_login');
Route::post('/save-shipping','CheckoutController@save_shipping');
Route::get('/check-out','CheckoutController@check_out');
Route::get('/customer_logout','CheckoutController@customer_logout');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/show-order/{order_id}','CheckoutController@show_order');
Route::get('/unactive_order/{order_id}', 'CheckoutController@unactive_order');
Route::get('/active_order/{order_id}', 'CheckoutController@active_order');
Route::get('/delete-order/{order_id}', 'CHeckoutController@delete_order');



//cart product
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/update-cart','CartController@update_cart');

//product page


//backend routs
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');//show_dashboard
Route::post('/admin-dashboard','AdminController@dashboard');


//category routs
Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/unactive_category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active_category/{category_id}', 'CategoryController@active_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');

//Brands Routs
Route::get('/add-brand', 'BrandController@index');
Route::post('/save-brand', 'BrandController@save_brand');
Route::get('/all-brand', 'BrandController@all_brand');
Route::get('/unactive_brand/{manufacture_id}', 'BrandController@unactive_brand');
Route::get('/active_brand/{manufacture_id}', 'BrandController@active_brand');
Route::get('/edit-brand/{manufacture_id}', 'BrandController@edit_brand');
Route::post('/update-brand/{manufacture_id}', 'BrandController@update_brand');
Route::get('/delete-brand/{manufacture_id}', 'BrandController@delete_brand');

//product routs
Route::get('/add-product', 'ProductController@index');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/unactive_product/{product_id}', 'ProductController@unactive_product');
Route::get('/active_product/{product_id}', 'ProductController@active_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');

//slider............
Route::get('/add-slider', 'SliderController@index');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/all-slider', 'SliderController@all_slider');
Route::get('/unactive-slider/{slider_id}', 'SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}', 'SliderController@active_slider');
Route::get('/delete-slider/{slider_id}', 'SliderController@delete_slider');



















