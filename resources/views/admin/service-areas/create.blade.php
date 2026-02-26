@extends('admin.layout')

@section('page-title', 'Create Service Area')

@section('content')
    <div class="max-w-4xl rounded-lg bg-white p-6 shadow">
        <h3 class="mb-6 text-lg font-semibold">Create Service Area</h3>

        <form method="POST" action="{{ route('admin.service-areas.store') }}">
            @include('admin.service-areas._form')
        </form>
    </div>
@endsection
