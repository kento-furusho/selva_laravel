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
        return view('admin.member_search')
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
            return redirect()->route('admin.member');
        }
        // \DB::enableQueryLog();
        $url = Member::search($id, $man, $woman, $free_word);
        $members = $url->orderBy('id', 'desc')->paginate(10);
        session()->put('order', 'desc');
        // ddd(\DB::getQueryLog());
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.member_search')
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
        return view('admin.member_search')
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
        return view('admin.member_search')
            ->with(compact('members'));
    }
}
