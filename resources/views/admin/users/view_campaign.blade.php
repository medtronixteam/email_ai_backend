@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    <style>
        .message-box {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .breadcrumb-item.active {
            color: #007bff;
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
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Campaign</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Campaign Detail</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Campaign Detail</h2>
                        <h4 class="mb-0 mt-2 text-muted">{{ $Campaign->name }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Group Name</th>
                                    <th>User Name</th>
                                    <th>Status</th>
                                    <th>Email host</th>
                                    <th>Campaign Time</th>
                                    <th>Campaign Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $Campaign->group->name }}</td>
                                    <td>{{ $Campaign->user->name }}</td>
                                    <td>{{ $Campaign->status }}</td>
                                    <td>{{ $Campaign->email_host }}</td>
                                    <td>{{ $Campaign->campaign_time }}</td>
                                    <td>{{ $Campaign->campaign_date }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="message-box">
                                            <strong>Message:</strong>
                                            <p>{{ $Campaign->message }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Mailer</th>
                                    <th>Host</th>
                                    <th>Port</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Encryption</th>
                                    <th>From address</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userEmail as $email)
                                <tr>
                                    <td>{{ $email->mail_type }}</td>
                                    <td>{{ $email->main_mailer }}</td>
                                    <td>{{ $email->main_host }}</td>
                                    <td>{{ $email->main_port }}</td>
                                    <td>{{ $email->main_username }}</td>
                                    <td>{{ $email->main_password }}</td>
                                    <td>{{ $email->main_encryption }}</td>
                                    <td>{{ $email->main_from_address }}</td> 
                                    <td>{{ $email->main_from_name }}</td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Table for Group Details -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2 class="card-title">Emails Detail</h2>
                    <div class="d-flex">
                        <div class="card me-2 bg-behance" style="width: 150px; height:80px;">
                            <div class="card-body">
                                <h5 class="card-title">Total Sent</h5>
                                <p class="card-text">{{ $Campaign->group->contacts->where('is_sent', true)->count() }}</p>
                            </div>
                        </div>

                        <div class="card bg-danger" style="width: 150px; height:80px;">
                            <div class="card-body">
                                <h5 class="card-title">Total Failed</h5>
                                <p class="card-text">{{ $Campaign->group->contacts->where('is_failed', true)->count() }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Failed Reason</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Campaign->group->contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        @if ($contact->is_sent)
                                            Sent
                                        @else
                                            Failed
                                        @endif
                                    </td>
                                    <td>{{ $contact->failed_reason }}</td>
                                    <td>{{ $contact->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
