<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\ConsumptionIndex;
use App\Models\VehicleUser;
use App\Models\VehiclePrice;
use App\Models\Bill;
use App\Models\NotificationUser;
use App\Models\Notification;
use App\Models\Comment;
use App\Models\Message;
use App\User;
use App\Models\PriceRegulation;
use App\Models\UsageNormInvestors;


class CustomerController extends Controller
{

    public function __construct()
    { 
        $this->middleware('auth');
        // $this->middleware( , ['except' => ['login']]);
    }

    public function customer(Request $request)
    {
        if($request->user()->authorizeRoles(['customer', 'admin']))
        {
            return view('customer.home');
        }
        else {
            return view('home');
        }
    }

    public function showInfo($id){
        $user = User::findOrFail($id);
        $apartment = User::find($id)->apartment;
        return view('customer.profile.profile')->with('user', $user)->with('apartment', $apartment);
    }

    public function showBill($id)
    {
        $bills = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->get();
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if($bills->isEmpty()){
            return view('customer.bill.billnotexported');
        }
        $consumptionIndex_E = ConsumptionIndex::select('*')->where('user_id', $id)->where('month_consumption', 5)->where('living_expenses_type_id', 1)->get();
        $consumptionIndex_W = ConsumptionIndex::select('*')->where('user_id', $id)->where('month_consumption', 5)->where('living_expenses_type_id', 2)->get();
        $vehicles = VehicleUser::select('*')->where('user_id', $id)->get();
        $vehicles_prices = VehiclePrice::get();
        $billElectric = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 1)->get();
        $billWater = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 2)->get();
        $billCar = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 3)->get();

        $price_regulation = PriceRegulation::get();
        $usage_norm = UsageNormInvestors::get();

        $idBillE = 0;
        $idBillW = 0;
        $idBillC = 0;
        foreach($billElectric as $bill){
            $idBillE = $bill->id;
        }
        foreach($billWater as $bill){
            $idBillW = $bill->id;
        }
        foreach($billCar as $bill){
            $idBillC = $bill->id;
        }
        $strIdBill = $idBillE.'-'.$idBillW.'-'.$idBillC;
        $comments = Comment::select('*')->where('bill_id', $strIdBill)->orderBy('created_at', 'asc')->get();
        return view('customer.bill.bill', compact( 'comments', 'consumptionIndex_E', 'consumptionIndex_W', 'billElectric', 'billWater', 'billCar', 'price_regulation', 'vehicles', 'vehicles_prices', 'usage_norm'));
    }


    public function listNotification($id){
        $notifications = Notification::get();
        $notificationUser = NotificationUser::select('*')->where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('customer.notification.notification', compact('notifications', 'notificationUser'));
    }
    public function readNotification($id){
        $notification = Notification::find($id);
        $notificationUser = NotificationUser::select('*')->where('notifi_id', $id)->where('user_id', Auth::id())->get();
        $users = User::get();

        foreach($notificationUser as $notifiu){
            $notifiu -> read = true;
            $notifiu -> save();
        }
        return view('customer.notification.readNotification', compact('notification', 'users', 'notificationUser'));
    }
    //
    public function listMessages(){
        $user = User::find(Auth::id());

        $messages = Message::select('*')->where('user_id_to', '=', Auth::id())
                                        ->orWhere('user_id_to', '=', Auth::id())
                                        ->notDeleted()->orderBy('created_at', 'DESC')->get();
        return view('customer.message.listMessages', compact('user', 'messages'));
    }

    public function createMessages(int $id = 0, String $title = '') {
        if ($id === 0) {
            $users = User::where('id', '!=', Auth::id())->get(); // lấy danh sách user trừ admin - trường hợp tạo mới tin nhắn
        } else {
            $users = User::where('id', $id)->get(); // trường hợp trả lời tin nhắn
        }

        if ($title !== '') $title =  $title;

        return view('customer.message.createMessages')->with(['users' => $users, 'title' => $title]);
    }

    public function sendMessages(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $message = new Message();
        $message->user_id_from = Auth::id();
        $message->user_id_to = 1; // gửi cho ad
        $message->title = $request->title;
        $message->content = $request->content;
        $message->save();

        return redirect()->back()->with('success', 'Gửi tin nhắn thành công!');
    }

    public function readMessages($id)
    {
        $message = Message::with('userFrom')->find($id);
        $message->read = true;
        $message->save();

        return view('customer.message.readMessages')->with('message', $message);
    }

    public function destroyMessages($id)
    {
        $message = Message::find($id);
        $message->deleted = true;
        $message->save();

        $user = User::find(Auth::id());

        $messages = Message::select('*')->where('user_id_to', '=', Auth::id())
                                        ->orWhere('user_id_to', '=', Auth::id())
                                        ->notDeleted()->orderBy('created_at', 'DESC')->get();
        
        return view('customer.message.listMessages', compact('user', 'messages'))->with('success', 'Xóa tin nhắn thành công!');
    }

    public function createComment($idCus, $idBillE, $idBillW, $idBillC, Request $request){
        $comment = new Comment();
        $comment -> user_id = $idCus;
        $comment -> title = $request -> title;
        $comment -> content = $request -> content;
        $comment -> bill_id = $idBillE.'-'.$idBillW.'-'.$idBillC;
        $comment -> save();
        return redirect()->back()->with('success', 'Gửi phản hồi thành công!');
    }
}
