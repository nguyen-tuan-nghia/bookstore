<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Models\product;
use App\Models\category;
use App\Models\comment;
use App\Models\gallery;
use App\Models\star_rating;
use File;
use Carbon\Carbon;

class productController extends Controller
{
    public function create()
    {
        $category = category::get();
        return view('admin/product/create')->with(compact('category'));
    }
    public function store(Request $request)
    {
        $message = ([
            'name.required' => 'Bạn chưa điền tên sản phẩm',
            'slug.required' => 'Bạn chưa điền slug',
            'price.required' => 'Bạn chưa điền giá bán',
            'cost_price.required' => 'Bạn chưa điền giá nhập',
            'quantity.required' => 'Bạn chưa điền sô lượng',
            'content.required' => 'Bạn chưa điền mô tả',
            'slug.unique' => 'Slug của bạn đã tồn tại',
            'keywords.required' => 'Bạn chưa nhập từ khóa',
            'status.required' => 'Bạn chưa nhập trạng thái',
            'category_id.required'=>'Bạn chưa nhập danh mục',
            'images.required'=>'Bạn phải nhập ít nhất 1 ảnh làm ảnh bìa',
            'price.max'=>'Giá bán phải nhỏ hơn 10 chữ số',
            'cost_price.max'=>'Giá nhập phải nhỏ hơn 10 chữ số',
            'quantity.max'=>'Số lượng phải nhỏ hơn 10 chữ số'
        ]);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:product',
            // 'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'price' => 'required|max:11',
            'cost_price' => 'required|max:11',
            'quantity' => 'required|max:11',
            'content' => 'required',
            'keywords' => 'required',
            'status' => 'required',
            'category_id'=>'required',
            'images'=>'required|array'
        ], $message);
        $imgFile = $request->file('images');
        $product = new product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);
        $product->cost_price = filter_var($request->cost_price, FILTER_SANITIZE_NUMBER_INT);
        $product->quantity = $request->quantity;
        $product->content = $request->content;
        if($request->sale!=null){
            $sale=filter_var($request->sale, FILTER_SANITIZE_NUMBER_INT);
        }else{
            $sale=$request->sale;
        }
        $product->sale = $sale;
        $product->keywords = $request->keywords;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $product->save();
        if ($imgFile) {
            foreach ($imgFile as $image) {
                $get_name_img = $image->getClientOriginalName();
                $name_img = current(explode('.', $get_name_img));
                $new_image_name = $name_img . time() . '.' . $image->extension();
                $filePath = public_path('product/thumbnails');
                $img = Image::make($image->path());
                $img->resize(450, 450, function ($const) {
                    $const->aspectRatio();
                })->save($filePath . '/' . $new_image_name);

                // $filePath = public_path('product/images');
                // $image->move($filePath, $new_image_name);
                $gallery = new gallery();
                $gallery->image = $new_image_name;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        session()->flash('success', 'Thành công');
            return redirect()->back();
    }

    public function index()
    {
        $product = product::with('gallery')->orderBy('id', 'desc')->get();
        // return $product;
        return view('admin/product/index')->with(compact('product'));
    }

    public function product_detail($slug)
    {
        $product = product::with('gallery')->with("category")->where('slug', $slug)->where('status','!=',0)->first();
        $star_all= star_rating::where('product_id',$product->id)->get();
        $com= comment::where('product_id',$product->id)->get();
        $count=0;
        $star=0;
        if(count($star_all)>0){
        foreach($star_all as $key=>$val){
            $count+=$val->star;
        }
        $star=round($count/count($star_all));
    }
        return view('public/product/product_detail')->with(compact('product','star','com'));
    }
    public function delete($id)
    {
        $product = product::with('gallery')->where('id', $id)->first();
        if ($product) {
            if (count($product->gallery) > 0) {
                foreach ($product->gallery as $gallery) {
                    $path = 'public/product/thumbnails/' . $gallery->image;
                    if (File::exists($path)) {
                        unlink($path);
                    }
                }
            }
            $gallery = gallery::where('product_id', $id)->delete();
            $product->delete();
        }
    }
    public function edit($id)
    {
        $product = product::with('gallery')->where('id', $id)->first();
        $category = category::get();
        return view('admin/product/edit')->with(compact('product', 'category'));
    }
    public function update(Request $request, $id)
    {
        $message = ([
            'name.required' => 'Bạn chưa điền tên sản phẩm',
            'slug.required' => 'Bạn chưa điền slug',
            'price.required' => 'Bạn chưa điền giá bán',
            'cost_price.required' => 'Bạn chưa điền giá nhập',
            'quantity.required' => 'Bạn chưa điền sô lượng',
            'content.required' => 'Bạn chưa điền mô tả',
            'slug.unique' => 'Slug của bạn đã tồn tại',
            'keywords.required' => 'Bạn chưa nhập từ khóa',
            'status.required' => 'Bạn chưa nhập trạng thái',
            'price.max'=>'Giá bán phải nhỏ hơn 10 chữ số',
            'cost_price.max'=>'Giá nhập phải nhỏ hơn 10 chữ số',
            'quantity.max'=>'Số lượng phải nhỏ hơn 10 chữ số'
        ]);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:product',
            // 'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'price' => 'required|max:11',
            'cost_price' => 'required|max:11',
            'quantity' => 'required|max:11',
            'content' => 'required',
            'keywords' => 'required',
            'status' => 'required'
        ], $message);
        $imgFile = $request->file('images');
        $product = product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);
        $product->cost_price = filter_var($request->cost_price, FILTER_SANITIZE_NUMBER_INT);
        $product->quantity = $request->quantity;
        $product->content = $request->content;
        if($request->sale!=null){
            $sale=filter_var($request->sale, FILTER_SANITIZE_NUMBER_INT);
        }else{
            $sale=$request->sale;
        }
        $product->sale = $sale;
        $product->keywords = $request->keywords;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $product->save();
        if ($imgFile) {
            foreach ($imgFile as $image) {
                $get_name_img = $image->getClientOriginalName();
                $name_img = current(explode('.', $get_name_img));
                $new_image_name = $name_img . time() . '.' . $image->extension();
                $filePath = public_path('product/thumbnails');
                $img = Image::make($image->path());
                $img->resize(450, 450, function ($const) {
                    $const->aspectRatio();
                })->save($filePath . '/' . $new_image_name);

                // $filePath = public_path('product/images');
                // $image->move($filePath, $new_image_name);
                $gallery = new gallery();
                $gallery->image = $new_image_name;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        session()->flash('success', 'Thành công');
        return redirect()->back();
    }
    public function delete_image($id)
    {
        $gallery = gallery::where('id', $id)->first();
        // dd($gallery->image);
        if ($gallery) {
            $path = 'public/product/thumbnails/' . $gallery->image;
            if (File::exists($path)) {
                unlink($path);
            }
        }
        $gallery->delete();
    }
    public function status($id){
        $product = product::find($id);
        if($product->status==0){
            $product->status=1;
            $product->save();
            echo 1;
        }else{
            $product->status=0;
            $product->save();
            echo 0;
        }
    }
}
