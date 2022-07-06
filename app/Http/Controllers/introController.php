<?php

namespace App\Http\Controllers;
use App\Models\intro;
use Illuminate\Http\Request;
class introController extends Controller
{
    public function index(){
        $intro=intro::first();
        return view('admin.intro.intro')->with(compact('intro'));
    }
    public function edit(Request $request){
        $message=[
            'content.required'=>'Bạn chưa điền nội dung'
        ];
        $request->validate([
            'content'=>'required'
        ],$message);
        $intro=intro::find(1);
        if(!$intro){
            intro::create([
                'content'=>$request->content
            ]);
            session()->flash('success','Thành công');
            return redirect()->back();
        }else{
            $intro->content=$request->content;
            $intro->save();
            session()->flash('success','Thành công');
            return redirect()->back();
        }
    }
}
