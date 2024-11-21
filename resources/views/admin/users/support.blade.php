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
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Tickets</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tickets Messages</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Tickets Messages</h2>
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
                                <th>#</th>
                                <th>Message</th>
                                <th>created at</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $ticketmessage->id }}</td>
                                    <td>{{ $ticketmessage->description }}</td>
                                    <td>{{ $ticketmessage->created_at }}</td>                                    
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header dataTable table table-striped table-bordered nowrap text-center">
                    <h3>Reply A Message</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.support.reply', $ticketmessage->id) }}" method="POST">
                        @csrf
                       
                        <input type="hidden" name="ticket_id" value="{{ $ticketmessage->ticket_id }}">
                        
                        <div class="form-group">
                            <textarea placeholder="Describe your message here" class="form-control" name="message" rows="10"></textarea>
                        </div>
                        
                        <div class="form-group mt-2">
                            <button name="submit" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
