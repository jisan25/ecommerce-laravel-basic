@extends('admin.layouts.template')
@section('page-title')
Edit Product - Ecommerce
@endsection
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit Product</h4>
<div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Product</h5>
        <small class="text-muted float-end">Input Information</small>
      </div>
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{route('update-product', $data->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
            <div class="col-sm-10">
              <input type="text" name="product_name" class="form-control" id="product_name" value="{{$data->product_name}}" placeholder="Electronics" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Price</label>
            <div class="col-sm-10">
              <input type="number" value="{{$data->price}}" name="price" class="form-control" id="price" placeholder="12" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Quantity</label>
            <div class="col-sm-10">
              <input type="number" value="{{$data->quantity}}" name="quantity" class="form-control" id="quantity" placeholder="1000" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Short Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="product_short_des" id="product_short_des" cols="30" rows="2">{{ $data->product_short_des }}</textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Product Long Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="product_long_des" id="product_long_des" cols="30" rows="5">{{ $data->product_long_des }}</textarea>
            </div>
          </div>

          

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Select Category</label>
            <div class="col-sm-10">
                <select class="form-select" id="category" name="product_category_id" aria-label="Default select example">
                  @foreach($categories as $item)
                  <option {{ $item->id == $data->product_category_id ? 'selected':'' }} value="{{$item->id}}">{{$item->category_name}}</option>
                  @endforeach
                  </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Select Sub Category</label>
            <div class="col-sm-10">
                <select class="form-select" id="category" name="product_subcategory_id" aria-label="Default select example">
                  @foreach($sub_categories as $sub_cat)
                  <option {{ $sub_cat->id == $data->product_subcategory_id ? 'selected':'' }} value="{{$sub_cat->id}}">{{$sub_cat->subcategory_name}}</option>
                  @endforeach
                  </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Upload Product Image</label>
            <div class="col-sm-10">
                <img src="{{ asset($data->product_img) }}" style="height: 100px"><br>
                <input class="form-control" type="file" id="formFile" name="product_img" />
            </div>
          </div>
        
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection