@extends('admin.layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Car Registration List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('car.create') }}" class="btn btn-primary mb-3">Register New Car</a>

    <table class="table table-bordered table-striped" id="carTable">
        <thead class="table-dark">
            <tr>
                <th>Sl No.</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Image</th>
                <th>Year</th>
                <th>Registration No</th>
                <th>Price/Day</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $index => $car)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $car->brand->name ?? 'N/A' }}</td>
                    <td>{{ $car->model->name ?? 'N/A' }}</td>
                    <td>
                        @if($car->image)
                            <img src="{{ asset('car/' . $car->image) }}" width="100" height="60" alt="Car Image">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->regd_no }}</td>
                    <td>₹{{ $car->price_per_day }}</td>
                    <td>{{ $car->status==0 ? 'Available' : 'Booked' }}</td>
                    <td>
                        <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('car.delete', $car->id) }}" method="POST" style="display:inline-block;" 
                              onsubmit="return confirm('Are you sure you want to delete this car?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#carTable').DataTable();
    });
</script>
@endsection
