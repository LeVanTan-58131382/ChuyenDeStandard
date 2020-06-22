<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Message;
use App\Models\SystemCalendar;

class MessagesController extends Controller
{

    public function messages(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1);
        $customers = Customer::get();
        $messages = Message::with('userFrom')->notDeleted()->get();
        return view('admin.message.listMessages', compact('customers', 'messages', 'calendar'));
    }

    public function create_message(int $id = 0, String $title = '') {
        $calendar = SystemCalendar::find(1);
        if ($id === 0) {
            $customers = Customer::where('id', '>', 1)->get(); // lấy danh sách user trừ admin - trường hợp tạo mới tin nhắn
        } else {
            $customers = Customer::where('id', $id)->get(); // trường hợp trả lời tin nhắn
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
        return view('admin.message.createMessages', compact('calendar', 'customers', 'title'));
    }

    public function send_message(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $message = new Message();
        $message->user_id_from = 1;
        $message->user_id_to = $request->to;
        $message->title = $request->title;
        $message->content = $request->content;
        $message->save();
        return redirect()->back()->with('success', 'Gửi tin nhắn thành công!');
    }
 
    public function read_message($id)
    {
        $calendar = SystemCalendar::find(1);
        $message = Message::with('userFrom')->find($id);
        $message->read_admin = true;
        $message->save();
        return view('admin.message.readMessages', compact('calendar', 'message'));
    }

    public function destroy_message($id)
    {
        $message = Message::find($id);
        $message->deleted = true;
        $message->save();
        return redirect()->route('admin.list-messages')->with('success', 'Xóa tin nhắn thành công!');
    }
}
