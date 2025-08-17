@extends('admin.layouts.admin')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
  <div class="d-block mb-4 mb-md-0">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
      <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
        <li class="breadcrumb-item">
          <a href="#">
            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Brands</li>
        <li class="breadcrumb-item"><a href="#">Create</a></li>
      </ol>
    </nav>
    <h2 class="h4">Add Brand</h2>
  </div>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{ route('brands') }}">
      <button type="button" class="btn btn-block btn-gray-800 mb-3" data-bs-toggle="modal" data-bs-target="#modal-form">
        Back
      </button>
    </a>
  </div>
</div>
<div id="FormLayoutVertical">
  <div class="demo-card">
    <div class="card mb-9 card-border">
      <div class="card-body">
        <form action="{{ route('brand.store') }}" method="post">
          @csrf
          <div class="form-container vertical">
            <div class="form-item vertical col-4">
              <label class="form-label mb-2">Name</label>
              <div>
                <input
                  class="form-control"
                  type="text"
                  name="brand_name"
                  placeholder="Please enter brand name" />
                @error('brand_name')
                <div class="text-rose-600">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-item vertical">
              <label class="form-label"></label>
              <div>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection