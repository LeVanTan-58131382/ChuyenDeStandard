<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Message;
use App\Models\SystemCalendar;

class MessagesController extends Controller
{
    public function messages(){
        $customer = Customer::find(Auth::id());

        $messages = Message::select('*')->where('user_id_to', '=', Auth::id())
                                        ->orWhere('user_id_from', '=', Auth::id())
                                        ->notDeleted()->orderBy('created_at', 'DESC')->get();
        return view('customer.message.listMessages', compact('customer', 'messages'));
        
    }

    public function create_message(String $title = '') {
        if ($title !== '') $title =  $title;
        return view('customer.message.createMessages', compact('title'));
    }

    public function send_message(Request $request)
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

        return redirect()->route('customer.list-messages', Auth::id())->with('success', 'Gửi tin nhắn thành công!');
    }

    public function read_message($id)
    {
        $message = Message::find($id);
        $message->read_customer = true;
        $message->save();

        return view('customer.message.readMessages')->with('message', $message);
    }

    public function destroy_message($id)
    {
        $message = Message::find($id);
        $message->deleted = true;
        $message->save();
        
        return redirect()->route('customer.list-messages', Auth::id())->with('success', 'Xóa tin nhắn thành công!');
    }
}
