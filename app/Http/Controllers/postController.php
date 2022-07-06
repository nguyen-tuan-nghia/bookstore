<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use Image;
use Carbon\Carbon;

class postController extends Controller
{
    public function create()
    {
        return view('admin.post.create');
    }
    public function index()
    {
        $post=post::get();
        return view('admin.post.index')->with(compact('post'));
    }
    public function delete($id)
    {
        $post=post::find($id)->delete();
    }
    public function store(Request $request)
    {
        $message = ([
            'title.required' => 'Bạn chưa điền tên sản phẩm',
            'slug.required' => 'Bạn chưa điền slug',
            'content.required' => 'Bạn chưa điền mô tả',
            'slug.unique' => 'Slug của bạn đã tồn tại',
            'keywords.required' => 'Bạn chưa nhập từ khóa',
            'status.required' => 'Bạn chưa nhập trạng thái',
            'images.required' => 'Bạn phải nhập ít nhất 1 ảnh làm ảnh bìa',
        ]);
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:post',
            'content' => 'required',
            'keywords' => 'required',
            'status' => 'required',
            'images' => 'required'
        ], $message);
        $image = $request->file('images');
        $post= new post();
        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->content=$request->content;
        $post->keywords=$request->keywords;
        $post->status=$request->status;
        $get_name_img = $image->getClientOriginalName();
        $name_img = current(explode('.', $get_name_img));
        $new_image_name = $name_img . time() . '.' . $image->extension();
        $filePath = public_path('update/images/images');
        $img = Image::make($image->path());
        $img->resize(450, 450, function ($const) {
            $const->aspectRatio();
        })->save($filePath . '/' . $new_image_name);

        $post->image=$new_image_name;
        $post->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $post->save();
        session()->flash('success', 'Thành công');
        return redirect()->back();
    }
    public function edit($id)
    {
        $post=post::find($id);
        return view('admin.post.edit')->with(compact('post'));
    }
    public function update(Request $request,$id)
    {
        $message = ([
            'title.required' => 'Bạn chưa điền tên sản phẩm',
            'slug.required' => 'Bạn chưa điền slug',
            'content.required' => 'Bạn chưa điền mô tả',
            'slug.unique' => 'Slug của bạn đã tồn tại',
            'keywords.required' => 'Bạn chưa nhập từ khóa',
            'status.required' => 'Bạn chưa nhập trạng thái',
        ]);
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:post',
            'content' => 'required',
            'keywords' => 'required',
            'status' => 'required',
        ], $message);
        $image = $request->file('images');
        $post= post::find($id);
        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->content=$request->content;
        $post->keywords=$request->keywords;
        $post->status=$request->status;
        if($image!=null){
        $get_name_img = $image->getClientOriginalName();
        $name_img = current(explode('.', $get_name_img));
        $new_image_name = $name_img . time() . '.' . $image->extension();
        $filePath = public_path('update/images/images');
        $img = Image::make($image->path());
        $img->resize(450, 450, function ($const) {
            $const->aspectRatio();
        })->save($filePath . '/' . $new_image_name);
        $post->image=$new_image_name;
    }
        $post->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $post->save();
        session()->flash('success', 'Thành công');
        return redirect()->back();
    }
    public function tin(){
        $post=post::where('status',1)->paginate(10);
        return view('public.post.index')->with(compact('post'));
    }
    public function tin_chi_tiet($slug){
        $post=post::where('status',1)->where('slug',$slug)->first();
        return view('public.post.detail')->with(compact('post'));
    }
}
