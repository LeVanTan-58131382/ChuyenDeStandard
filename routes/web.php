<?php

use Illuminate\Support\Facades\Route;


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

    // Setting
    Route::get('/setting', 'SettingController@getSetting')->name('get-setting');
    Route::post('/setting', 'SettingController@postSetting')->name('post-setting');

    // Bills
    //Route::delete('bills/destroy', 'BillsController@massDestroy')->name('bills.massDestroy'); // route cho các other function 
    Route::get('/bills/show/{type}', 'BillsController@showBill')->name('show-bill');
    
    Route::get('/bills/exported/{status}', 'BillsController@exportedBill')->name('exported-bill');

    Route::get('/bills/show/notpaid/{type}', 'BillsController@showBillNotPaid')->name('show-bill-notpaid');

    Route::get('/bills/show/paid/{type}', 'BillsController@showBillPaid')->name('show-bill-paid');

    Route::get('/bills/detail/{type?}/{billID?}', 'BillsController@showBillDetail')->name('show-bill-detail');

    Route::get('/bills/createBill/{customerID}', 'BillsController@createBill')->name('create-bill');
    Route::post('/bills/storeBill/{customerID}', 'BillsController@storeBill')->name('store-bill');
    
    //Route::get('/bills/importElectric', 'BillsController@getloadFile')->name('getimport');
    Route::post('/bills/importWater', 'BillsController@postloadFileWater')->name('post-import-water');
    Route::post('/bills/importElectric', 'BillsController@postloadFileElectric')->name('post-import-electric');

    Route::resource('bills', 'BillsController');

    // Messages
    //Route::resource('messages', 'MessagesController');
    Route::get('destroy/{id}', 'MessagesController@destroy_message')->name('destroy-messages');
    Route::get('list', 'MessagesController@messages')->name('list-messages');
    Route::get('create/{id?}/{title?}', 'MessagesController@create_message')->name('create-messages');
    Route::post('send', 'MessagesController@send_message')->name('send-messages');
    Route::get('read/{id}', 'MessagesController@read_message')->name('read-messages');

    // Notifications
    //Route::delete('notifications/destroy', 'Notifications@massDestroy')->name('notifications.massDestroy');
    Route::post('notifications/bill/sent{billId}', 'NotificationsController@sentNotificationForBill')->name('send-bill-notification');
    Route::get('notifications/bill/{billId}', 'NotificationsController@createNotificationForBill')->name('create-bill-notification');
    Route::resource('notifications', 'NotificationsController');

    // Users
    //Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Customers
    Route::resource('customers', 'CustomersController');

    // Family Members
    Route::get('/familyMembers/create/{customerId}', 'FamilyMembersController@createMember')->name('family-member-create');
    Route::post('/familyMembers/save/{customerId}', 'FamilyMembersController@saveMember')->name('family-member-save');
    Route::resource('familyMembers', 'FamilyMembersController');

    // Comment
    Route::get('comments/list', 'CommentsController@comments')->name('comment-list');
    Route::get('comments/create/{id}', 'CommentsController@create_comment')->name('comment-create');
    Route::post('comments/send/{id}', 'CommentsController@send_comment')->name('comment-send');
    Route::get('comments/read/{id}', 'CommentsController@read_comment')->name('comment-read');
    Route::get('comments/delete/{id}', 'CustomerController@destroy-comment')->name('comment-delete');

    // Thống kê
    // Thống kê theo loại phí dịch vụ ( của tất cả khách hàng) ( mặc định là từ trước đến nay - có thể tùy chọn tháng)
    Route::post('statistical', 'StatisticalsController@statistical')->name('statistical');

    Route::get('statisticals-month-to-month', 'StatisticalsController@statisticalMonthToMonth')->name('statistical-month-to-month');
    
    // Thống kê theo loại phí dịch vụ của một khách hàng nào đó ( mặc định là từ trước đến nay - có thể tùy chọn tháng)
    Route::get('statisticals/electric/{customerId}', 'StatisticalsController@electricStatisticalCustomer')->name('statisticals-electric');
    Route::get('statisticals/water/{customerId}', 'StatisticalsController@waterStatisticalCustomer')->name('statisticals-water');
    Route::get('statisticals/vihicle/{customerId}', 'StatisticalsController@vehicleStatisticalCustomer')->name('statisticals-vehicle');

    Route::resource('statisticals', 'StatisticalsController');
});

// Route Customer
Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth']], function () {
    Route::get('/', 'CustomerHomeController@index')->name('home');
    // Bills
    Route::get('allbills/{customerId}', 'BillsController@allBills')->name('customer-bills-index');

    // Messages
    Route::get('messages/{id}', 'MessagesController@messages')->name('list-messages');
    Route::get('destroy/{id}', 'MessagesController@destroy_message')->name('destroy-messages');
    // Route::get('list', 'MessagesController@messages')->name('list-messages');
    Route::get('create/{title?}', 'MessagesController@create_message')->name('create-messages');
    Route::post('send', 'MessagesController@send_message')->name('send-messages');
    Route::get('read/{id}', 'MessagesController@read_message')->name('read-messages');

    // Notifications
    Route::get('notifications/{customerId}', 'NotificationsController@allNotifications')->name('list-notifications');
    Route::get('notification/read/{notificationId}', 'NotificationsController@readNotifications')->name('read-notifications');

    // Users
    Route::resource('users', 'UsersController');

    // Customers
    Route::get('info/{customerId}', 'CustomerController@showInfo')->name('customer-info');

    //Comment
    Route::post('createcomment/{customerId?}/{idBillE?}/{idBillW?}', 'CommentsController@createComment')->name('create-cmt');
});

