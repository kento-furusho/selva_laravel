<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Administer;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }

    public function login(AdminRequest $request)
    {

        $credentials = $request->only(['login_id', 'password']);
        if (Auth::guard('administers')->attempt($credentials)) {
            // ログインしたら管理画面トップにリダイレクト
            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'login' => ['※IDまたはパスワードに誤りがあります']
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログアウトしたらログインフォームにリダイレクト
        return redirect()->route('admin.login.index')->with([
            'logout_msg' => 'ログアウトしました',
        ]);
    }
}
