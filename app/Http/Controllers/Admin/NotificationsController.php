<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\Notification;
use App\Models\NotificationCustomer;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::select('*')->where('id', '>', 1)->get();
        $notifications = Notification::get();
        $notificationCustomer = NotificationCustomer::get();
        return view('admin.notification.listNotification', compact('customers', 'notifications', 'notificationCustomer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get();
        return view('admin.notification.createNotification', compact('customers'));
    }

    public function createNotificationForBill($billId){
        $bill = Bill::find($billId);
        $customer = Customer::find($bill->customer_id);
        return view('admin.notification.createBillNotification', compact('bill', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request -> title;
        $content = $request -> content;
        $selectCustomer = $request -> selectCustomer;
        $customers = Customer::get();
        if($selectCustomer == 99999){
            $notification = new Notification();
            $notification -> title = $title;
            $notification -> content = $content;
            $notification -> scope = 99999;
            $notification -> save();
            foreach($customers as $customer){
                $customer->notifications()->attach($notification);   
            }
        }
        else {
            $notification = new Notification();
            $notification -> title = $title;
            $notification -> content = $content;
            $notification -> scope = 1;
            $notification -> save();
            $customer = Customer::find($selectCustomer);
            $customer->notifications()->attach($notification); 
        }
        //return view('admin.notification.createNotification', compact('customers'))-> with(['success'=>'Gửi thông báo thành công!!!']);
        return redirect() -> route('admin.notifications.index') -> with(['success'=>'Gửi thông báo thành công!!!']);
    }

    public function sentNotificationForBill($billId, Request $request)
    {
        $bill = Bill::find($billId);

        $title = $request -> title;
        $content = $request -> content;

        $notification = new Notification();
        $notification -> title = $title;
        $notification -> content = $content;
        $notification -> scope = 1;
        $notification -> save();

        $customer = Customer::find($bill -> customer_id);
        $customer->notifications()->attach($notification, [ 'bill_id' => $bill -> id]); 

        return redirect()->back()-> with(['success'=>'Gửi thông báo thành công!!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
