@extends('admin.layouts.template')
@section('page-title')
Pending Orders - Ecommerce
@endsection
@section('content')
   <div class="container my-5">
    <div class="card p-4">
        <div class="card-title">
            <h2 class="text-center">
                Pending Orders
            </h2>
        </div>
        <div class="card-body">
                <table class="table">
                    <tr>
                        <th>User Id</th>
                        <th>Shipping Information</th>
                        <th>Product Id</th>
                        <th>Quantity</th>
                        <th>Total Will Pay</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
            @foreach ($pending_orders as $item)
            <tr>
                <td>{{ $item->userid }}</td>
                <td>
                    <ul>
                        <li>Phone Number - {{ $item->shipping_phonenumber }}</li>
                        <li>City - {{ $item->shipping_city }}</li>
                        <li>Postal Code - {{ $item->shipping_postalcode }}</li>
                    </ul>
                </td>
                <td>{{ $item->product_id }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->total_price }}</td>
                <td>
                    <a href="#" class="btn btn-success">Confirm Order</a>
                </td>
            </tr>
            @endforeach
    
                </table>
        </div>
    </div>
   
   </div>
@endsection