<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index(){
        $customer=User::get();
        return view('admin.customer.index')->with(compact('customer'));
    }
}
