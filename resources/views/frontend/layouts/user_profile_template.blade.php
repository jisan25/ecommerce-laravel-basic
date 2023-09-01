@extends('frontend.layouts.template')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box_main">
                <ul>
                    <li><a href="{{route('user.profile')}}">Dashboard</a></li>
                    <li><a href="{{route('pending.orders')}}">Pending Orders</a></li>
                    <li><a href="{{route('history')}}">History</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="box_main">
                @yield('profile-content')
            </div>
        </div>
    </div>
</div>
@endsection
