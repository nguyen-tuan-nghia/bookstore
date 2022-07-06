<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\admin_role;
use App\Models\order;
use App\Models\order_detail;
use App\Models\product;
use App\Models\role;
use App\Models\web_detail;
use DB;
use Illuminate\Support\Facades\Auth;
use File;
use Image;

class adminController extends Controller
{
    public function doimatkhau(Request $request)
    {
        $message = ([
            'name.required' => 'Bạn chưa điền tên',
            'email.required' => 'Bạn chưa điền email',
            'password.required' => 'Bạn chưa điền mật khẩu',
            'password.min' => 'Bạn phải điền mật khẩu ít nhất 6 ký tự',
        ]);
        $request->validate([
            'name' => 'required|max:30',
            'password' => 'required|min:6'
        ], $message);
        $admin = admin::find(session()->get('admin_id'));
        $admin->name = $request->name;
        $admin->password = md5($request->password);
        $admin->save();
        session()->flash('success', 'Thành công');
        return back();
    }
    public function setting()
    {
        $admin = admin::where('id', session()->get('admin_id'))->first();
        return view('admin.account.setting')->with(compact('admin'));
    }
    public function web_update(Request $request)
    {
        $message = [
            'name.required' => 'Tên website là bắt buộc'
        ];
        $this->validate($request, [
            'name' => 'required',
        ], $message);
        $web = web_detail::find(1);
        $web->name = $request->name;
        $web->keywords = $request->keywords;
        $web->address = $request->address;
        $web->email = $request->email;
        $web->phone = $request->phone;
        $web->fan_page = $request->fan_page;
        $imgFile = $request->file('logo');
        if ($imgFile) {
            if ($web->logo != null) {
                $path = 'public/web/logo/' . $web->logo;
                if (File::exists($path)) {
                    unlink($path);
                }
            }
            $get_name_img = $imgFile->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));
            $new_image_name = $name_img . time() . '.' . $imgFile->extension();
            $filePath = public_path('web/logo');
            $img = Image::make($imgFile->path());
            $img->resize(250, 250, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $new_image_name);
            $web->logO = $new_image_name;
        }
        $web->save();
        session()->flash('success', 'Thành công');
        return redirect()->back();
    }
    public function web()
    {
        $web = web_detail::first();
        return view('admin.web.index')->with(compact('web'));
    }
    public function logout()
    {
        session()->forget('admin_id');
        return redirect('/admin/dangnhap');
    }
    public function find_date(Request $request)
    {
        $order_detail = order_detail::where('updated_at', '!=', null)->whereBetween('updated_at', [$request->date, $request->date2])
            ->select(DB::raw('sum(price*quantity) as price,sum(quantity) as quantity,updated_at'))->groupBy('updated_at')
            ->get();
        if (count($order_detail) > 0) {
            foreach ($order_detail as $key => $val) {
                $char[] = array(
                    'doanhthu' => $val->price,
                    'soluong' => $val->quantity,
                    'date' => $val->updated_at
                );
            }
        } else {
            $char[] = array(
                'doanhthu' => 0,
                'soluong' => 0,
                'date' => 0
            );
        }

        return response()->json(['data' => $char], 200);
    }
    public function delete($id)
    {
        if (session()->get('admin_id') != $id) {
            $admin = admin::find($id);
            $admin->delete();
            echo 1;
        } else {
            echo 0;
        }
    }
    public function doughnut()
    {
        $product = product::where('sell', '!=', 0)->orderBy('sell', 'DESC')->limit(10)->get();
        return response()->json(['data' => $product], 200);
    }
    public function filldata()
    {
        $order_detail = order_detail::where('updated_at', '!=', null)
            ->select(DB::raw('sum(price*quantity) as price,sum(quantity) as quantity,updated_at'))->groupBy('updated_at')
            ->get();
        foreach ($order_detail as $key => $val) {
            $char[] = array(
                'doanhthu' => $val->price,
                'soluong' => $val->quantity,
                'date' => $val->updated_at
            );
        }
        return response()->json(['data' => $char], 200);
    }

    public function index()
    {

        return view('admin.home');
    }
    public function signup(Request $request)
    {
        $message = ([
            'name.required' => 'Bạn chưa điền tên',
            'email.required' => 'Bạn chưa điền email',
            'password.required' => 'Bạn chưa điền mật khẩu',
            'password.min' => 'Bạn phải điền mật khẩu ít nhất 6 ký tự',
            'email.unique' => 'Email đã tồn tại',
        ]);
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'email|unique:admin',
            'password' => 'required|min:6'
        ], $message);
        $ad = admin::get();
        if (count($ad) == 0) {
            $admin = admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => md5($request->password),
            ]);
            $role=role::get();
            foreach($role as $key =>$val){
                $admin_role=admin_role::create([
                    'admin_id'=>$admin->id,
                    'role_id'=>$val->id
                ]);
            }
        } else {
            $admin = admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => md5($request->password),
            ]);
        }
    }
    public function signin(Request $request)
    {
        $message = ([
            'email.required' => 'Bạn chưa điền email',
            'password.required' => 'Bạn chưa điền mật khẩu',
            'password.min' => 'Bạn phải điền mật khẩu ít nhất 6 ký tự',
        ]);
        $request->validate([
            'email' => 'email',
            'password' => 'required|min:6'
        ], $message);
        $admin = admin::where('email', $request->email)->where('password', md5($request->password))->first();
        if ($admin) {
            session()->put('admin_id', $admin->id);
            echo 1;
        } else {
            echo 2;
        }
    }
}
