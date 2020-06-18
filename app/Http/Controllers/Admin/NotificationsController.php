<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\Notification;
use App\Models\NotificationCustomer;
use App\Models\SystemCalendar;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1);
        $customers = Customer::select('*')->where('id', '>', 1)->get();
        $notifications = Notification::get();
        $notificationCustomer = NotificationCustomer::get();
        return view('admin.notification.listNotification', compact('customers', 'notifications', 'notificationCustomer', 'calendar'));
    }

    public function create()
    {
        $calendar = SystemCalendar::find(1);
        $customers = Customer::get();
        return view('admin.notification.createNotification', compact('customers', 'calendar'));
    }

    public function createNotificationForBill($billId){
        $calendar = SystemCalendar::find(1);
        $bill = Bill::find($billId);
        $customer = Customer::find($bill->customer_id);
        return view('admin.notification.createBillNotification', compact('bill', 'customer', 'calendar'));
    }

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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        //$notificationCustomer = NotificationCustomer::where(['notification_id', '=', $notification->id])->delete();
        // Xóa record trong bảng customer_notification
        DB::connection('mysql')->delete("delete from customer_notification where notification_id = ?", [$notification->id]);
        return redirect()->back()->with('success', 'Xóa thông báo thành công!');
    }
}
