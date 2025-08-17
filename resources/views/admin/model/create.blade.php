{{-- resources/views/admin/model/create.blade.php --}}
@extends('admin.layouts.admin')
@section('content')
<script>window.location.href = "{{ route('model.index', ['add' => 1]) }}";</script>
@endsection
