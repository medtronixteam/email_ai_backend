@extends('layouts.admin')
@push('css')
<link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap5.min.css')}}"><!-- [Page specific CSS] end -->

@endpush
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Users</a></li>
                        <li class="breadcrumb-item" aria-current="page">Buyers List</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Buyers List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">

            </div> --}}
                <div class="card-body">

                        <table  class="dataTable table table-striped table-bordered nowrap">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($buyers as $buyer)
                                <tr>
                                    <td>{{ $buyer->name }}</td>
                                    <td>{{ $buyer->email }}</td>
                                    <td>{{ $buyer->number }}</td>
                                    <td>
                                        {{-- <a href="{{ route('admin.users.edit', $buyer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                 --}}
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{url('assets/js/plugins/dataTables.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dataTables.bootstrap5.min.js')}}"></script>
<script>
       var table = $('.dataTable').DataTable();
</script>
@endpush
