<?php

namespace App\Http\Controllers;

use App\Mail\SignupMail;
use App\Mail\EditEmailMail;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index()
    {
        $name_sei = session()->get('login_name_sei');
        $name_mei = session()->get('login_name_mei');
        $full_name = $name_sei.$name_mei;
        return view('index')
            ->with('full_name', $full_name);
    }

    public function show()
    {
        return view('member.show');
    }

    public function delete_confirm()
    {
        return view('member.delete_confirm');
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
            'gender' => 'required|in:1,2',
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
            'gender.in' => '性別を正しく選択してください',
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

    // メンバー情報編集
    public function editProfile()
    {
        return view('member.edit.profile');
    }
    public function storeEditProfile(Request $request)
    {
        $request->validate([
            'name_sei' => 'required|max:20',
            'name_mei' => 'required|max:20',
            'nickname' => 'required|max:10',
            'gender' => 'required|in:1,2'
        ], [
            'name_sei.required and name_mei.required' => '氏名は必須です',
            'name_sei.required' => '苗字は必須です',
            'name_mei.required' => '名前は必須です',
            'name_sei.max' => '苗字は:max字以内で入力してください',
            'name_mei.max' => '名前は:max字以内で入力してください',
            'nickname.required' => 'ニックネームは必須です',
            'nickname.max' => 'ニックネームは:max字以内で入力してください',
            'gender.required' => '性別を選択してください',
            'gender.in' => '性別を正しく選択してください'
        ]);

        session()->put([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $request->gender
        ]);

        return redirect()->route('confirm.edit.profile');
    }
    public function confirmEditProfile()
    {
        return view('member.edit.confirm_profile');
    }
    public function sendEditProfile(Request $request)
    {
        Member::where('id', auth()->user()->id)->update([
            'name_sei' => $request['name_sei'],
            'name_mei' => $request['name_mei'],
            'nickname' => $request['nickname'],
            'gender' => $request['gender']
        ]);

        // 二重登録防止
        $request->session()->regenerateToken();

        session()->forget('name_sei');
        session()->forget('name_mai');
        session()->forget('nickname');
        session()->forget('gender');

        return redirect()
            ->route('member.show');
    }
    public function storeEditPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|regex:/^[a-z0-9]{8,20}+$/',
            're_password' => 'required|regex:/^[a-z0-9]{8,20}+$/|same:password'
        ], [
            'password.required' => '※パスワードは必須です',
            'password.regex' => '※パスワードは8~20文字の半角英数字が使用できます',
            're_password.required' => '※パスワード確認は必須です',
            're_password.regex' => '※パスワードは8~20文字の半角英数字が使用できます',
            're_password.same' => '※パスワードが一致しません'
        ]);
        // パスワードをハッシュ化
        $hash_password = bcrypt($request->password);

        Member::where('id', auth()->user()->id)->update([
            'password' => $hash_password
        ]);

        // 二重登録防止
        $request->session()->regenerateToken();
        return redirect()
            ->route('member.show');
    }
    public function storeEditEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:members|max:200|regex:/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/'
        ], [
            'email.required' => '※メールアドレスは必須です',
            'email.unique' => '※既にメールアドレスが存在しています',
            'email.regex' => '※正しいメールアドレスを入力してください',
            'email.max' => '※メールアドレスは:max字以内で入力してください'
        ]);
        // 認証コード発行、テーブルに保存
        $auth_code = str_pad(random_int(0,999999),6,0,STR_PAD_LEFT);
        Member::where('id', auth()->user()->id)->update(['auth_code' => $auth_code]);
        // 認証コード送信
        $newEmail = $request->email;
        Mail::to($newEmail)
        ->send(new EditEmailMail($auth_code));
        // 新アドレスと認証コードをセッションに格納
        session()->put([
            'newEmail' => $newEmail
        ]);
        // 認証画面に遷移
        return redirect()
            ->route('confirm.edit.email');
    }
    public function sendEditEmail(Request $request)
    {
        Log::info('send.edit.email');
        $input_auth_code = $request->input_auth_code;
        $error = '※認証コードが違います';
        if((int)auth()->user()->auth_code !== (int)$input_auth_code){
            return view('member.edit.confirm_email')->with(['error' => $error]);
        } else {
            $newEmail = session()->get('newEmail');
            Member::where('id', auth()->user()->id)->update(['email' => $newEmail]);
            session()->forget('newEmail');
            return redirect()->route('member.show');
        }

    }
}
