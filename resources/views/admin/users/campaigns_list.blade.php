@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    <!-- [Page specific CSS] end -->
@endpush
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Campaign</a></li>
                        <li class="breadcrumb-item" aria-current="page">Campaign List</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Campaign List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="dataTable table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Group Name</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Campaign as $Campaign)
                                <tr>
                                    <td>{{ $Campaign->name }}</td>
                                    <td>{{ $Campaign->group->name }}</td>
                                    <td>{{ $Campaign->user->name }}</td>
                                    <td>{{ $Campaign->status }}</td>
                                    <td>
                                        <a href="{{ route('campaign.show', $Campaign->id) }}" class="btn btn-primary">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
