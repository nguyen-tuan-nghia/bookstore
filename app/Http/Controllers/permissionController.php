<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\admin_role;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class permissionController extends Controller
{
    public function index()
    {
        $admin = admin::with('admin_role')->get();
        $role = role::get();
        return view('admin.permission.index')->with(compact('admin', 'role'));
    }
    public function phanquyen(Request $request, $id)
    {
        if (session()->get('admin_id') != $id) {
            $all_admin_role = admin_role::where('admin_id', $id)->delete();
            if (is_array($request->id)) {
                foreach ($request->id as $key => $Val) {
                    $admin_role = new admin_role();
                    $admin_role->admin_id = $id;
                    $admin_role->role_id = $Val;
                    $admin_role->save();
                }
            }
            session()->flash('success', 'Thành công');
            return redirect()->back();
        } else {
            session()->flash('error', 'Bạn không thể phân quyền cho chính mình');
            return redirect()->back();
        }
    }
}
