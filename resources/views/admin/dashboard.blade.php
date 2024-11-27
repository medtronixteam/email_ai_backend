@extends('layouts.admin')
@section('content')
<div class="row">

    <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total Users</h6>
                    </div>

                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <div id="all-earnings-graph"></div>
                        </div>
                        <div class="col-5">
                            <h3 class="mb-1">{{ $totalUsers }}</h3>
                            <p class="text-primary mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Active Plans Users</h6>
                    </div>

                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <div id="all-earnings-graph"></div>
                        </div>
                        <div class="col-5">
                            <h3 class="mb-1"></h3>
                            <p class="text-primary mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Free Plan Users</h6>
                    </div>

                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <div id="all-earnings-graph"></div>
                        </div>
                        <div class="col-5">
                            <h3 class="mb-1"></h3>
                            <p class="text-primary mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
