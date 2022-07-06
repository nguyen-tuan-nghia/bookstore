<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\Auth;

class admin_Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('admin_id')) {
            $admin = admin::where('id',session()->get('admin_id'))->first();
            if ($admin) {
                return $next($request);
            }
        }
        return redirect('/admin/dangnhap');
    }
}
