@extends('admin.layout')

@section('page-title', 'Create Page')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Page Details</h3>
            </div>
            @include('admin.pages._form')
        </div>
    </div>
@endsection
