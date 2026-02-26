@extends('admin.layout')

@section('page-title', 'Edit Service Area')

@section('content')
    <div class="max-w-4xl rounded-lg bg-white p-6 shadow">
        <h3 class="mb-6 text-lg font-semibold">Edit Service Area</h3>

        <form method="POST" action="{{ route('admin.service-areas.update', $serviceArea) }}">
            @method('PUT')
            @include('admin.service-areas._form')
        </form>
    </div>
@endsection
