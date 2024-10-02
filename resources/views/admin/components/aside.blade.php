<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header"><a href="/" class="b-brand text-primary">
                {{-- <img src="{{url("logo/single-01.png")}}" class="img-fluid logo-lg" alt="logo"> --}}
                <h3>ADMIN PANEL</h3>
            </a></div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0"><img src="{{url(auth()->user()->profile_photo)}}" alt="user-image"
                                class="user-avtar wid-45 rounded-circle"></div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0">{{auth()->user()->username}}</h6><small></small>
                        </div><a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                            href="#pc_sidebar_userlink"><svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg></a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3"><a href="/profile"><i class="ti ti-user"></i> <span>My Account</span> </a>
                            <a
                                href="javascript:void(0)"><i class="ti ti-settings"></i> <span>Settings</span> </a>
                                <a  href="/logout"><i class="ti ti-power"></i> <span>Logout</span></a></div>
                    </div>
                </div>
            </div>
            <ul class="pc-navbar">
                <li class="pc-item pc-caption"><label>Navigation</label></li>
                <li class="pc-item"><a href="{{ route('dashboard') }}" class="pc-link"><span class="pc-micon"><svg
                                class="pc-icon">
                                <use xlink:href="#custom-story"></use>
                            </svg> </span><span class="pc-mtext">Dashboard</span></a></li>
                <li class="pc-item pc-hasmenu"><a href="{{ route('admin.users.list') }}" class="pc-link"><span class="pc-micon"><svg
                                class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg> </span><span class="pc-mtext">Users</span> <span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span>

                    </a>
                    {{-- <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="">List</a>
                        </li>
                           </ul> --}}
                </li>
                <li class="pc-item pc-hasmenu"><a href="{{ route('admin.users.campaigns_list') }}" class="pc-link"><span class="pc-micon"><svg
                                class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg> </span><span class="pc-mtext">Campaigns</span> <span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span>

                    </a>
                    {{-- <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="">List</a>
                        </li>
                           </ul> --}}
                </li>
                {{-- <li class="pc-item pc-hasmenu"><a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><svg
                                class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg> </span><span class="pc-mtext">Contacts</span> <span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span>

                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('admin.users.contact_list') }}">List</a>
                        </li>
                           </ul>
                </li> --}}

                {{-- <li class="pc-item pc-hasmenu"><a href="javascript:void(0)" class="pc-link"><span class="pc-micon"><svg
                                class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg> </span><span class="pc-mtext">Dashboard</span> <span class="pc-arrow"><i
                                data-feather="chevron-right"></i></span> <span class="pc-badge">2</span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="index.html">Default</a></li>
                        <li class="pc-item"><a class="pc-link" href="analytics.html">Analytics</a></li>
                        <li class="pc-item"><a class="pc-link" href="finance.html">Finance</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
