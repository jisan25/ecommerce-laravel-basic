

@extends('frontend.layouts.template')
@section('main')
<div class="container">
    <h2 class="py-1 pt-5 mt-5">Add To Cart Page</h2>
    @if (session()->has('message'))
    <div class="alert alert-success">
      {{ session()->get('message'); }}  
    </div>
@endif

    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @php 
                        $total = 0;

                        @endphp
                        @foreach($cart_items as $item)

                        <tr>
                            @php 
$product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
$product_img = App\Models\Product::where('id', $item->product_id)->value('product_img');
@endphp
                            <td><img height="100px" width="100px" src="{{asset($product_img)}}" alt=""></td>
                            <td>{{ $product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td><a href="{{route('remove.cart', $item->id)}}" class="btn btn-warning">Remove</a></td>
                        </tr>
                        @php 
                        $total = $total + $item->price;
                        @endphp 
                        @endforeach
                        @if($total>0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total }}</td>
                            <td><a href="{{route('shipping.address')}}" class="btn btn-primary">Checkout</a></td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection