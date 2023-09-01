@extends('frontend.layouts.template')
@section('main')
<div class="container">
    <h2>Provide Your Shipping Information</h2>
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <form action="{{route('shipping.address.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City/Village Name</label>
                        <input type="text" class="form-control" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="postal_cond">Postal COde</label>
                        <input type="text" class="form-control" name="postal_code">
                    </div>
                    <input type="submit" value="Next" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection