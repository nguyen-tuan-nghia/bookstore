<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\delivery;
use DB;
class deliveryController extends Controller
{
    public function create(){
        $city=DB::table('tbl_tinhthanhpho')->get();
        return view('admin.delivery.create')->with(compact('city'));
    }
    public function store(Request $request)
    {
        $message = ([
            'city.required' => 'Bạn chưa chọn thành phố',
            'price.required'=>'Bạn chưa nhập phí vận chuyển',
            'city.unique'=>'Đã có phí vận chuyển của thành phố này'
        ]);
        $this->validate($request, [
            'city' => 'required|unique:delivery',
            'price' => 'required'
        ], $message);
        $delivery = new delivery();
        $delivery->city = $request->city;
        $delivery->price = $request->price;
        $delivery->save();
            session()->flash('success', 'Thành công');
            return redirect()->back();
    }
    public function index(Request $request)
    {
        $delivery=delivery::get();
        return view('admin.delivery.index')->with(compact('delivery'));
    }
    public function delete($id){
        $delivery=delivery::where('id',$id)->first();
        $delivery->delete();
    }
    public function edit($id)
    {
        $delivery=delivery::find($id);
        $city=DB::table('tbl_tinhthanhpho')->get();
        return view('admin.delivery.edit')->with(compact('city','delivery'));
    }
    public function update(Request $request,$id)
    {
        $message = ([
            'price'=>'Bạn chưa nhập phí vận chuyển'
        ]);
        $this->validate($request, [
            'price' => 'required'
        ], $message);
        $delivery = delivery::find($id);
        $delivery->price = $request->price;
        $delivery->save();
            session()->flash('success', 'Thành công');
            return redirect()->back();
    }
}
