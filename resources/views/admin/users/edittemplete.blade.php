@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Templates</a></li>
                        <li class="breadcrumb-item" aria-current="page">Templates</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Templates Edit</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="w-75 mx-auto mt-4 p-4" action="{{ route('admin.users.templetupdate', $templet->id) }}" method="POST"
        enctype="multipart/form-data"
        style="
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        ">
        @csrf
        <h4 class="text-center mb-4" style="font-weight: bold; color: #f7f8fa;">Edit Template</h4>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ $templet->name }}" type="text" class="form-control" id="name" name="name" required
                placeholder="Enter name here...">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content Number</label>
            <input type="number" class="form-control" id="content_number" name="content_number" required
                value="{{ $templet->content_number }}" placeholder="How many contents...">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" cols="10" rows="5"
                placeholder="Write content here...">{{ $templet->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset('storage/' . $templet->image) }}" alt="Current Image" class="mt-3" style="width: 100px;">
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary px-4">Update</button>
        </div>
    </form>
    
@endsection
