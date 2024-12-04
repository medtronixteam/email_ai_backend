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
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Templates</a></li>
                        <li class="breadcrumb-item" aria-current="page">Templates</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Templates Store</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form class="w-75 mx-auto mt-4 p-4" action="{{ route('admin.users.templetstore') }}" method="POST"
                    enctype="multipart/form-data"
                    style="
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                    ">
                    @csrf
                    <h4 class="text-center mb-4" style="font-weight: bold; color: #f7f8fa;">Add Templates</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="" type="text" class="form-control" id="name" name="name" required
                            placeholder="Enter name here...">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content Number</label>
                        <input type="number" class="form-control" id="content_number" name="content_number" required
                            placeholder="how many contents...">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="10" rows="5"
                            placeholder="Write content here..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-md-12 mt-4">
        <div class="page-header-title">
            <h2 class="mb-0">Templates List</h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card animated-card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Content Number</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templets as $templet)
                                <tr>
                                    <td>{{ $templet->name }}</td>
                                    <td>{{ $templet->content_number }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $templet->image) }}" alt="Template Image"
                                            style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $templet->created_at }}</td>
                                    <td>    
                                        <a href="{{ route('admin.users.templetedit', $templet->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="javascript:void(0)" onclick="confirmdelete({{ $templet->id }})"
                                            class="btn btn-warning">delete</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ url('assets/js/plugins/dataTables.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
<script>
      function confirmdelete(templateId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this template?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'admin/template/delete/' + templateId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            Swal.fire(
                                'deleted!',
                                'User has been deleted.',
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