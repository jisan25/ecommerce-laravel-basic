@extends('admin.layouts.template')
@section('page-title')
All Products - Ecommerce
@endsection
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> All Products</h4>
<div class="card">
    <h5 class="card-header">Available Product Information</h5>
    @if (session()->has('message'))
<div class="alert alert-success">
  {{ session()->get('message'); }}  
</div>    
@endif
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead class="table-light">
          <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Img</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($data as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->product_name }}</td>
            <td>
              <img style="height: 100px" src="{{asset($item->product_img)}}" alt="">
              <br>
              <a href="{{route('edit-product-img', $item->id)}}" class="btn btn-primary">Update</a>
            </td>
            <td>{{$item->price }}</td>
            <td>
                <a href="{{route('edit-product', $item->id)}}" class="btn btn-primary">Edit</a>
                <a href="{{route('delete-product', $item->id)}}" class="btn btn-warning">Delete</a>
            </td>
        </tr>  
          @endforeach
            
        
        </tbody>
      </table>
    </div>
  </div>
@endsection