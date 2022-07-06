<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\order_detail;
use App\Models\product;
use App\Models\ship;
use App\Models\User;
use Carbon\Carbon;

class orderController extends Controller
{
    public function delete($id)
    {
        $order = order::find($id);
        $order->delete();
    }
    public function index()
    {
        $order = order::orderBy('order.id', 'DESC')->get();
        return view('admin.order.index')->with(compact('order'));
    }
    public function detail($id)
    {
        $ship = ship::where('order_id', $id)->first();
        $order = order::where('id', $id)->first();
        $order_detail = order_detail::where('order_id', $id)->with('product')->with('gallery')->orderBy('id', 'DESC')->get();
        return view('admin.order.detail')->with(compact('order', 'ship', 'order_detail'));
        // dd($order_detail);
    }
    public function status(Request $request, $id)
    {
        if ($request->status == 1) {
            foreach ($request->id as $key => $ids) {
                foreach ($request->qty as $key2 => $qty) {
                    if ($key == $key2) {
                        $product = product::find($ids);
                        if ($product->quantity >= $qty) {
                            $product->quantity = $product->quantity - $qty;
                            $product->save();
                        } else {
                            session()->flash('error', 'Số lượng tồn của sản phẩm ' . $product->name . ' không đủ');
                            return redirect()->back();
                        }
                    }
                }
            }
        }
        $order = order::find($id);
        if ($order->status == 3) {
            session()->flash('error', 'Khách hàng đã hủy đơn hàng mã số ' . $id . '. Bạn không thể thay đổi trạng thía đơn hàng đã bị hủy');
            return redirect()->back();
        }
        if ($request->status == 4) {
            foreach ($request->id as $key => $ids) {
                foreach ($request->qty as $key2 => $qty) {
                    if ($key == $key2) {
                        $product = product::find($ids);
                        $product->quantity = $product->quantity + $qty;
                        $product->save();
                    }
                }
            }
        }
        if ($request->status == 2) {
            foreach ($request->id as $key => $ids) {
                foreach ($request->qty as $key2 => $qty) {
                    if ($key == $key2) {
                        $product = product::find($ids);
                        $product->sell = $qty;
                        $product->save();
                    }
                }
            }
            $price=0;
            foreach ($request->order_detail_id as $key => $order_detail_id) {
                $order_detail=order_detail::find($order_detail_id);
                $order_detail->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
                $order_detail->save();
                $price+=$order_detail->price*$order_detail->quantity;
            }
            $user=User::where('id',$order->user_id)->first();
            $user->order+=1;
            $user->money_spent+=$price;
            $user->save();
            $order->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
        }
        $order->status = $request->status;
        $order->save();
        session()->flash('success', 'Trạng thái đơn hàng đã được cập nhật thành công');
        return redirect()->back();
    }
}
