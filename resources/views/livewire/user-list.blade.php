<div>

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
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterUsers(1)">Enable
                                    Users</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterUsers(0)">Disable
                                    Users</a></li>
                        </ul>
                        <div class="d-flex justify-content-end">
                            <button wire:click='toggleList' type="button" class="btn btn-primary">
                                {{ $addUserPortionText }}
                            </button>
                        </div>
                    </div>
                    @if (!$addUserPortion)
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
                                        <td>
                                            {{ $user->name }}
                                            @if ($user->email_verified_at)
                                                <span style="color: green; font-size: 15px;">✔️</span>
                                            @else
                                                <span style="color: red; font-size: 15px;">❌</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->number }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->status == 1 ? 'Enable' : 'Disable' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn p-0 border-0 bg-transparent" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis text-white"
                                                        style="font-size: 1.5rem;"></i>
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
                                                        <li>
                                                            <a href="{{ route('user.reset', $user->id) }}"
                                                                class="dropdown-item">Reset Password</a>
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
                        <div class="d-flex justify-content-end mt-3">
                            {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    @else
                        <div class="container ">

                            <div class="row ">
                                <div class="col-sm-6 mx-auto">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" wire:model='name' class="form-control" id="name"
                                                name="name" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" wire:model='email' class="form-control" id="email"
                                                name="email" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" wire:model='password' class="form-control"
                                                id="password" name="password" required>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" wire:click='addUser'
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
