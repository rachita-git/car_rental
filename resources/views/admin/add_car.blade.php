@extends('admin.layouts.admin')

@section('content')
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h3 class="mb-4">Register New Car</h3>
    <form method="POST" action="{{ route('car_register') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="brand_id" class="form-label">Brand</label>
            <select name="brand_id" id="brand_id" class="form-select" required>
                <option value="">-- Select Brand --</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="model_name" class="form-label">Model</label>
            <select name="model_name" id="model_name" class="form-select" required>
                <option value="">-- Select Model --</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ old('year') }}" required>
        </div>

        <div class="mb-3">
            <label for="registration" class="form-label">Registration No</label>
            <input type="text" name="registration" class="form-control" value="{{ old('registration') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price per Day</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Car Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register Car</button>
        <a href="{{ route('registration') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    setTimeout(function() {
        $(".alert").alert('close');
    }, 3000);

    $(document).ready(function() {
        $('#brand_id').on('change', function() {
            var brand_id = $(this).val();
            var url = '{{ route("get_model", ":id") }}'.replace(':id', brand_id);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var $select = $('#model_name');
                    $select.empty();
                    $select.append('<option value="">-- Select model --</option>');
                    $.each(data, function(index, item) {
                        $select.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    });
</script>
@endsection