@extends('layouts.app')
@section('title', 'トップページ')
@section('header')
    @extends((!empty($full_name))? 'headers.login_header':'headers.logout_header')
@endsection
@section('content')
@endsection

