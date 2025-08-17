@extends('admin.layouts.admin')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Models</li>
            </ol>
        </nav>
        <h2 class="h4">Models</h2>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        @if(!request()->has('add'))
        <a href="{{ route('models', ['add' => 1]) }}">
            <button type="button" class="btn btn-block btn-gray-800 mb-3">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Model
            </button>
        </a>
        @endif
    </div>
</div>

{{-- Alert Messages --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Add Model Form --}}
@if(request()->has('add'))
<div id="FormLayoutVertical">
    <div class="demo-card">
        <div class="card mb-4 card-border">
            <div class="card-body">
                <form action="{{ route('model.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Select Brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="">Select</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Model Name</label>
                            <input type="text" name="model_name" class="form-control"
                                placeholder="Enter model name" value="{{ old('model_name') }}">
                            @error('model_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('models') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Table: Show only if not in "Add Mode" --}}
@if(!request()->has('add'))
<div class="card card-body border-0 shadow table-wrapper table-responsive">
    <table class="table table-hover table-bordered" id="datatable">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($models as $key => $model)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $model->brand->name }}</td>
                <td>{{ $model->name }}</td>
                <td>
                    <a href="{{ route('model.edit', $model->id) }}">
                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                    </a>
                    <a href="{{ route('model.delete', $model->id) }}"
                        onclick="return confirm('Are you sure you want to delete this model?');">
                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    setTimeout(function () {
        $(".alert").alert('close');
    }, 3000);
</script>
@endsection
