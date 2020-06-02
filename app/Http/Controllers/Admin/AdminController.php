<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsageNormInvestors;
use App\Http\Requests\UserRequest;
use App\Models\ConsumptionIndex;
use App\Models\NotificationUser;
use App\Models\ApartmentAddress;
use App\Models\PriceRegulation;
use App\Models\Notification;
use App\Models\VehiclePrice;
use App\Models\VehicleUser;
use App\Models\Statistical;
use App\Models\Message;
use App\Models\Comment;
use App\Models\Bill;
use App\User;
use Validator;

class AdminController extends Controller
{

    public function __construct()
    { 
        $this->middleware('auth');
    }
    
    public function admin(Request $request)
    {
        if(!$request->user()->authorizeRoles(['admin']))
        {
            return view('home');
        }
        else {
            return view('admin.home'); 
        }
    } 
    
    public function customers()
    {
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.customer.listCustomer')->with('listUsers', $listUsers)->with('apartments', $apartments);
    }
    
    public function create_customer()
    {
        return view('admin.customer.createCustomer');
    }

    public function store_customer(Request $request, UserRequest $uRequest)
    {
        // Nếu người dùng chọn địa chỉ đã tồn tại và có người thuê thì báo lỗi -> rơi vào trường hợp 2
        if(ApartmentAddress::addForUserAndCreateUser($request, $uRequest) == 1){
            return redirect() -> route('create-cus') -> withErrors(['errors'=>'Không thể tạo khách hàng vì địa chỉ đã có người thuê!!!']);
        }
        ApartmentAddress::addForUserAndCreateUser($request, $uRequest); // rơi vào trường hợp 1
        return redirect() -> route('list-cus') -> with(['success'=>'Thêm khách hàng thành công!!!']);
    }

    public function show_customer($id)
    {
        $user = User::findOrFail($id);
        $apartment = User::find($id)->apartment;
        return view('admin.customer.detailCustomer')->with('user', $user)->with('apartment', $apartment);
    }

    public function edit_customer($id)
    {
        $user = User::findOrFail($id);
        $apartment = User::find($id)->apartment;
        return view('admin.customer.editCustomer')->with('user', $user)->with('apartment', $apartment);
    }

    public function update_customer(Request $request, $id)
    {
        //
    }

    public function destroy_customer($id)
    {
        $user = User::findOrFail($id);
        $user -> delete();
        return redirect() -> route('list-cus') -> with(['success'=>'Xóa khách hàng thành công!!!']);
    }

    public function messages(){
        $users = User::get();
        $messages = Message::with('userFrom')->notDeleted()->get();
        return view('admin.message.listMessages', compact('users', 'messages'));
    }

    public function create_message(int $id = 0, String $title = '') {
        if ($id === 0) {
            $users = User::where('id', '!=', Auth::id())->get(); // lấy danh sách user trừ admin - trường hợp tạo mới tin nhắn
        } else {
            $users = User::where('id', $id)->get(); // trường hợp trả lời tin nhắn
        }
        if ($title !== ''){
            $pos = strpos($title, "Trả lời:");
            
            if($pos == false) // nếu tiêu đề chưa có từ Trả lời
            {
                $title = $title;
            }
            else {
                $title = 'Trả lời: ' .$title;
            }
        } 
        return view('admin.message.createMessages')->with(['users' => $users, 'title' => $title]);
    }

    public function send_message(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $message = new Message();
        $message->user_id_from = Auth::id();
        $message->user_id_to = $request->to;
        $message->title = $request->title;
        $message->content = $request->content;
        $message->save();
        return redirect()->back()->with('success', 'Gửi tin nhắn thành công!');
    }

    public function read_message($id)
    {
        $message = Message::with('userFrom')->find($id);
        $message->read = true;
        $message->save();
        return view('admin.message.readMessages')->with('message', $message);
    }

    public function destroy_message($id)
    {
        $message = Message::find($id);
        $message->deleted = true;
        $message->save();
        $users = User::get();
        $messages = Message::with('userFrom')->notDeleted()->get();
        return view('admin.message.listMessages', compact('users', 'messages'))->with('success', 'Xóa tin nhắn thành công!');
    }

    public function notifications()
    {
        $users = User::select('*')->where('id', '>', 1)->get();
        $notifications = Notification::get();
        $notificationUser = NotificationUser::get();
        return view('admin.notification.listNotification', compact('notifications', 'notificationUser', 'users'));
    }

    public function create_notification()
    {
        $users = User::get();
        return view('admin.notification.createNotification', compact('users'));
    }

    public function send_notification(Request $request)
    {
        $input = $request->all(); // lấy tất cả các input đầu vào
        $this->rules =[
            "title" => "required",
            'content' => 'required',
        ];
        $validate = Validator::make($input, $this->rules);
        if($validate->fails()){

            return redirect()->back()->withErrors($validate->errors())->withInput(); // trả về view add với thông báo lỗi
        }
        $title = $request -> title;
        $content = $request -> content;
        $selectUser = $request -> selectUser;
        $users = User::get();
        if($selectUser == 99999){
            $notifi = new Notification();
            $notifi -> title = $title;
            $notifi -> content = $content;
            $notifi -> scope = 0;
            $notifi -> save();
            foreach($users as $user){
                $notifiUser = new NotificationUser();
            $notifiUser -> user_id = $user -> id;
            $notifiUser -> notifi_id = $notifi -> id;
            $notifiUser -> save();
            }
        }
        else {
            $notifi = new Notification();
            $notifi -> title = $title;
            $notifi -> content = $content;
            $notifi -> scope = 1;
            $notifi -> save();
            foreach($users as $user)
            {
                if( $user -> id == $selectUser){
                    $notifiUser = new NotificationUser();
                    $notifiUser -> user_id = $user -> id;
                    $notifiUser -> notifi_id = $notifi -> id;
                    $notifiUser -> save();
                }
            }
        }
        return view('admin.notification.createNotification', compact('users'))-> with(['success'=>'Gửi thông báo thành công!!!']);
    }

    public function bill_notifications($id){
        $bill = Bill::find($id);
        $user = User::find($bill->user_id);
        return view('admin.notification.createBillNotification', compact('bill', 'user'));
    }

    public function send_bill_notification($id, Request $request){
        $bill = Bill::find($id);

        $title = $request -> title;
        $content = $request -> content;

        $notifi = new Notification();
        $notifi -> title = $title;
        $notifi -> content = $content;
        $notifi -> scope = 1;
        $notifi -> save();

        $notifiUser = new NotificationUser();
        $notifiUser -> user_id = $bill -> user_id;
        $notifiUser -> notifi_id = $notifi -> id;
        $notifiUser -> bill_id = $id;
        $notifiUser -> save();

        return redirect()->back()-> with(['success'=>'Gửi thông báo thành công!!!']);
    }

    public function showNotification($id)
    {
        //
    }

    public function editNotification($id)
    {
        //
    }

    public function updateNotification(Request $request, $id)
    {
        //
    }

    public function destroyNotification($id)
    {
        //
    }

    public function calculate_bills()
    {
        $bills = Bill::get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.index', compact('listUsers', 'apartments', 'bills'));
    }

    public function create_calculate_bill($id)
    {
        $bills = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->get();
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if(!$bills->isEmpty()){
            return view('admin.paymentForServices.billexported');
        }
        $price_regulation_elects = PriceRegulation::select('*')->where('living_expenses_type_id', 1)->get();
        $price_regulation_waters = PriceRegulation::select('*')->where('living_expenses_type_id', 2)->get();
        $price_regulation_cars = PriceRegulation::select('*')->where('living_expenses_type_id', 3)->get();
        $user_id = $id;
        $vehicles = User::find($id)->vehicle;
        return view('admin.paymentForServices.detailPayment', compact('price_regulation_elects', 'price_regulation_waters', 'price_regulation_cars', 'vehicles', 'user_id'));
    }

    public function store_calculate_bill(Request $request, $id)
    {
        $consumptionIndex_E_old = $request -> consumptionIndex_E_old;
        $consumptionIndex_E_new = $request -> consumptionIndex_E_new;
        $consumptionIndex_W_old = $request -> consumptionIndex_W_old;
        $consumptionIndex_W_new = $request -> consumptionIndex_W_new; 

        $input = $request->all(); 
        $this->rules =[
            "consumptionIndex_E_old" => "required",
            "consumptionIndex_E_new" => "required",
            "consumptionIndex_W_old" => "required",
            "consumptionIndex_W_new" => "required"
        ];
        $validate = Validator::make($input, $this->rules);
        
        if($consumptionIndex_E_old > $consumptionIndex_E_new || $consumptionIndex_W_old > $consumptionIndex_W_new){
            return redirect()->back()->withErrors(['errors'=>'Một hoặc nhiều chỉ số bạn nhập chưa chính xác!!!']);
        }
        if($validate->fails()){

            return redirect()->back()->withErrors(['errors'=>'Một hoặc nhiều chỉ số bạn chưa nhập!!!']);
        }

        Bill::addBill($request, $id);
        return redirect() -> route('list-calBill') -> with(['success'=>'Xóa hóa đơn thành công!!!']);
    }
    
    public function show_bill($id)
    {
        $bills = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->get();
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if($bills->isEmpty()){
            return view('admin.paymentForServices.billnotexported');
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
        return view('admin.paymentForServices.bill', compact('consumptionIndex_E', 'consumptionIndex_W', 'billElectric', 'billWater', 'billCar', 'price_regulation', 'vehicles', 'vehicles_prices', 'usage_norm'));
    }

    public function show_bill_electric(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 1)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billElectric')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }
    public function show_bill_water(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 2)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billWater')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }
    public function show_bill_car(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 3)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billCar')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }

    public function show_bill_electric_paid(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 1)->where('paid', 1)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billElectric')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }
    public function show_bill_water_paid(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 2)->where('paid', 1)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billWater')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }
    public function show_bill_car_paid(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 3)->where('paid', 1)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billCar')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }
    public function show_bill_electric_not_paid(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 1)->where('paid', 0)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billElectric')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }
    public function show_bill_water_not_paid(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 2)->where('paid', 0)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billWater')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }
    public function show_bill_car_not_paid(){
        $bills = Bill::select('*')->where('living_expenses_type_id', 3)->where('paid', 0)->get();
        $listUsers = User::select('*')->where('id', '>', 1)->paginate(10);
        $apartments = ApartmentAddress::get();
        return view('admin.paymentForServices.billCar')->with('listUsers', $listUsers)->with('apartments', $apartments)->with('bills', $bills);
    }

    public function show_bill_electric_detail($id){
        $bills = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->get();
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if($bills->isEmpty()){
            return view('admin.paymentForServices.billnotexported');
        }
        $consumptionIndex_E = ConsumptionIndex::select('*')->where('user_id', $id)->where('month_consumption', 5)->where('living_expenses_type_id', 1)->get();
        $billElectric = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 1)->get();

        $price_regulation = PriceRegulation::get();
        $usage_norm = UsageNormInvestors::get();
        return view('admin.paymentForServices.detailBillElectric', compact('consumptionIndex_E', 'billElectric', 'price_regulation', 'usage_norm'));
    }
    public function show_bill_water_detail($id){
        $bills = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->get();
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if($bills->isEmpty()){
            return view('admin.paymentForServices.billnotexported');
        }
        $consumptionIndex_W = ConsumptionIndex::select('*')->where('user_id', $id)->where('month_consumption', 5)->where('living_expenses_type_id', 2)->get();
        $billWater = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 2)->get();

        $price_regulation = PriceRegulation::get();
        $usage_norm = UsageNormInvestors::get();
        return view('admin.paymentForServices.detailBillWater', compact('consumptionIndex_W', 'billWater', 'price_regulation', 'usage_norm'));
    }
    public function show_bill_car_detail($id){
        $bills = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->get();
        // nếu khách hàng đạ dc xuất hóa đơn cho tháng 5 thì không xuất nữa
        if($bills->isEmpty()){
            return view('admin.paymentForServices.billnotexported');
        }
        $vehicles = VehicleUser::select('*')->where('user_id', $id)->get();
        $vehicles_prices = VehiclePrice::get();
        $billCar = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 3)->get();

        $price_regulation = PriceRegulation::get();
        return view('admin.paymentForServices.detailBillCar', compact( 'billCar', 'price_regulation', 'vehicles', 'vehicles_prices'));
    }

    public function editCalculateBill($id)
    {
        //
    }

    public function updateCalculateBill(Request $request, $id)
    {
        //
    }

    public function destroyCalculateBill($id)
    {
        
        
    }

    public function pay_bill_electric($id)
    {
        $bill = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 1)->get();
        $statistical = Statistical::select('*')->where('month', 5)->where('living_expenses_type_id', 1)->get();
        foreach( $bill as $b)
        {
            $b->paid = 1;
            $b->save();
            foreach($statistical as $s){
               $s -> total_price += $b ->money_to_pay;
               $s -> save();
            }
        }
        return redirect()->back()-> with(['success'=>'Khách hàng thanh toán thành công!!!']);
    }
    public function pay_bill_water($id)
    {
        $bill = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 2)->get();
        $statistical = Statistical::select('*')->where('month', 5)->where('living_expenses_type_id', 2)->get();
        foreach( $bill as $b)
        {
            $b->paid = 1;
            $b->save();
            foreach($statistical as $s){
               $s -> total_price += $b ->money_to_pay;
               $s -> save();
            }
        }
        return redirect()->back()-> with(['success'=>'Khách hàng thanh toán thành công!!!']);
    }
    public function pay_bill_car($id)
    {
        $bill = Bill::select('*')->where('user_id', $id)->where('payment_month', 5)->where('living_expenses_type_id', 3)->get();
        $statistical = Statistical::select('*')->where('month', 5)->where('living_expenses_type_id', 3)->get();
        foreach( $bill as $b)
        {
            $b->paid = 1;
            $b->save();
            foreach($statistical as $s){
               $s -> total_price += $b ->money_to_pay;
               $s -> save();
            }
        }
        return redirect()->back()-> with(['success'=>'Khách hàng thanh toán thành công!!!']);
    }
    public function total_money(){
        
        $totalmoneyE = 0;
        $totalmoneyW = 0;
        $totalmoneyC = 0;

        $statisticalE = Statistical::select('*')->where('month', 5)->where('living_expenses_type_id', 1)->get();
        $statisticalW = Statistical::select('*')->where('month', 5)->where('living_expenses_type_id', 2)->get();
        $statisticalC = Statistical::select('*')->where('month', 5)->where('living_expenses_type_id', 3)->get();
        
        foreach($statisticalE as $s){
            $totalmoneyE = $s -> total_price;
        }
        foreach($statisticalW as $s){
            $totalmoneyW = $s -> total_price;
        }
        foreach($statisticalC as $s){
            $totalmoneyC = $s -> total_price;
        }
        return view('admin.paymentForServices.statistical', compact('totalmoneyE', 'totalmoneyW', 'totalmoneyC'));
    }

    public function read_comment($id){
        $comment = Comment::find($id);
        $comment -> read = true;
        $comment -> save();
        // $idBill = explode('-', $comment -> bill_id);
        // foreach($idBill as $key => $idbill){
        //     $idBillE = $idBill[0];
        //     $idBillW = $idBill[1];
        //     $idBillC = $idBill[2];
        // }
        $user = User::find($comment->user_id);
        return view('admin.comment.readComment', compact('comment', 'user'));
    }
    public function create_comment($id){
        
        $comment = Comment::find($id); // trường hợp trả lời tin nhắn
        
        $titleNew = 'Trả lời: ' . $comment->title;

        return view('admin.comment.createComment', compact('comment','titleNew'));
    }
    public function send_comment($id, Request $request){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $comment = Comment::find($id);
        $idBill = $comment->bill_id;
        $commentRep = new Comment();
        $commentRep->user_id = 99999;
        $commentRep->bill_id = $idBill;
        $commentRep->title = $request->title;
        $commentRep->content = $request->content;
        $commentRep->save();

        return redirect()->back()->with('success', 'Trả lời bình luận thành công!');
    }
    public function comments(){
        $users = User::get();
        $comments = Comment::select('*')->orderByDesc('created_at', )->get();
        return view('admin.comment.listComment', compact('comments', 'users'));
    }
}
