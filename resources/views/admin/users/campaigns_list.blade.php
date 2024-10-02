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
                                <th>Contacts</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Campaign as $campaign)
                                <tr>
                                    <td>{{ $campaign->name }}</td>
                                    <td>{{ $campaign->group->name }}</td>
                                    <td>{{ $campaign->user->name }}</td>
                                    <td>{{ $campaign->status }}</td>
                                    <td>
                                        <ul>
                                            @php
                                              $totalSent=App\Models\Contact::where('group_id',($campaign->group->id)?$campaign->group->id:0)->where('is_sent',1)->count();
                                              $is_failed=App\Models\Contact::where('group_id',($campaign->group->id)?$campaign->group->id:0)->where('is_failed',1)->count();
                                            @endphp
                                              <li>
                                                    Sent: {{ $totalSent}} |
                                                    Failed: {{ $is_failed}}
                                                </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('campaign.show', $campaign->id) }}" class="btn btn-primary">
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
