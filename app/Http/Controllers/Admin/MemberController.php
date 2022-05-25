<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Administer;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->paginate(10);
        return view('admin.member.search')
            ->with(compact('members'));
    }
    public function search(Request $request)
    {
        $id = $request->search_id;
        $man = (int)$request->gender_man;
        $woman = (int)$request->gender_woman;
        $free_word = $request->free_word;
        // ddd(url()->full);

        if(!isset($id)&&empty($man)&&empty($woman)&&!isset($free_word)){
            session()->forget('order');
            session()->put('order', 'desc');
            return redirect()->route('admin.member');
        }
        // \DB::enableQueryLog();
        $url = Member::search($id, $man, $woman, $free_word);
        $members = $url->orderBy('id', 'desc')->paginate(10);
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.member.search')
            ->with(compact('members' ,'url'));
    }
    public function orderDesc(Request $request)
    {
        $id = $request->search_id;
        $man = (int)$request->gender_man;
        $woman = (int)$request->gender_woman;
        $free_word = $request->free_word;
        // \DB::enableQueryLog();
        $url = Member::search($id, $man, $woman, $free_word);
        $members = $url->orderBy('id', 'desc')->paginate(10);
        // ddd(\DB::getQueryLog());
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.member.search')
            ->with(compact('members'));
    }
    public function orderAsc(Request $request)
    {
        $id = $request->search_id;
        $man = (int)$request->gender_man;
        $woman = (int)$request->gender_woman;
        $free_word = $request->free_word;
        // \DB::enableQueryLog();
        $url = Member::search($id, $man, $woman, $free_word);
        $members = $url->orderBy('id', 'asc')->paginate(10);
        // ddd(\DB::getQueryLog());
        session()->forget('order');
        session()->put('order', 'asc');
        return view('admin.member.search')
            ->with(compact('members'));
    }
    public function create()
    {
        return view('admin.member.create_or_edit');
    }
    public function edit(Member $member)
    {
        return view('admin.member.create_or_edit')
            ->with('member', $member);
    }
    public function createStore(Request $request)
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

        session()->put([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'password' => $request->password,
            'email' => $request->email
        ]);

        return view('admin.member.confirm');
    }
    public function editStore(Request $request, Member $member)
    {
        $request->validate([
            'name_sei' => 'required|max:20',
            'name_mei' => 'required|max:20',
            'nickname' => 'required|max:10',
            'gender' => 'required|in:1,2',
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
        ]);
        if(empty($request->password) && empty($request->re_password)){
            session()->put(['password' => $member->password]);
        } else {
            $request->validate([
                'password' => 'regex:/^[a-z0-9]{8,20}+$/',
                're_password' => 'regex:/^[a-z0-9]{8,20}+$/|same:password',
            ], [
                'password.regex' => 'パスワードは8~20文字の半角英数字が使用できます',
                're_password.regex' => 'パスワードは8~20文字の半角英数字が使用できます',
                're_password.same' => 'パスワードが一致しません'
            ]);
            session()->put(['password' => $request->password]);
        }
        if($request->email !== $member->email) {
            $request->validate([
                'email' => 'required|unique:members|max:200|regex:/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/'
            ], [
                'email.required' => 'メールアドレスは必須です',
                'email.unique' => '既にメールアドレスが存在しています',
                'email.regex' => '正しいメールアドレスを入力してください',
                'email.max' => 'メールアドレスは:max字以内で入力してください'
            ]);
        }

        session()->put([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'email' => $request->email
        ]);

        return view('admin.member.confirm')
            ->with('member', $member);
    }
    public function createSend(Request $request)
    {
        // パスワードをハッシュ化
        $hash_password = bcrypt($request['password']);

        Member::create([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'password' => $hash_password,
            'email' => $request->email
        ]);

        // 二重登録防止
        $request->session()->regenerateToken();
        session()->forget('name_sei');
        session()->forget('name_mai');
        session()->forget('nickname');
        session()->forget('gender');
        session()->forget('password');
        session()->forget('email');

        return redirect()
            ->route('admin.member');
    }
    public function editSend(Request $request, Member $member)
    {
        // パスワードをハッシュ化
        $hash_password = bcrypt($request['password']);

        Member::where('id', $member->id)->update([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'password' => $hash_password,
            'email' => $request->email
        ]);

        // 二重登録防止
        $request->session()->regenerateToken();
        session()->forget('name_sei');
        session()->forget('name_mai');
        session()->forget('nickname');
        session()->forget('gender');
        session()->forget('password');
        session()->forget('email');

        return redirect()
            ->route('admin.member');
    }

    public function show(Member $member)
    {
        return view('admin.member.show')
            ->with(compact('member'));
    }
    public function delete(Member $member)
    {
        Member::where('id', $member->id)->delete();
        return redirect()->route('admin.member');
    }
}
