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
                    <li class="breadcrumb-item" aria-current="page">Reset Password</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Reset Password</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row gy-4">
    <div class="col-md-12 col-lg-12">
        <div class="card h-100">
            <div class="card-header bg-dark h4 text-white">
                Reset Password
            </div>
            <div class="card-body">
                <form action="{{ route('reset.password') }}" id="resetForm" method="POST">
                    @csrf
                    <input type="hidden" name="resetId" value="{{ $id }}">
                    <div class="row form-group">
                        <div class="col-6">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="col-6">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <button class="btn btn-primary float-right" type="submit">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    document.getElementById('resetForm').addEventListener('submit', function(event) {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (newPassword !== confirmPassword) {
            event.preventDefault();
            alert('Passwords do not match. Please try again.');
        }
    });
</script>
@endpush
