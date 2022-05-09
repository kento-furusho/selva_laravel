<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
  public function login()
  {
      return view('member.login');
  }

  public function login_send(Request $request)
  {
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ], [
        'email.required' => 'メールアドレスを入力してください',
        'password.required' => 'パスワードを入力してください'
    ]);

    // ID or Password 誤り用session
    $request->session()->put('email', $request->email);
    $email = $request->session()->get('email');
    $request->session()->flush();

    // アドレスが存在するか
    $member = Member::where('email', $request->email)->get();
    if(count($member) === 0) {
        return redirect()
        ->route('login')
        ->with([
            'login_err_msg' => 'IDまたはパスワードに誤りがあります',
            'email' => $email
        ]);
    }

    // パスワードが合っているか
    if(Hash::check($request->password, $member[0]->password)) {
        // ログイン判断用セッション
        session()->put('login_name_sei', $member[0]->name_sei);
        session()->put('login_name_mei', $member[0]->name_mei);
        session()->put('login_email', $member[0]->email);
        return redirect()->route('member.index');
    } else {
        return redirect()
        ->route('login')
        ->with([
            'login_err_msg' => 'IDまたはパスワードに誤りがあります',
            'email' => $email
        ]);
    }
  }
  public function logout()
  {
      session()->flush();
      return redirect()
        ->route('member.index');
  }
}
