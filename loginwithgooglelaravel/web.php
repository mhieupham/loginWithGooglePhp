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
//Front-end site
Route::get('/locale/{locale}',function ($locale){
    \Session::put('locale',$locale);
    return redirect()->back();
})->name('set-locale');

Route::get('/','HomeController@index')->name('homepage');
Route::post('/search','HomeController@search')->name('search');
//Card shopping
Route::get('/card','CartController@index')->name('all-cart');
Route::get('/add_to_card','CartController@addToCart')->name('addToCart');
Route::get('/destroy_card_item','CartController@destroyItem')->name('deleteItem');
Route::get('/plus-item','CartController@plusItem')->name('plusItem');
Route::get('/minus-item','CartController@minusItem')->name('minusItem');
Route::get('/count-item/{product_id}','CartController@countQuantity')->name('countQuantity');
Route::get('store-order','CartController@store')->name('add-order-customer');
Route::get('discount-order','CartController@getCoupon')->name('add-coupon-customer');
Route::get('undiscount-order','CartController@unCoupon')->name('un-coupon-customer');
//show category wise product here
Route::get('/view_product/{product_id}','HomeController@product_details_by_id')->name('view_product');
//filter
Route::get('/search','SearchController@total_search')->name('search-total');
Route::get('/show_product_category/{category_name}','SearchController@category_product')->name('show-product-category');
Route::get('/show_product_brand/{brand_name}','SearchController@brand_product')->name('show-product-brand');
//customer
Route::get('login-customer','CustomerController@login')->name('login-customer');
Route::get('auth/google', 'CustomerController@redirectToProvider')->name('google-submit');
Route::get('auth/google/callback', 'CustomerController@handleProviderCallback')->name('google-callback');
Route::get('/confirm-profile','CustomerController@confirmProfile')->name('confirm-profile');
Route::post('/save-profile','CustomerController@saveProfileCustomer')->name('save-profile');
Route::get('/logout-profile','CustomerController@logoutCustomer')->name('logout-profile');
//Back-end site
Route::get('/backend','AdminController@index')->name('admin-login');
Route::post('/admin-dashboard','AdminController@dashboard')->name('admin-dashboard');
Route::get('/dashboard','SuperAdminController@show_dashboard')->name('show-dashboard');
Route::get('/logout','SuperAdminController@logout')->name('admin-logout');
//user admin route
Route::get('/register-user-admin',[
    'as'=>'register-user-admin',
    'uses'=>'SuperAdminController@createUser',
    'middleware'=>'checkalc:create-user'
]);
Route::post('/register-user-admin',[
    'as'=>'register-uadmin',
    'uses'=>'SuperAdminController@registerUser',
    'middleware'=>'checkalc:create-user'
]);
Route::get('/all-user-admin',[
    'as'=>'all-user-admin',
    'uses'=>'SuperAdminController@all_user_admin',
    'middleware'=>'checkalc:all-user'
]);
Route::get('/edit-user-admin/{user_id}',[
    'as'=>'edit-user-admin',
    'uses'=>'SuperAdminController@edit',
    'middleware'=>'checkalc:edit-user'
]);
Route::post('/update-user-admin/{user_id}',[
    'as'=>'update-user-admin',
    'uses'=>'SuperAdminController@update',
    'middleware'=>'checkalc:edit-user'
]);
//category route
Route::get('/add-category','CategoryController@create')->name('add-category');
Route::get('/all-category','CategoryController@all_category')->name('all-category');
Route::post('/save-category','CategoryController@add_category')->name('store-category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category')->name('edit-category');
Route::post('/update-category/{category_id}','CategoryController@update_category')->name('update_category');
Route::get('/un-active-category/{category_id}','CategoryController@unactive')->name('un-active-category');
Route::get('/active-category/{category_id}','CategoryController@active')->name('active-category');
Route::get('/delete-category/{category_id}','CategoryController@destroy')->name('delete-category');
//manufacture route
Route::get('/all-manufacture','ManuFactureController@index')->name('all-manufacture');
Route::get('/add-manufacture','ManuFactureController@create')->name('add-manufacture');
Route::post('/save-manufacture','ManuFactureController@store')->name('store-manufacture');
Route::get('/edit-manufacture/{manufacture_id}','ManuFactureController@edit')->name('edit-manufacture');
Route::post('/update-manufacture/{manufacture_id}','ManuFactureController@update')->name('update-manufacture');
Route::get('/un-active-manufacture/{manufacture_id}','ManuFactureController@unactive')->name('unactive-manufacture');
Route::get('/active-manufacture/{manufacture_id}','ManuFactureController@active')->name('active-manufacture');
Route::get('/delete-manufacture/{manufacture_id}','ManuFactureController@destroy')->name('destroy-manufacture');
//product route
Route::get('/add-products','ProductController@create')->name('add-products');
Route::post('/save-product','ProductController@store')->name('save-product');
Route::get('/edit-product/{product}','ProductController@edit')->name('edit-product');
Route::post('/update-product/{product}','ProductController@update')->name('update-product');
Route::get('/all-product','ProductController@index')->name('all-product');
Route::get('/un-active-product/{product_id}','ProductController@unactive')->name('unactive-product');
Route::get('/active-product/{product_id}','ProductController@active')->name('active-product');
Route::get('/delete-product/{product_id}','ProductController@destroy')->name('destroy-product');
//order customer
Route::get('all-order','OrderCustomerController@index')->name('order-customer');
Route::get('/show-order/{order_id}','OrderCustomerController@show')->name('show-order-customer');
Route::get('/comfirm-order/{order_id}','OrderCustomerController@confirmorder')->name('confirm-order');
Route::post('store-history','OrderCustomerController@insertOrderHistory')->name('add-history-buy');
Route::get('/delete-order/{order_id}','OrderCustomerController@deleteOrder')->name('delete-order');
//role route
Route::get('/add-role-admin','RoleController@create')->name('add-role-admin');
Route::post('/add-role-admin','RoleController@store')->name('store-role-admin');
Route::get('/all-role-admin','RoleController@index')->name('all-role-admin');
Route::get('/edit-role-admin/{role_id}','RoleController@edit')->name('edit-role-admin');
Route::post('/update-role-admin/{role_id}','RoleController@update')->name('update-role-admin');
Route::get('/del-role-admin/{role_id}','RoleController@destroy')->name('del-role-admin');
//Gross revenue route
Route::get('/order-history','OrderHistoryController@index')->name('history-order');
//Export excel
Route::get('/to-excel','OrderHistoryController@excel')->name('to-excel');
//Coupon
Route::get('/all-coupon','CouponController@index')->name('all-coupon');
Route::get('/create-coupon','CouponController@create')->name('create-coupon');
Route::post('/store-coupon','CouponController@store')->name('store-coupon');
Route::get('/active-coupon/{coupon_id}','CouponController@active')->name('active-coupon');
Route::get('/unactive-coupon/{coupon_id}','CouponController@unactive')->name('unactive-coupon');
Route::get('/edit-coupon/{coupon_id}','CouponController@edit')->name('edit-coupon');
Route::post('/update-coupon/{coupon_id}','CouponController@update')->name('update-coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete')->name('delete-coupon');
