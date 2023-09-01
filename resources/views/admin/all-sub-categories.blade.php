@extends('admin.layouts.template')
@section('page-title')
All Sub Categories - Ecommerce
@endsection
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> All Sub Categories</h4>
@if (session()->has('message'))
<div class="alert alert-success">
  {{ session()->get('message'); }}  
</div>    
@endif
<div class="card">
    <h5 class="card-header">Available Sub Category Information</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead class="table-light">
          <tr>
            <th>Id</th>
            <th>Sub Category Name</th>
            <th>Category</th>
            <th>Products</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($data as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->subcategory_name }}</td>
            <td>{{$item->category_name}}</td>
            <td>{{$item->product_count}}</td>
            <td>
                <a href="{{route('edit-sub-category', $item->id)}}" class="btn btn-primary">Edit</a>
                <a href="{{route('delete-sub-category', $item->id)}}" class="btn btn-warning">Delete</a>
            </td>
        </tr>  
          @endforeach
            
        
        </tbody>
      </table>
    </div>
  </div>
@endsection