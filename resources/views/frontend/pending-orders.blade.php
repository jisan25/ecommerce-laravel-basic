@extends('frontend.layouts.user_profile_template')
@section('profile-content')
pending orders
@if (session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message'); }}  
    </div>    
  @endif
  <table class="table">
    <tr>
      <th>Product Id</th>
      <th>Price</th>
    </tr>
    @foreach ($pending_orders as $item)
        <tr>
          <td>
            {{$item->product_id}}
          </td>
          <td>
            {{$item->total_price}}
          </td>
        </tr>
    @endforeach
  </table>
@endsection