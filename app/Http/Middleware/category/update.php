<?php

namespace App\Http\Middleware\category;

use Closure;
use Illuminate\Http\Request;
use App\Models\admin_role;
use Illuminate\Support\Facades\Auth;
class update
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
            $admin_role=admin_role::where('admin_id',session()->get('admin_id'))->where('role_id',10)->first();
            if($admin_role){
                        return $next($request);
            }
        }
        return redirect()->back();    }
}
