<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\delivery;
use App\Models\order;
use App\Models\ship;
use App\Models\order_detail;
use App\Models\star_rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class cartController extends Controller
{
    public function star_store(Request $request)
    {
        $star_rating = star_rating::where('product_id', $request->product_id)
        ->where('order_id', $request->order_id)->where('customer_id', Auth::user()->id)->first();
        if ($star_rating) {
            $star_rating->star=$request->star;
            $star_rating->save();
        } else {
            $new = new star_rating();
            $new->product_id = $request->product_id;
            $new->order_id = $request->order_id;
            $new->star=$request->star;
            $new->customer_id = Auth::user()->id;
            $new->save();
        }
    }
    public function status($id)
    {
        $order = order::find($id);
        if (Auth::user()->id == $order->user_id) {
            if ($order->status == 0) {
                $order->status = 3;
                $order->save();
            }
        }
        return redirect('/cart/history');
    }
    public function history_detail($id)
    {
        $ship = ship::where('order_id', $id)->first();
        $order = order::where('id', $id)->first();
        $order_detail = order_detail::where('order_id', $id)->with('product')->with('gallery')->orderBy('id', 'DESC')->get();
        return view('public.cart.history_detail')->with(compact('order', 'ship', 'order_detail'));
    }
    public function history()
    {
        $order = order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('public.cart.history')->with(compact('order'));
    }
    public function order(Request $request)
    {
        $this->validate($request, [
            'receiver' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'location' => 'required',
        ]);
        $order = new order();
        $order->user_id = Auth::user()->id;
        $order->status = 0;
        $order->payment_type = "Trả tiền mặt";
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $order->save();
        foreach (Cart::content() as $key => $val) {
            $order_detail = new order_detail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $val->id;
            $order_detail->quantity = $val->qty;
            $order_detail->price = $val->price;
            $order_detail->created_at = Carbon::now('Asia/Ho_Chi_Minh');;
            $order_detail->save();
        }
        $ship = new ship();
        $ship->order_id = $order->id;
        $ship->name = $request->receiver;
        $ship->phone = $request->phone;
        $ship->note = $request->note;
        $ship->city = $request->city;
        $ship->price = session()->get('fee');
        $ship->address = $request->location;
        $ship->save();
        session()->forget('fee');
    }
    public function delivery(Request $request)
    {
        $delivery = delivery::where('city', $request->city)->first();
        session()->put('fee', $delivery->price);
        return view('public/cart/cart_ajax')->render();
    }
    public function index()
    {
        $delivery = delivery::get();
        $customer=User::where('id',Auth::user()->id)->first();
        return view('public/cart/index')->with(compact('delivery','customer'));
    }
    public function store(Request $request)
    {
        $Cart = Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->quantity,
            'weight' => 0,
            'options' => array(
                'image' => $request->image,
            )
        ]);
    }
    public function update(Request $request, $rowId)
    {
        foreach (Cart::content() as $key => $val) {
            if ($val->rowId == $rowId) {
                $qty = $val->qty;
            }
        }
        if ($request->number == -1) {
            $number = $qty - 1;
        } else {
            $number = $qty + 1;
        }
        Cart::update($rowId, $number);
        return view('public/cart/cart_ajax')->render();
    }
    function delete(Request $request, $rowId)
    {
        if ($request->ajax()) {
            Cart::remove($rowId);
            return view('public/cart/cart_ajax')->render();
        }
    }
}
