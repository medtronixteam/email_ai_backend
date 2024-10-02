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
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Users</a></li>
                        <li class="breadcrumb-item" aria-current="page">User List</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">User List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="dropdown mb-3">
                        <button class="btn p-0 border-0 bg-transparent" type="button" id="filterDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter text-white" style="font-size: 1.5rem;"></i> Filter Users
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterUsers(1)">Enable Users</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterUsers(0)">Disable
                                    Users</a></li>
                        </ul>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">
                                Add User
                            </button>
                        </div>
                    </div>

                    <table class="dataTable table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Joining</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->number }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->status == 1 ? 'Enable' : 'Disable' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn p-0 border-0 bg-transparent" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis text-white" style="font-size: 1.5rem;"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if ($user->status == 1)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.users.view', $user->id) }}">View</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" class="dropdown-item"
                                                            onclick="confirmDisable({{ $user->id }})">Disable</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="javascript:void(0)" class="dropdown-item"
                                                            onclick="confirmEnable({{ $user->id }})">Enable</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ url('assets/js/plugins/dataTables.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        var table = $('.dataTable').DataTable();

        function filterUsers(status) {
            var statusText = status == 1 ? 'Enable' : 'Disable';
            table.column(4).search(statusText).draw();
        }

        function confirmDisable(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to disable this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, disable it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/users/disable/' + userId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire(
                                'Disabled!',
                                'User has been disabled.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        }

        function confirmEnable(userId) {
            Swal.fire({
                title: 'This user is disabled.',
                text: "Do you want to enable this user?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, enable it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/users/enable/' + userId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire(
                                'Enabled!',
                                'User has been enabled.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            })
        }
    </script>
@endpush
