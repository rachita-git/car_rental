@extends('admin.layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Car Booking Information</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped" id="bookingTable">
        <thead class="table-dark">
            <tr>
                <th>Sl No.</th>
                <th>Customer Name</th>
                <th>Phone No</th>
                <th>Car Regd. No</th>
                <th>Car Image</th>
                <th>Pickup Location</th>
                <th>Pickup Date</th>
                <th>Drop Location</th>
                <th>Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->customer_name ?? 'N/A' }}</td>
                    <td>{{ $booking->phone ?? 'N/A' }}</td>
                    <td>{{ $booking->car->regd_no ?? 'N/A' }}</td>
                    <td>
                        @if($booking->car && $booking->car->image)
                            <img src="{{ asset('car/' . $booking->car->image) }}" width="100" height="60" alt="Car Image">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $booking->pickupLocation->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('d M, Y') }}</td>
                    <td>{{ $booking->dropLocation->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->return_date)->format('d M, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Include DataTables Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#bookingTable').DataTable();
    });
</script>
@endsection
