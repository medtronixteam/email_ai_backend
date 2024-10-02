@extends('layouts.admin')
@push('css')

@endpush
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0)">Users</a></li>
                    <li class="breadcrumb-item" aria-current="page">Details</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Details</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row gy-4">
    <!--  Card -->
    <div class="col-md-12 col-lg-12">
        <div class="card h-100">
            <div class="card-header bg-dark h4 text-white">
                Reset Name & Email
            </div>
            <div class="card-body">



                <form action="{{ route('profile.reset.name') }}" method="POST" enctype="multipart/form-data" >
                    @csrf

                   <div class="row form-group">
                    <div class="col-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" value="{{auth()->user()->name}}"  class="form-control" id="name" name="name" required>

                    </div>
                    <div class="col-6">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" value="{{auth()->user()->email}}"   class="form-control" id="name" name="email" required>

                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <button class="btn btn-primary float-right" type="submit">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--/  Card -->
</div>

@endsection
@push('js')

@endpush
