<?php

namespace App\Http\Controllers;

use App\Mail\SignupMail;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;

class MemberController extends Controller
{
    public function index()
    {
        // ログイン判断
        if(session()->has('login_email')) {
            $name_sei = session()->get('login_name_sei');
            $name_mei = session()->get('login_name_mei');
            $full_name = $name_sei.$name_mei;
            return view('index')
                ->with('full_name', $full_name);
        } else {
            return view('index');
        }
    }

    public function signup()
    {
        if(session()->has('name_sei')) {
            $data = session()->all();
            return view('member.signup')
            ->with([
                'name_sei' => $data['name_sei'],
                'name_mei' => $data['name_mei'],
                'nickname' => $data['nickname'],
                'ss_gender' => $data['gender'],
                'password' => $data['password'],
                'email' => $data['email']
            ]);
        } else {
            return view('member.signup');
        }
    }

    // 登録画面
    public function store(Request $request)
    {
        $request->validate([
            'name_sei' => 'required|max:20',
            'name_mei' => 'required|max:20',
            'nickname' => 'required|max:10',
            'gender' => 'required|integer',
            'password' => 'required|regex:/^[a-z0-9]{8,20}+$/',
            're_password' => 'required|regex:/^[a-z0-9]{8,20}+$/|same:password',
            'email' => 'required|unique:members|max:200|regex:/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/'
        ], [
            'name_sei.required and name_mei.required' => '氏名は必須です',
            'name_sei.required' => '苗字は必須です',
            'name_mei.required' => '名前は必須です',
            'name_sei.max' => '苗字は:max字以内で入力してください',
            'name_mei.max' => '名前は:max字以内で入力してください',
            'nickname.required' => 'ニックネームは必須です',
            'nickname.max' => 'ニックネームは:max字以内で入力してください',
            'gender.required' => '性別を選択してください',
            'gender.integer' => '性別を正しく選択してください',
            'password.required' => 'パスワードは必須です',
            'password.regex' => 'パスワードは8~20文字の半角英数字が使用できます',
            're_password.required' => 'パスワード確認は必須です',
            're_password.regex' => 'パスワードは8~20文字の半角英数字が使用できます',
            're_password.same' => 'パスワードが一致しません',
            'email.required' => 'メールアドレスは必須です',
            'email.unique' => '既にメールアドレスが存在しています',
            'email.regex' => '正しいメールアドレスを入力してください',
            'email.max' => 'メールアドレスは:max字以内で入力してください'
        ]);

        $request->session()->put([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'password' => $request->password,
            'email' => $request->email
        ]);

        return redirect()
            ->route('member.confirm');
    }

    // 確認画面
    public function signup_confirm(Request $request)
    {
        $data = $request->session()->all();

        return view('member.signup_confirm',[
            'name_sei' => $data['name_sei'],
            'name_mei' => $data['name_mei'],
            'nickname' => $data['nickname'],
            'password' => $data['password'],
            'gender' => $data['gender'],
            'email' => $data['email']
        ]);

    }

    // DBに登録
    public function send(Request $request)
    {
        // パスワードをハッシュ化
        $hash_password = bcrypt($request['password']);

        Member::create([
            'name_sei' => $request['name_sei'],
            'name_mei' => $request['name_mei'],
            'nickname' => $request['nickname'],
            'gender' => $request['gender'],
            'password' => $hash_password,
            'email' => $request['email']
        ]);

        // 二重登録防止
        $request->session()->regenerateToken();

        // ここでメールを送信
        $to = $request['email'];
        Mail::to($to)
        ->send(new SignupMail());

        return redirect()
            ->route('member.completed');
    }

    // 登録完了画面
    public function completed()
    {
        session()->flush();
        return view('member.signup_completed');
    }

}
