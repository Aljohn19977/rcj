<?php
use App\SubCategory;


Auth::routes();
/* AdminProductController */
Route::group(['namespace' => 'Admin'],function(){

Route::get('/ajax-subcat',function(){
	$cat_id = Input::get('cat_id');
	
	$subcategory = SubCategory::where('category_id','=',$cat_id)->get();

	return Response::json($subcategory);

});

Route::resource('product','AdminProductController');
Route::get('api/product','AdminProductController@apiProducts')->name('api.product');
Route::post('product/published/{product_id}','AdminProductController@published');
Route::post('/product/image/upload','AdminProductController@image_upload');
Route::post('product/image/delete/{product_id}','AdminProductController@delete_image');
Route::post('product/unpublished/{product_id}','AdminProductController@unpublished');

/* END AdminProductController */

/* AdminCategoryController */

Route::resource('category','AdminCategoryController');
Route::get('api/category','AdminCategoryController@apiCategory')->name('api.category');
Route::post('category/published/{id}','AdminCategoryController@published');
Route::post('category/unpublished/{id}','AdminCategoryController@unpublished');
/* END AdminCategoryController */

/* AdminAccountController */

Route::resource('accounts','AdminAccountController');
Route::get('api/accounts','AdminAccountController@apiAccounts')->name('api.accounts');
Route::get('accounts/published/{id}','AdminAccountController@published');
Route::get('accounts/unpublished/{id}','AdminAccountController@unpublished');
/* END AdminAccountController */

/* AccountAdminController */
Route::resource('account/admin','AccountAdminController');
/* END AccountAdminController */

/* AccountDeliveryController */
Route::resource('account/delivery','AccountDeliveryController');
/* END AccountDeliveryController */

/* AdminCarouselController */
Route::resource('/carousel','AdminCarouselController');
Route::post('/logo/upload','AdminCarouselController@logo_upload');
Route::post('/carousel/upload','AdminCarouselController@image_upload');
Route::post('/carousel/image/delete/{product_id}','AdminCarouselController@delete_image');
Route::get('api/carousel','AdminCarouselController@apiCarouselImages')->name('api.carousel');
/* END AdminCarouselController */

/* AdminSubCategoryController */
Route::resource('sub-category','AdminSubCategoryController');
Route::get('api/sub-category','AdminSubCategoryController@apiSubCategory')->name('api.subcategory');
Route::post('sub-category/published/{id}','AdminSubCategoryController@published');
Route::post('sub-category/unpublished/{id}','AdminSubCategoryController@unpublished');
/* END AdminSubCategoryController */

/* AdminContactUsController */
Route::resource('/admin/contact_us','AdminContactUsController');
Route::post('/admin/contact_us/reply','AdminContactUsController@reply');
Route::get('api/contactUs','AdminContactUsController@apicontactUs')->name('api.contactUs');
/* END AdminContactUsController */

/* AdminOrderController */
Route::resource('/orders','AdminOrderController');
Route::post('/orders/cancel/{id}','AdminOrderController@cancel_order');
Route::get('api/orders','AdminOrderController@apiOrders')->name('api.orders');
/* END AdminOrderController */

/* AdminDeliveredOrderController */
Route::resource('/delivered/order','AdminDeliveredOrderController');
Route::get('api/delivered/order','AdminDeliveredOrderController@apiDelivered')->name('api.delivered');
/* END AdminDeliveredOrderController */

/* AdminCanceledOrderController */
Route::resource('/canceled_orders','AdminCanceledOrder');
Route::get('api/canceled_orders','AdminCanceledOrder@apiCancelOrders')->name('api.cancelorders');
Route::post('canceled_orders/return/{id}','AdminCanceledOrder@return');
/* END AdminCanceledOrderController */

/* AdminShipCostController */
Route::get('/ship_cost/back','AdminShipCostController@back');
Route::resource('/ship_cost','AdminShipCostController');
Route::post('/ship_cost/update/{id}','AdminShipCostController@update');
/* END AdminShipCostController */


/* AdminInterfaceController */
Route::get('/content_interface/back','AdminInterfaceController@back');
Route::resource('/content_interface','AdminInterfaceController');
Route::post('/content_interface/update/{id}','AdminInterfaceController@update');
/* END AdminInterfaceController */

/* AdminStatisticsController */
Route::resource('/statistics','AdminStatisticsController');
/* END AdminStatisticsController */

/* AdminRefundController */
Route::resource('/refund','AdminRefundController');
Route::get('/records/refund','AdminRefundController@record');
Route::get('api/records/refund','AdminRefundController@apiRecord')->name('api.rec.refund');
Route::get('api/refund','AdminRefundController@apiRefund')->name('api.refund');
Route::post('/refund/update','AdminRefundController@refund_update');
Route::post('/refund/refund_emailer','AdminRefundController@refund_emailer');
/* END AdminRefundController */

/* AdminPaymentController */
Route::resource('/payment','AdminPaymentController');
Route::get('/records/payment','AdminPaymentController@record');
Route::get('api/records/payment','AdminPaymentController@apiRecord')->name('api.record');
Route::get('api/payment','AdminPaymentController@apiPayment')->name('api.payment');
Route::post('payment/published/{id}','AdminPaymentController@published');
Route::post('payment/unpublished/{id}','AdminPaymentController@unpublished');
/* END AdminPaymentController */

/* DeliveryController */
Route::resource('/delivery/payment','DeliveryController');
Route::get('api/delivery/payment','DeliveryController@apiDelivery')->name('api.delivery');
/* END DeliveryController */

Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin-login', 'Auth\LoginController@login');
Route::get('admin-logout', 'Auth\LoginController@logout')->name('admin.logout');

Route::post('admin-password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset','Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('admin-password/reset','Auth\ResetPasswordController@reset')->name('admin.password.request');
Route::get('admin-password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');



Route::get('/admin-dashboard', 'AdminController@index');
Route::get('/sales/json', 'AdminController@get_sales');
});
/* END AdminProductController */

/* UserController */
Route::get('/', 'UserController@index');
Route::get('/products', 'UserController@products');
Route::get('products/{name}', 'UserController@products_category');
Route::get('products/detail/{id}', 'UserController@products_details');


Route::get('/contact_us', 'ContactUsController@contact_us');
Route::post('/contact_us/submit', 'ContactUsController@contact_us_submit');


Route::get('products/detail/{id}/json', 'UserController@return_json');

Route::get('products/MEN/1/detail/{id}', 'UserController@products_details');
Route::get('products/search/{id}', 'UserController@products_search');
Route::get('products/{name}/{sub_name}', 'UserController@products_subcategory');
Route::post('/search', 'UserController@search');
/* END UserController */

Route::get('/account/', 'AccountController@index');
Route::post('/account/{id}', 'AccountController@destroy');
Route::post('/account/refund/{id}', 'AccountController@destroy_refund');
Route::post('/account/update/{id}', 'AccountController@update');
Route::post('/account/orders/cancel/{id}','AccountController@cancel_order');
Route::get('api/user_order/', 'AccountController@apiUserOrders')->name('api.userorder');
Route::get('api/user_refund/', 'AccountController@apiUserRefund')->name('api.userrefund');

Route::get('/checkout', 'CheckoutController@index');
Route::get('/checkout/seconday_address', 'CheckoutController@second_address');
Route::post('/checkout/add_address', 'CheckoutController@user_address');
Route::post('/checkout/add_second_address', 'CheckoutController@user_address2');
Route::get('/checkout/paypal', 'PaypalPaymentController@paywithPaypal');
Route::get('/checkout/paypal/done', 'CheckoutController@paywithPaypaldone');

Route::get('/checkout/orders/payment', 'CheckoutController@orders_payment');
Route::post('/checkout/orders/done', 'CheckoutController@checkout');

Route::get('/cart', 'CartController@index');
Route::get('/cart/addItem', 'CartController@addItem');
Route::get('/cart/addItem/wishlist/{id}', 'CartController@addItemWishlist');
Route::get('/cart/addItem/favorites/{id}', 'CartController@addItemFavorites');
Route::post('/cart/addItem/pro_detail', 'CartController@addItem_on_pro_detail');
Route::get('/cart/remove/{id}', 'CartController@destroy');
Route::post('/cart/update/{id}', 'CartController@update')->name('cart.update');

Route::get('/wishlist', 'WishlistController@index');
Route::post('/wishlist/addItem/', 'WishlistController@addItem');
Route::get('/wishlist/remove/{user_id}/{pro_id}', 'WishlistController@destroy');

Route::get('/favorites', 'UserFavoritesController@index');
Route::get('/favorites/remove/{user_id}/{pro_id}', 'UserFavoritesController@destroy');

Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');





