<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\SystemCalendar;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read_comment($id){
        $calendar = SystemCalendar::find(1);
        $comment = Comment::find($id);
        $comment -> read = true;
        $comment -> save();
        $idBill = explode('-', $comment -> bill_id);
        foreach($idBill as $key => $idbill){
            $idBillE = $idBill[0];
            $idBillW = $idBill[1];
        }
        $customer = Customer::find($comment->customer_id);
        return view('admin.comment.readComment', compact('comment', 'customer', 'calendar', 'idBillE', 'idBillW'));
    }
    public function create_comment($id){
        $calendar = SystemCalendar::find(1);
        
        $comment = Comment::find($id); // trường hợp trả lời tin nhắn
        
        $titleNew = 'Trả lời: ' . $comment->title;

        return view('admin.comment.createComment', compact('comment','titleNew', 'calendar'));
    }
    public function send_comment($id, Request $request){
        $calendar = SystemCalendar::find(1);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $comment = Comment::find($id);
        $idBill = $comment->bill_id;
        $commentRep = new Comment();
        $commentRep->customer_id = 1;
        $commentRep->bill_id = $idBill;
        $commentRep->title = $request->title;
        $commentRep->content = $request->content;
        $commentRep->save();

        return redirect()->back()->with('success', 'Trả lời bình luận thành công!');
    }
    public function comments(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $calendar = SystemCalendar::find(1);
        $customers = Customer::get();
        $comments = Comment::select('*')->orderByDesc('created_at', )->get();
        return view('admin.comment.listComment', compact('comments', 'customers', 'calendar'));
    }

    public function duyetComments(Request $request)
    {
        $calendar = SystemCalendar::find(1);
        $customers = Customer::get();
        if($request->duyet == 1)
        {
            // bình luận đã xem
            $comments = Comment::select('*')->Where("read", 1)->orderByDesc('created_at', )->get();
        }
        if($request->duyet == 2)
        {
            // bình luận chưa xem
            $comments = Comment::select('*')->Where("read", 0)->orderByDesc('created_at', )->get();
        }
        if($request->duyet == 3)
        {
            // bình luận mới nhất
            $comments = Comment::select('*')->orderByDesc('created_at', )->get();
        }
        
        return view('admin.comment.listComment', compact('comments', 'customers', 'calendar'));
    }

    public function destroy_comment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('admin.comment-list')->with('success', 'Xóa bình luận thành công!');
    }
}
