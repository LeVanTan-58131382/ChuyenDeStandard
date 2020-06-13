<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\NotificationCustomer;

class NotificationsController extends Controller
{
    
    public function allNotifications($customerId)
    {
        $notifications = Notification::get();
        $notificationUser = NotificationCustomer::where('customer_id', $customerId)->orderBy('created_at', 'DESC')->get();
        return view('customer.notification.notification', compact('notifications', 'notificationUser'));
    }

    public function readNotifications($notificationId){
        $notification = Notification::find($notificationId);
        $notificationUser = NotificationCustomer::where([['notification_id', '=', $notificationId],
                                                         ['customer_id', '=', Auth::id()]])->get();
        $customers = Customer::get();

        foreach($notificationUser as $notifiu){
            $notifiu -> read = true;
            $notifiu -> save();
        }
        return view('customer.notification.readNotification', compact('notification', 'customers', 'notificationUser'));
    }

}
