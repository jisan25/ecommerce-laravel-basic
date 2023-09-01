@extends('admin.layouts.template')
@section('page-title')
Edit Sub Category - Ecommerce
@endsection
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit Sub Category</h4>
<div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Sub Category</h5>
        <small class="text-muted float-end">Input Information</small>
      </div>
      <div class="card-body">
        <form action="{{route('update-sub-category', $data->id)}}" method="POST">
          @csrf
          
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Category Name</label>
            <div class="col-sm-10">
              <input type="text" name="subcategory_name" class="form-control" id="subcategory_name" value="{{$data->subcategory_name}}" placeholder="Electronics" />
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