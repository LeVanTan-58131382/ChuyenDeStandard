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

// Route::get('/', function () {
//     return view('welcome');
// });
 
// Route::get('/admin', 'AdminController@admin')->name('admin-page');

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


// Route::group(['prefix'=>'admin'], function()
// {
// 	Route::group(['prefix'=>'customer'], function()
// 		{	
// 			Route::get('edit/{id}', 'AdminController@edit_customer')->name('edit-cus');
// 			Route::post('update/{id}', 'AdminController@update_customer')->name('update-cus');
// 			Route::get('destroy/{id}', 'AdminController@destroy_customer')->name('destroy-cus');
// 			Route::get('list', 'AdminController@customers')->name('list-cus');
// 			Route::get('create', 'AdminController@create_customer')->name('create-cus');
//             Route::post('store', 'AdminController@store_customer')->name('store-cus');
// 			Route::get('show/{id}', 'AdminController@show_customer')->name('show-cus');
//     });
//     Route::group(['prefix'=>'messages'], function()
// 		{	
// 			Route::get('edit/{id}', 'AdminController@editMessages')->name('edit-mes');
// 			Route::post('updat/{id}', 'AdminController@updateMessages')->name('update-mes');
// 			Route::get('destroy/{id}', 'AdminController@destroy_message')->name('destroy-mes');
// 			Route::get('list', 'AdminController@messages')->name('list-mes');
// 			Route::get('create/{id?}/{title?}', 'AdminController@create_message')->name('create-mes');
//             Route::post('send', 'AdminController@send_message')->name('send-mes');
//             Route::get('read/{id}', 'AdminController@read_message')->name('read-mes');
// 	});
	
// 	Route::group(['prefix'=>'comment'], function()
// 		{	
// 			Route::get('edit/{id}', 'AdminController@editComment')->name('edit-cmt-ad');
// 			Route::post('updat/{id}', 'AdminController@updateComment')->name('update-cmt-ad');
// 			Route::get('destroy/{id}', 'AdminController@destroyComment')->name('destroy-cmt-ad');
// 			Route::get('list', 'AdminController@comments')->name('list-cmt-ad');
// 			Route::get('create/{id}', 'AdminController@create_comment')->name('create-cmt-ad');
//             Route::post('send/{id}', 'AdminController@send_comment')->name('send-cmt-ad');
//             Route::get('read/{id}', 'AdminController@read_comment')->name('read-cmt-ad');
// 	});
	
//     Route::group(['prefix'=>'notification'], function()
// 		{	
// 			Route::get('edit/{id}', 'AdminController@editNotification')->name('edit-notifi');
// 			Route::post('update/{id}', 'AdminController@updateNotification')->name('update-notifi');
// 			Route::get('destroy/{id}', 'AdminController@destroyNotification')->name('destroy-notifi');
// 			Route::get('list', 'AdminController@notifications')->name('list-notifi');
// 			Route::get('create', 'AdminController@create_notification')->name('create-notifi');
// 			Route::post('send', 'AdminController@send_notification')->name('send-notifi');
// 			Route::post('sendbillnotifi/{id}', 'AdminController@send_bill_notification')->name('send-billnotifi');
// 			Route::post('show/{id}', 'AdminController@showNotification')->name('show-notifi');

// 			Route::get('billnotifi/{id}', 'AdminController@bill_notifications')->name('bill-notifi');
//     });
//     Route::group(['prefix'=>'calculateBill'], function()
// 		{	
// 			Route::get('edit/{id}', 'AdminController@editCalculateBill')->name('edit-calBill');
// 			Route::post('update/{id}', 'AdminController@updateCalculateBill')->name('update-calBill');
// 			Route::get('destroy/{id}', 'AdminController@destroyCalculateBill')->name('destroy-calBill');
// 			Route::get('list', 'AdminController@calculate_bills')->name('list-calBill');
// 			Route::get('create/{id}', 'AdminController@create_calculate_bill')->name('create-calBill');
//             Route::post('store/{id}', 'AdminController@store_calculate_bill')->name('store-calBill');
// 			Route::get('show/{id}', 'AdminController@show_bill')->name('show-Bill');

// 			// xem list theo loại hóa đơn
// 			Route::get('showe', 'AdminController@show_bill_electric')->name('show-BillE');
// 			Route::get('showw', 'AdminController@show_bill_water')->name('show-BillW');
// 			Route::get('showc', 'AdminController@show_bill_car')->name('show-BillC');

// 			// xem list theo loại hóa đơn đã thanh toán
// 			Route::get('showepaid', 'AdminController@show_bill_electric_paid')->name('show-BillE-paid');
// 			Route::get('showwpaid', 'AdminController@show_bill_water_paid')->name('show-BillW-paid');
// 			Route::get('showcpaid', 'AdminController@show_bill_car_paid')->name('show-BillC-paid');

// 			// xem list theo loại hóa đơn chưa thanh toán
// 			Route::get('showenotpaid', 'AdminController@show_bill_electric_not_paid')->name('show-BillE-notpaid');
// 			Route::get('showwnotpaid', 'AdminController@show_bill_water_not_paid')->name('show-BillW-notpaid');
// 			Route::get('showcnotpaid', 'AdminController@show_bill_car_not_paid')->name('show-BillC-notpaid');

// 			// xem chi tiết theo từng loại hóa đơn 
// 			Route::get('showedetail/{id}', 'AdminController@show_bill_electric_detail')->name('show-BillE-detail');
// 			Route::get('showwdetail/{id}', 'AdminController@show_bill_water_detail')->name('show-BillW-detail');
// 			Route::get('showcdetail/{id}', 'AdminController@show_bill_car_detail')->name('show-BillC-detail');

// 			Route::get('paye/{id}', 'AdminController@pay_bill_electric')->name('paye');
// 			Route::get('payw/{id}', 'AdminController@pay_bill_water')->name('payw');
// 			Route::get('payc/{id}', 'AdminController@pay_bill_car')->name('payc');

// 			Route::get('statistical', 'AdminController@total_money')->name('statistical');
//     });

// });

// Route::get('/customer','CustomerController@customer')->name('customer-page');

// Route::group(['prefix'=>'cutomer'], function()
// {
// 	Route::group(['prefix'=>'profile'], function()
// 		{	
//             Route::get('show/{id}', 'CustomerController@showInfo')->name('show-info-cus');
// 		});
// 	Route::group(['prefix'=>'bill'], function()
// 		{	
//             Route::get('show/{id}', 'CustomerController@showBill')->name('show-bill-cus');
//         });
//     Route::group(['prefix'=>'notification'], function()
//     {	
//         Route::get('list/{id}', 'CustomerController@listNotification')->name('list-notifi-cus');
//         Route::get('read/{id}', 'CustomerController@readNotification')->name('read-notifi-cus');
//     });
//     Route::group(['prefix'=>'comment'], function()
// 		{	
// 			Route::get('edit/{id}', 'CustomerController@editComment')->name('edit-cmt');
// 			Route::post('update/{id}', 'CustomerController@updateComment')->name('update-cmt');
// 			Route::get('destroy/{id}', 'CustomerController@destroyComment')->name('destroy-cmt');
// 			Route::get('list/{id}', 'CustomerController@listComment')->name('list-cmt');
// 			Route::post('create/{idCus?}/{idBillE?}/{idBillW?}/{idBillC?}', 'CustomerController@createComment')->name('create-cmt');
//             Route::post('store/{id}', 'CustomerController@storeComment')->name('store-cmt');
//             Route::post('show/{id}', 'CustomerController@showComment')->name('show-cmt');
//     });
//     Route::group(['prefix'=>'messages'], function()
// 		{	
// 			Route::get('edit/{id}', 'CustomerController@editMessages')->name('edit-mes-cus');
// 			Route::post('update/{id}', 'CustomerController@updateMessages')->name('update-mes-cus');
// 			Route::get('destroy/{id}', 'CustomerController@destroyMessages')->name('destroy-mes-cus');
// 			Route::get('list/{id}', 'CustomerController@listMessages')->name('list-mes-cus');
// 			Route::get('create/{id?}/{title?}', 'CustomerController@createMessages')->name('create-mes-cus');
//             Route::post('send', 'CustomerController@sendMessages')->name('send-mes-cus');
//             Route::get('read/{id}', 'CustomerController@readMessages')->name('read-mes-cus');
//     });
 
// });

// Route::redirect('/', '/login');
// Route::redirect('/home', '/admin');
// Auth::routes(['register' => false]);
Auth::routes();
// phần standard
// Route Admin
//Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminHomeController@index')->name('home');
    // Bills
    //Route::delete('bills/destroy', 'BillsController@massDestroy')->name('bills.massDestroy'); // route cho các other function 
    Route::get('/bills/show/electric', 'BillsController@showBillElectric')->name('show-bill-electric');
    Route::get('/bills/show/water', 'BillsController@showBillWater')->name('show-bill-water');
    Route::get('/bills/show/vehicle', 'BillsController@showBillVehicle')->name('show-bill-vehicle');
    Route::get('/bills/createBill/{customerID}', 'BillsController@createBill')->name('create-bill');
    Route::resource('bills', 'BillsController');

    // Messages
    //Route::delete('messages/destroy', 'MessagesController@massDestroy')->name('messages.massDestroy'); // route cho các other function
    Route::resource('messages', 'MessagesController');

    // Notifications
    //Route::delete('notifications/destroy', 'Notifications@massDestroy')->name('notifications.massDestroy');
    Route::resource('notifications', 'NotificationsController');

    // Users
    //Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Customers
    // Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    // Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::resource('customers', 'CustomersController');

    // Family Members
    Route::get('/familyMembers/create/{customerId}', 'FamilyMembersController@createMember')->name('family-member-create');
    Route::post('/familyMembers/save/{customerId}', 'FamilyMembersController@saveMember')->name('family-member-save');
    Route::resource('familyMembers', 'FamilyMembersController');

    // Comment
    Route::resource('comments', 'CommentsController');

    // Thống kê
    Route::resource('statisticals', 'StatisticalsController');

    // SystemCalendar
    // Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    // Route::resource('appointments', 'AppointmentsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});

// Route Customer
Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Bills
    //Route::delete('bills/destroy', 'BillsController@massDestroy')->name('bills.massDestroy'); // route cho các other function 
    Route::resource('bills', 'BillsController');

    // Messages
    //Route::delete('messages/destroy', 'MessagesController@massDestroy')->name('messages.massDestroy'); // route cho các other function
    Route::resource('messages', 'MessagesController');

    // Notifications
    //Route::delete('notifications/destroy', 'Notifications@massDestroy')->name('notifications.massDestroy');
    Route::resource('notifications', 'NotificationsController');

    // Users
    //Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Customers
    // Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    // Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::resource('customers', 'CustomersController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // SystemCalendar
    // Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    // Route::resource('appointments', 'AppointmentsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});

