@extends('admin.layouts.admin')

@section('content')

<style>
    footer {
        display: none;
    }

    .dashboard-card {
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .dashboard-card:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .card-content {
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .icon-box {
        width: 65px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        font-size: 30px;
        margin-right: 20px;
        color: white;
    }

    .bg-customer {
        background: linear-gradient(135deg, rgba(78, 115, 223, 0.9), rgba(34, 74, 190, 0.9));
    }

    .bg-available {
        background: linear-gradient(135deg, rgba(28, 200, 138, 0.9), rgba(18, 143, 94, 0.9));
    }

    .bg-booked {
        background: linear-gradient(135deg, rgba(246, 194, 62, 0.9), rgba(224, 168, 0, 0.9));
    }

    .card-title {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .card-value {
        font-size: 28px;
        font-weight: bold;
        color: #111;
    }
</style>

<div class="container mt-5">
    <div class="row">

        <!-- Customers Card -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-content">
                    <div class="icon-box bg-customer">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <p class="card-title">Total Customers</p>
                        <p class="card-value">{{ $totalCustomers }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Cars Card -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-content">
                    <div class="icon-box bg-available">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <div>
                        <p class="card-title">Available Cars</p>
                        <p class="card-value">{{ $availableCars }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booked Cars Card -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-content">
                    <div class="icon-box bg-booked">
                        <i class="fas fa-car-crash"></i>
                    </div>
                    <div>
                        <p class="card-title">Booked Cars</p>
                        <p class="card-value">{{ $bookedCars }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
