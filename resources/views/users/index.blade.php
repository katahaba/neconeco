@extends('layouts.app')

@section('content')
    @include('users.users', ['users' => $users])//後々のために分離させてあるuser.blade.phpをincludeしている
@endsection
