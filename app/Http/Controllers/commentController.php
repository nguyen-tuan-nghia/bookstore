<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class commentController extends Controller
{
    public function store(Request $request){
        $comment=new comment();
        $comment->name=Auth::user()->name;
        $comment->content=$request->contenttext;
        $comment->product_id=$request->id;
        $comment->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $comment->save();
    }
    public function index(){
        $comment=comment::get();
        return view('admin.comment.index')->with(compact('comment'));
    }
    public function delete($id){
        $comment=comment::find($id)->delete();
    }
}
