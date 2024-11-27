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
                            <div id="page-views-graph"></div>
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
                            <div id="total-task-graph"></div>
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
   

    {{-- <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-warning"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z"
                                    stroke="#E58A00" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.6" d="M14.5 4.5V6.5C14.5 7.6 15.4 8.5 16.5 8.5H18.5"
                                    stroke="#E58A00" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.6" d="M8 13H12" stroke="#E58A00" stroke-width="1.5"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.6" d="M8 17H16" stroke="#E58A00" stroke-width="1.5"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total Sellers</h6>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="dropdown"><a
                                class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="ti ti-dots-vertical f-18"></i></a>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                    href="#">Today</a> <a class="dropdown-item" href="#">Weekly</a> <a
                                    class="dropdown-item" href="#">Monthly</a></div>
                        </div>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <div id="page-views-graph"></div>
                        </div>
                        <div class="col-5">
                            <h5 class="mb-1">290K+</h5>
                            <p class="text-warning mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%</p>
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
                        <div class="avtar avtar-s bg-light-success"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 2V5" stroke="#2ca87f" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 2V5" stroke="#2ca87f" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M3.5 9.08984H20.5" stroke="#2ca87f"
                                    stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                    stroke="#2ca87f" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M15.6947 13.7002H15.7037" stroke="#2ca87f"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M15.6947 16.7002H15.7037" stroke="#2ca87f"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M11.9955 13.7002H12.0045" stroke="#2ca87f"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M11.9955 16.7002H12.0045" stroke="#2ca87f"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M8.29431 13.7002H8.30329" stroke="#2ca87f"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M8.29395 16.7002H8.30293" stroke="#2ca87f"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Total Buyers</h6>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="dropdown"><a
                                class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="ti ti-dots-vertical f-18"></i></a>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                    href="#">Today</a> <a class="dropdown-item" href="#">Weekly</a> <a
                                    class="dropdown-item" href="#">Monthly</a></div>
                        </div>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <div id="total-task-graph"></div>
                        </div>
                        <div class="col-5">
                            <h5 class="mb-1">839</h5>
                            <p class="text-success mb-0"><i class="ti ti-arrow-up-right"></i> New</p>
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
                        <div class="avtar avtar-s bg-light-danger"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                    stroke="#DC2626" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402"
                                    stroke="#DC2626" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" /></svg></div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">App Users</h6>
                    </div>
                    <div class="flex-shrink-0 ms-3">
                        <div class="dropdown"><a
                                class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="ti ti-dots-vertical f-18"></i></a>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                    href="#">Today</a> <a class="dropdown-item" href="#">Weekly</a> <a
                                    class="dropdown-item" href="#">Monthly</a></div>
                        </div>
                    </div>
                </div>
                <div class="bg-body p-3 mt-3 rounded">
                    <div class="mt-3 row align-items-center">
                        <div class="col-7">
                            <div id="download-graph"></div>
                        </div>
                        <div class="col-5">
                            <h5 class="mb-1">2,067</h5>
                            <p class="text-danger mb-0"><i class="ti ti-arrow-up-right"></i> 30.6%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}

@endsection
