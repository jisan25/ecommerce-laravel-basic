@extends('admin.layouts.template')
@section('page-title')
Edit Product Image - Ecommerce
@endsection
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit Product Image</h4>
<div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Product Image</h5>
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
        <form action="{{route('update-product-img', $data->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Previous Image</label>
            <div class="col-sm-10">
              <img src="{{asset($data->product_img)}}" style="height: 200px">
            </div>
          </div>

       
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Upload New Image</label>
            <div class="col-sm-10">
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