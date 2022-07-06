<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use Carbon\Carbon;

class categoryController extends Controller
{
    public function locgia(Request $request, $id)
    {
        $category = category::where('id', $id)->where('status', '!=', 0)->first();
        $product = product::with('gallery')->where('category_id', $category->id)
        ->whereBetween('price', [$request->min, $request->max])->where('status', '!=', 0)
        ->get();
        return view('public.category.ajax')->with(compact('product'))->render();
    }
    public function danhmuc($slug)
    {
        $category = category::where('slug', $slug)->where('status', '!=', 0)->first();
        $product = product::with('gallery')->where('category_id', $category->id)->where('status', '!=', 0)->get();
        $sanpham_quantam = product::with('gallery')->orderBy('sell', 'DESC')->where('status', '!=', 0)->limit(5)->get();
        $sanpham_dacbiet = product::with('gallery')->orderBy('sale', 'DESC')->where('status', '!=', 0)->limit(10)->get();
        return view('public.category.index')->with(compact('category', 'product', 'sanpham_quantam', 'sanpham_dacbiet'));
    }
    public function create()
    {
        $category = category::get();
        return view('admin.category.create')->with(compact('category'));
    }
    public function store(Request $request)
    {
        $message = ([
            'name.required' => 'Bạn chưa điền tên danh mục',
            'slug.required' => 'Bạn chưa điền slug',
            'slug.unique' => 'Slug của bạn đã tồn tại',
            'keywords.required' => 'Bạn chưa nhập từ khóa',
            'category_parent.required' => 'Bạn chưa nhập danh mục cha',
            'status.required' => 'Bạn chưa nhập trạng thái',
        ]);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:category',
            'keywords' => 'required',
            'category_parent' => 'required',
            'status' => 'required'
        ], $message);
        $category = new category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->keywords = $request->keywords;
        $category->category_parent = $request->category_parent;
        $category->status = $request->status;
        $category->save();
        session()->flash('success', 'Thành công');
        return redirect()->back();
    }
    public function index(Request $request)
    {
        $category = category::get();
        return view('admin.category.index')->with(compact('category'));
    }
    public function delete($id)
    {
        $category = category::where('id', $id)->first();
        $product = product::where('category_id', $id)->get();
        if (count($product) > 0) {
            if ($category) {
                $son = category::where('category_parent', $id)->get();
                foreach ($son as $key => $val) {
                    $cate = category::find($val->id);
                    $cate->category_parent = 0;
                    $cate->save();
                }
                $category->delete();
                echo 1;
            }
        } else {
            echo 0;
        }
    }
    public function edit($id)
    {
        $cate = category::find($id);
        $category = category::where('id', '!=', $id)->get();
        return view('admin.category.edit')->with(compact('cate', 'category'));
    }
    public function update(Request $request, $id)
    {
        $message = ([
            'name.required' => 'Bạn chưa điền tên danh mục',
            'slug.required' => 'Bạn chưa điền slug',
            'slug.unique' => 'Slug của bạn đã tồn tại',
            'keywords.required' => 'Bạn chưa nhập từ khóa',
            'category_parent.required' => 'Bạn chưa nhập danh mục cha',
            'status.required' => 'Bạn chưa nhập trạng thái',
        ]);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:category',
            'keywords' => 'required',
            'category_parent' => 'required',
            'status' => 'required'
        ], $message);
        $category = category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->keywords = $request->keywords;
        $category->category_parent = $request->category_parent;
        $category->status = $request->status;
        $category->save();
        $cate_all = category::where('id', $id)->get();
        foreach ($cate_all as $key => $val) {
            $cate = category::find($val->id);
            $cate->category_parent = 0;
            $cate->save();
        }
        session()->flash('success', 'Thành công');
        return redirect()->back();
    }
    public function status($id)
    {
        $product = category::find($id);
        if ($product->status == 0) {
            $product->status = 1;
            $product->save();
            echo 1;
        } else {
            $product->status = 0;
            $product->save();
            echo 0;
        }
    }
}
