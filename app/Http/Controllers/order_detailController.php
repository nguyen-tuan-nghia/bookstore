<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order_detail;
class order_detailController extends Controller
{
    public function delete($id){
        $detail=order_detail::find($id);
        $detail->delete();
    }
}
