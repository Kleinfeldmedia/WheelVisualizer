<?php

use Illuminate\Http\Request;  
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
Route::get('/', 'HomeController@index'); 

Route::post('/search', 'HomeController@search')->name('search');

Auth::routes();

Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');
Route::get('/contactus', 'HomeController@contactus')->name('contactus');
Route::get('/shippinginfo', 'HomeController@shippinginfo')->name('shippinginfo');
Route::get('/canadashipping', 'HomeController@canadashipping')->name('canadashipping');
Route::get('/privacypolicy', 'HomeController@privacypolicy')->name('privacypolicy');
Route::get('/returnpolicy', 'HomeController@returnpolicy')->name('returnpolicy');
Route::get('/boltpatterns', 'HomeController@boltpatterns')->name('boltpatterns');
Route::get('/reviews', 'HomeController@reviews')->name('reviews');
Route::get('/feedback', 'HomeController@feedback')->name('feedback');
Route::get('/videos', 'HomeController@videos')->name('videos');

Route::get('/informations', 'HomeController@informations')->name('informations');
Route::get('/lipsizes', 'HomeController@lipsizes')->name('lipsizes');
Route::get('/wheelconfig', 'HomeController@wheelconfig')->name('wheelconfig');
Route::get('/packagedeal', 'HomeController@packagedeal')->name('packagedeal');
Route::get('/rimfinancing', 'HomeController@rimfinancing')->name('rimfinancing');
Route::get('/traction', 'HomeController@traction')->name('traction');
Route::get('/lowhigh', 'HomeController@lowhigh')->name('lowhigh');
Route::get('/wheelfitment', 'HomeController@wheelfitment')->name('wheelfitment');
Route::get('/tiremounting', 'HomeController@tiremounting')->name('tiremounting');
Route::get('/seasoneltires', 'HomeController@seasoneltires')->name('seasoneltires');
Route::get('/tiresidewall', 'HomeController@tiresidewall')->name('tiresidewall');

Route::get('/cmspage/{routename}', 'HomeController@cmspage');
Route::get('/informations/{routename}', 'HomeController@cmspage');



Route::get('/bloglist', 'HomeController@bloglist')->name('bloglist');
Route::get('/blogview/{id}', 'HomeController@blogview')->name('blogview');


Route::get('/orderstatus', 'HomeController@orderstatus')->name('orderstatus');

Route::get('/guest/orderstatus', 'HomeController@guestorderstatus')->name('guestorderstatus');

Route::post('/orderstatus', 'HomeController@checkorderstatus')->name('checkorderstatus');
Route::get('/vieworder/{orderid}', 'HomeController@vieworder')->name('vieworder');
Route::get('/trackorder/{orderid}', 'HomeController@trackorder')->name('trackorder');

// Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/newsletter', 'HomeController@newsletter')->name('newsletter');
Route::get('/forms', 'HomeController@forms')->name('forms');
Route::get('/wheels', 'HomeController@wheels')->name('wheels');
// Route::get('/shoppingcart', 'HomeController@shopping_cart')->name('shopping_cart');
// Route::get('/checkout', 'HomeController@checkout')->name('checkout');
Route::get('/wheelview/{wheel_id?}', 'HomeController@wheelview')->name('wheelview');
Route::get('/wheelbrand/{wheel_id?}', 'HomeController@wheelbrand')->name('wheelbrand');
Route::get('/csvuplaod', 'HomeController@csv_upload')->name('csvuplaod');
Route::get('/csvuplaodcolor', 'HomeController@csv_upload_color')->name('csvuplaodcolor');
Route::get('/wheels-data', 'HomeController@wheels')->name('wheels_data');
Route::get('/carimages', 'HomeController@carimages')->name('carimages');
Route::get('/wheelsNameChange', 'HomeController@wheelsNameChange')->name('wheelsNameChange');
Route::get('/notFoundCars', 'HomeController@notFoundCars')->name('notFoundCars'); 
Route::get('/fold-fil', 'HomeController@fold_fil');
Route::get('/tiredetailimages', 'HomeController@tiredetailimages');
Route::get('/carImagesMovingToFolder', 'HomeController@carImagesMovingToFolder');
Route::get('/carImagesMovingToFolderLive', 'HomeController@carImagesMovingToFolderLive');
Route::get('/renameFrontBackImages', 'HomeController@renameFrontBackImages');
Route::get('/carimagestosqlLive', 'HomeController@carimagestosqlLive');
Route::get('/VerifyWheelProductImages', 'HomeController@VerifyWheelProductImages');


Route::get('/DropshipperImport', 'DropshipperController@DropshipperImport');
Route::get('/DropshipperInventory_Import', 'DropshipperInventoryController@DropshipperInventory_Import');

Route::get('/Vehicle_Dually_update', 'VehicleController@Vehicle_Dually_update');
Route::get('/offroad_update', 'OffroadController@offroad_update');
// Route::get('/New_Vehicle_Import', 'VehicleController@New_Vehicle_Import');
// Route::get('/vif_update', 'VehicleController@vif_update');


// Route::get('/csv_vftp0028', 'HomeController@csv_vftp0028');
// Route::get('/csv_vftp0017', 'HomeController@csv_vftp0017');
// Route::get('/csv_vftp0018', 'HomeController@csv_vftp0018');
// Route::get('/csv_vftp0030', 'HomeController@csv_vftp0030');
// Route::get('/csv_vftp0032', 'HomeController@csv_vftp0032');
// Route::get('/csv_vftp0022', 'HomeController@csv_vftp0022');
// Route::get('/convertExcelToCSV', 'HomeController@convertExcelToCSV');

// Route::get('/vftp_to_sql/{filename?}', 'HomeController@vftp_to_sql');
// Route::get('/vftp_to_sql_test/{filename}', 'HomeController@vftp_to_sql_test');

// Route::get('/redundancy_check/{filename}', 'HomeController@redundancy_check');
// Route::get('/mergeUniqueFiles', 'HomeController@mergeUniqueFiles');

//OpenCv Test Routes
// Route::get('/opencv', 'HomeController@opencv');
// Route::get('/tsf', 'HomeController@tsf');
// Route::get('/canvas', 'HomeController@canvas');
Route::get('/runPython', 'HomeController@runPython');
Route::get('/upodateWheelsPartNo', 'HomeController@upodateWheelsPartNo');
// Route::get('/findMisMatchedWheels', 'HomeController@findMisMatchedWheels');

// Route::get('/UploadInventories', 'InventoryController@UploadInventories');

Route::get('/getUploadInventories', 'InventoryController@getUploadInventories');
// Route::get('/CopyTableToServer', 'InventoryController@CopyTableToServer');

// Route::get('/automationUpdate', 'InventoryController@automationUpdate')->name('automationUpdate');

// Route::get('/Wheel_Import', 'WheelController@Wheel_Import');
// Route::get('/Tires_data_import', 'TireController@Tires_data_import');
// Route::get('/Falken_Detail_Import', 'TireDetailController@Falken_Detail_Import');
// Route::get('/Vehicle_Import', 'VehicleController@Vehicle_Import');
// Route::get('/Chassis_Import', 'ChassisController@Chassis_Import');
// Route::get('/ChassisModel_Import', 'ChassisModelController@ChassisModel_Import');
// Route::get('/PlusSize_Import', 'PlusSizeController@PlusSize_Import');
// Route::get('/MinusSize_Import', 'MinusSizeController@MinusSize_Import');

Route::resource('wheel', 'WheelController');

Route::get('/vehicledetails', 'HomeController@vehicledetails')->name('vehicledetails');
Route::get('/selectCarByColor', 'HomeController@selectCarByColor')->name('selectCarByColor');


// Filters By Vehicle Models
Route::get('/getFiltersByVehicle', 'VehicleController@getFiltersByVehicle')->name('getFiltersByVehicle');
Route::get('/setFiltersByVehicle', 'VehicleController@setFiltersByVehicle')->name('setFiltersByVehicle');




// Tires Module Routes
Route::get('/tires', 'TireController@index')->name('tires');
Route::get('/tirelist/{chassis_model_id?}/{vehicle_id?}/{wheelproduct_id?}/{is_shipped?}', 'TireController@list')->name('tirelist');
Route::get('/tireview/{tire_id}/{vehicle_id?}/{is_tirepackage?}', 'TireController@tireview')->name('tireview');
Route::get('/tirebrand/{brand_name?}', 'TireController@brand')->name('tirebrand');
Route::get('/tirebrandmodel/{tire_id}', 'TireController@tirebrandmodel')->name('tirebrandmodel');


// Filters By Tire sizes
Route::get('/getFiltersByTire', 'TireController@getFiltersByTire')->name('getFiltersByTire');
Route::get('/setFiltersByTire', 'TireController@list')->name('setFiltersByTire');
Route::get('/tires_update', 'TireController@tires_update')->name('tires_update');



// Wheel Product Module Routes
Route::get('/products', 'WheelProductController@products')->name('products');
Route::get('/wheelproducts', 'WheelProductController@index')->name('wheelproducts');
// Route::get('/tirelist/{chassis_model_id?}/{vehicle_id?}', 'TireController@list')->name('tirelist');

Route::get('/wheelproductview/{product_id?}/{flag?}/{prodtitle?}', 'WheelProductController@wheelproductview')->name('wheelproductview');
// Route::get('/tirebrand/{brand_name}', 'TireController@brand')->name('tirebrand');
// Route::get('/tirebrandmodel/{tire_id}', 'TireController@tirebrandmodel')->name('tirebrandmodel');

Route::get('/wheeltirepackage/{product_id?}/{flag?}/{is_shipped?}', 'WheelProductController@wheeltirepackage')->name('wheeltirepackage');


// Filters By Wheel sizes
Route::get('/getFiltersByProductWheelSize', 'WheelProductController@getFiltersByProductWheelSize')->name('getFiltersByProductWheelSize');
Route::get('/setFiltersByProductWheelSize', 'WheelProductController@index')->name('setFiltersByProductWheelSize');
Route::get('/setFiltersByProductVehicle', 'WheelProductController@index')->name('setFiltersByProductVehicle');
Route::get('/getLiftSizes', 'WheelProductController@getLiftSizes')->name('getLiftSizes');
Route::get('/checkDropshippble', 'WheelProductController@checkDropshippble')->name('checkDropshippble');
Route::get('/setWheelVehicleFlow', 'WheelProductController@setWheelVehicleFlow')->name('setWheelVehicleFlow');
Route::get('/checkVehicleFit', 'WheelProductController@checkVehicleFit')->name('checkVehicleFit');



// Shopping Cart
Route::get('/CartItems', 'CartController@index')->name('index');
Route::get('/addToCart', 'CartController@store')->name('store');
Route::get('/updateCart', 'CartController@update')->name('update');
Route::get('/clearCart', 'CartController@clearCart')->name('clearCart');
Route::get('/getCartCount', 'CartController@getCartCount')->name('getCartCount');
Route::get('/removeItem/{type}/{id}', 'CartController@destroy')->name('removeItem');


Route::get('/checkout', 'CartController@checkout')->name('checkout');
Route::post('/zipcodeUpdate', 'CartController@zipcodeUpdate')->name('zipcodeUpdate');
Route::get('/zipcodeClear', 'CartController@zipcodeClear')->name('zipcodeClear');
Route::get('/getZipcode', 'CartController@getZipcode')->name('getZipcode');


Route::resource('order', 'OrderController');


Route::resource('enquiry', 'EnquiryController');


Route::resource('comment', 'PostCommentController');


Route::post('/review', 'FeedbackController@store')->name('review.store');
Route::post('/feedback', 'FeedbackController@store')->name('feedback.store');


  Route::get('/guest', 'UserController@guest')->name('guest');
  Route::get('/guest/orders', 'UserController@guest_orders')->name('guest_orders');

Route::middleware(['auth'])->group(function () {
     
  Route::get('/dashboard', 'UserController@index')->name('user.dashboard');
  Route::get('/profile', 'UserController@profile')->name('user.profile');
  Route::get('/orders', 'UserController@orders')->name('user.orders');
  Route::patch('/user/update/{id}', 'Resource\UserResource@update')->name('user.update');
  Route::resource('ticket', 'TicketController');
  Route::post('/ticket/message/store', 'TicketController@message_store')->name('ticket.message.store');
  Route::get('/user/invoice/{id}', 'OrderController@invoice_pdf');
});



Route::post('/addStarRating', 'HomeController@addStarRating')->name('addStarRating');



// Route::get('/InventoryCommand',function(){
//         \Artisan::call('autoupdate:inventories');
// });

Route::get('/404', 'HomeController@notfound')->name('notfound');
Route::get('/test', 'HomeController@demo_visualiser')->name('demo_visualiser');

 
Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin.register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.update');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});
 


