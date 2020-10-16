<?php

use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login')->name('login');
Route::get('/home', function(){
    return view('home');
});
//Route::redirect('/home', '/admin');
// Auth::routes(['register' => false]);
Auth::routes();
// phần standard 
// Route Admin
//Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/home', 'AdminHomeController@index')->name('home');

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

    Route::post('/bills/updateStatusPaid/{billId?}/{typeBill?}', 'BillsController@updateStatusPaid')->name('update-status-paid');

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
    Route::get('comments/duyetlist', 'CommentsController@duyetComments')->name('comment-list-duyet');
    Route::get('comments/create/{id}', 'CommentsController@create_comment')->name('comment-create');
    Route::post('comments/send/{id}', 'CommentsController@send_comment')->name('comment-send');
    Route::get('comments/read/{id}', 'CommentsController@read_comment')->name('comment-read');
    Route::get('comments/delete/{id}', 'CommentsController@destroy_comment')->name('comment-delete');

    // Thống kê
    // Thống kê theo loại phí dịch vụ ( của tất cả khách hàng) ( mặc định là từ trước đến nay - có thể tùy chọn tháng)
    Route::post('statistical/{byMonthOrByMonthToMonth}', 'StatisticalsController@statistical')->name('statistical');

    Route::get('statisticals-month-to-month', 'StatisticalsController@statisticalMonthToMonth')->name('statistical-month-to-month');
    
    // Thống kê theo loại phí dịch vụ của một khách hàng nào đó ( mặc định là từ trước đến nay - có thể tùy chọn tháng)
    Route::get('statisticals/electric/{customerId}', 'StatisticalsController@electricStatisticalCustomer')->name('statisticals-electric');
    Route::get('statisticals/water/{customerId}', 'StatisticalsController@waterStatisticalCustomer')->name('statisticals-water');
    Route::get('statisticals/vihicle/{customerId}', 'StatisticalsController@vehicleStatisticalCustomer')->name('statisticals-vehicle');

    Route::resource('statisticals', 'StatisticalsController');
});

// Route Customer
Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth']], function () {
    Route::get('/home', 'CustomerHomeController@index')->name('home');
    // Bills
    Route::get('allbills/{customerId}/{billMonth?}/{billYear?}', 'BillsController@allBills')->name('list-bills');
    Route::get('historybills/{customerId}', 'BillsController@historyBills')->name('history-bills');
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
    Route::get('info/{customerId}', 'CustomerHomeController@showInfo')->name('customer-info');

    //Comment
    Route::post('createcomment/{customerId?}/{idBillE?}/{idBillW?}', 'CommentsController@createComment')->name('create-cmt');
});

