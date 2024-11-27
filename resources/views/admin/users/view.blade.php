@extends('layouts.admin')
@push('css')
<style>
    @keyframes rotateIn {
        0% {
            transform: rotateY(-90deg);
            opacity: 0;
        }
        100% {
            transform: rotateY(0deg);
            opacity: 1;
        }
    }

    .animated-card {
        animation: rotateIn 0.6s ease-in;
    }
</style>
@endpush
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route("admin.users.list")}}">Users</a></li>
                    <li class="breadcrumb-item" aria-current="page">Details</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0"> Details</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card animated-card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Date of Birth</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $sellers->name }}</td>
                            <td>{{ $sellers->email }}</td>
                            <td>{{ $sellers->number }}</td>
                            <td>{{ $sellers->country }}</td>
                            <td>{{ $sellers->date_of_birth }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="page-header-title">
        <h2 class="mb-0">Recent Plans</h2>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card animated-card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Plan</th>
                            <th>Expiry date</th>
                            <th>Recent Plan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $sellers->user_plan }}</td>
                            <td>{{ $sellers->expiry_date }}</td>
                            <td>{{ $sellers->recent_plan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="page-header-title">
        <h2 class="mb-0">Campaign Details</h2>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card animated-card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Campaign Time</th>
                            <th>Campaign Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($campaign)
                            <tr>
                                <td>{{ $campaign->name }}</td>
                                <td>{{ $campaign->message }}</td>
                                <td>{{ $campaign->campaign_time }}</td>
                                <td>{{ $campaign->campaign_date }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4">No campaign found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')

@endpush
