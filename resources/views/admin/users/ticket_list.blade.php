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
                        <li class="breadcrumb-item" aria-current="page">Tickets List</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Tickets List</h2>
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
                                <th>Title</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>
                                        @if($ticket->status === 'closed')
                                            <a href="javascript:void(0)" onclick="confirmopen({{ $ticket->id }})" class="btn btn-success">
                                                Closed
                                            </a>
                                        @elseif($ticket->status === 'open')
                                            <a href="{{ route('admin.ticket.message', $ticket->id) }}" class="btn btn-primary">
                                                Reply
                                            </a>
                                            <a href="javascript:void(0)" onclick="confirmclosed({{ $ticket->id }})" class="btn btn-danger">
                                                Close
                                            </a>
                                        @endif
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
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
         function confirmclosed(ticketId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to close this Ticket?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, close it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/ticket/closed/' + ticketId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire(
                                'Closed!',
                                'Ticket has been Closed.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        }
        //  function confirmopen(ticketId) {
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You want to open this Ticket?",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, open it!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: '/ticket/open/' + ticketId,
        //                 method: 'POST',
        //                 data: {
        //                     _token: '{{ csrf_token() }}'
        //                 },
        //                 success: function() {
        //                     Swal.fire(
        //                         'Opened!',
        //                         'Ticket has been Open.',
        //                         'success'
        //                     ).then(() => {
        //                         location.reload();
        //                     });
        //                 }
        //             });
        //         }
        //     })
        // }

    </script>
@endpush