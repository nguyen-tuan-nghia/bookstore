<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Models\social; //sử dụng model Login
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
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
            'name' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|min:6'
        ],$message);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
        ]);
        Auth::login($user);
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
        ],$message);
        $user=User::where('email', $request->email)->where('password',md5($request->password))->first();
        if($user){
            Auth::login($user);
            echo 1;
        }
        else{
            echo 2;
        }
    }
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = User::where('id', $account->user_id)->first();
            Auth::login($account_name);
            return redirect('/');
        } else {
            $soci = new social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);
            $orang = User::where('email', $provider->getEmail())->first();
            if (!$orang) {
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                ]);
            }
            $soci->login()->associate($orang);
            $soci->save();
            auth()->login($orang);
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::logout();
        session()->forget('fee');
        return redirect()->back();
    }
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback_google()
    {
        $provider = Socialite::driver('google')->user();
        $account = social::where('provider', 'google')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = User::where('id', $account->user_id)->first();
            Auth::login($account_name);
            return redirect('/');
        } else {
            $soci = new social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'google'
            ]);
            $orang = User::where('email', $provider->getEmail())->first();
            if (!$orang) {
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                ]);
            }
            $soci->login()->associate($orang);
            $soci->save();
            auth()->login($orang);
            return redirect()->back();
        }
    }
}
