@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="{{ url('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    <style>
        .card-body::-webkit-scrollbar {
            display: none;
        }
        .card-body {
            scrollbar-width: none;
            -ms-overflow-style: none;
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
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header dataTable table table-striped table-bordered nowrap text-center">
                    <h3>Reply A Message</h3>
                </div>
                <div class="card-body">
                   
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header dataTable table table-striped table-bordered nowrap text-center">
                   <h3> Chat Messages</h3>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: auto; scrollbar-width: none;">
                    @foreach ($messages as $message)
                        @if ($message->is_admin == 0)
                            <div class="d-flex justify-content-start mb-3">
                                <div class="p-3 bg-light border rounded">
                                    {{ $message->description }}
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-end mb-3">
                                <div class="p-3 bg-success text-white rounded" style="max-width: 300px">
                                    {{ $message->description }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                

                <div class="card-footer table-bordered" style="background-color: #1B232D; border-top: 1px solid #303F50; padding: 10px;">
                    <form action="{{ route('admin.support.reply', $ticketmessage->id) }}" method="POST" style="display: flex; align-items: center; gap: 10px;">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticketmessage->ticket_id }}">
                        
                        <textarea placeholder="Type your message..." class="form-control" name="message" rows="1" 
                            style="flex: 1; border-radius: 20px; padding: 10px 15px; resize: none; border: 1px solid #ced4da;"></textarea>
                        
                        <button name="submit" type="submit" 
                            style="border-radius: 20px; padding: 8px 20px; background-color: #007bff; color: white; border: none; cursor: pointer;">
                            Send
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    
@endsection
