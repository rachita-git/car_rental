@extends('admin.layouts.admin')

@section('content')
<div class="container py-4">
    <h4>Edit Car</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="card card-body">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="brand_id">Brand</label>
                <select name="brand_id" class="form-control" required>
                    <option value="">-- Select Brand --</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $car->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="model_name">Model</label>
                <select name="model_name" class="form-control" required>
                    <option value="">-- Select Model --</option>
                    @foreach($models as $model)
                    <option value="{{ $model->id }}" {{ $car->model_id == $model->id ? 'selected' : '' }}>
                        {{ $model->name }}
                    </option>
                    @endforeach
                </select>

            </div>

            <div class="col-md-4 mb-3">
                <label for="year">Year</label>
                <input type="text" name="year" value="{{ $car->year }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="registration">Registration No.</label>
                <input type="text" name="registration" value="{{ $car->regd_no }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="price">Price Per Day</label>
                <input type="number" name="price" value="{{ $car->price_per_day }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="status">Availability</label>
                <select name="status" class="form-control" required>
                    <option value="0" {{ $car->status == 0 ? 'selected' : '' }}>Available</option>
                    <option value="1" {{ $car->status == 1 ? 'selected' : '' }}>Booked</option>
                </select>
            </div>


            <div class="col-md-6 mb-3">
                <label for="image">Car Image</label>
                <input type="file" name="image" class="form-control">
                <br>
                <img src="{{ asset('car/' . $car->image) }}" width="100">
            </div>
        </div>

        <button type="submit" class="btn btn-success col-md-4">Update Car</button>
        <a href="{{ route('registration') }}" class="btn btn-secondary col-md-4">Cancel</a>
    </form>
</div>
@endsection