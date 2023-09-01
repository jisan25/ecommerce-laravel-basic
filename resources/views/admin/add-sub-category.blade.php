@extends('admin.layouts.template')
@section('page-title')
Add Sub Category - Ecommerce
@endsection
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Sub Category</h4>
<div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Add Sub Category</h5>
        <small class="text-muted float-end">Input Information</small>
      </div>
      <div class="card-body">
        <form action="{{route('admin-store-sub-category')}}" method="POST">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Category Name</label>
            <div class="col-sm-10">
              <input type="text" name="subcategory_name" class="form-control" id="subcategory_name" placeholder="Electronics" />
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Select Category</label>
            <div class="col-sm-10">
                <select class="form-select" id="category" name="category_id" aria-label="Default select example">
                    <option selected>Category</option>
                    @foreach($data as $item)
                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                    @endforeach

                    
                  </select>
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