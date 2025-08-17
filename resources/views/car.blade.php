@extends('layouts.home')

@section('title')
Cars
@endsection

@section('content')
<!-- Header Banner -->
<section class="banner-header section-padding bg-img" data-overlay-dark="5" data-background="img/slider/2.jpg">
    <div class="v-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6>Select Your Car</h6>
                    <h1>Available <span>Cars</span></h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Available Cars Grid -->
<section class="available-cars section-padding">
    <div class="container">
        <div class="row mb-4 text-center">
            <div class="col-md-12">
                <h2 class="section-title">Available <span>Cars</span></h2>
                <p class="section-subtitle">Choose from our best options</p>
            </div>
        </div>

        <div class="row">
            @forelse ($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('car/' . $car->image) }}" class="card-img-top" alt="{{ $car->brand->name }} {{ $car->model->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->brand->name }} - {{ $car->model->name }}</h5>
                            <p class="card-text"><strong>Price/Day:</strong> ₹{{ number_format($car->price_per_day) }}</p>
                            <p class="card-text"><strong>Registration No:</strong> {{ $car->regd_no }}</p>
                        </div>
                        <div class="card-footer text-center">
                            @if($car->status == 0)
                                <a href="#0"
                                   data-bs-toggle="modal"
                                   data-bs-target="#exampleModal"
                                   class="btn text-white"
                                   style="background-color: #FFC107; border-radius: 30px; font-weight: 600;"
                                   data-car-id="{{ $car->id }}">
                                   Rent Now <i class="ti-arrow-top-right"></i>
                                </a>
                            @else
                                <button class="btn btn-secondary" disabled style="border-radius: 30px;">Booked</button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <h5>No cars available at the moment.</h5>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Script for Modal Handling -->
<script>
    $(document).ready(function() {
        let selectedCarId = null;

        $('.rent_now_btn').on('click', function() {
            selectedCarId = $(this).data('car-id');
        });

        $('#exampleModal').on('shown.bs.modal', function() {
            $('#car_id').val(selectedCarId);
        });
    });
</script>
@endsection
