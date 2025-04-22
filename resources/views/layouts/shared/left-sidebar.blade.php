<!-- ========== Left Sidebar Start ========== -->
<div class="app-menu sidebgcolor">

    <div class="logo-box">

        <a href="{{ route('admin.home') }}" class="logo-light">
            <img src="/images/logo/home-logo2.png" alt="dark logo" class="logo-lg" style="height: 40px;">
            <img src="/images/ifci-icon.png" alt="small logo" class="logo-sm"style="height: 40px;">

        </a>
        <a href="{{ route('admin.home') }}" class="logo-dark">
            <img src="/images/logo/home-logo2.png" alt="dark logo" class="logo-lg" style="height: 40px;">

        <a href="#" class="logo-light">
             <img src="/images/logo/home-logo2.png" alt="dark logo" class="logo-lg" style="height: 40px;">
            <img src="/images/ifci-icon.png" alt="small logo" class="logo-sm"style="height: 40px;">

        </a>
        <a href="#" class="logo-dark">
              <img src="/images/logo/home-logo2.png" alt="dark logo" class="logo-lg" style="height: 40px;">

            <img src="/images/ifci-icon.png" alt="small logo" class="logo-sm"style="height: 40px;">
        </a>
    </div>

    <div class="scrollbar h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center border-top border-bottom">


            @if (auth()->user()->image)
                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="user-image"
                    alt="user-img"class="rounded-circle avatar-md">
            @else
                <img src="/images/user-profile.jpg" alt="user-image" alt="user-img" title="Mat Helme"
                    class="rounded-circle avatar-md">
            @endif
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block textcolor"
                    data-bs-toggle="dropdown"> {{ auth()->user()->contact_person }}</a>
                <div class="dropdown-menu user-pro-dropdown">
                    <!-- item-->
                    <!--     <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a> -->


                    <!-- item-->
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="javascript:void(0);" class="dropdown-item notify-item"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </div>
            </div>
            <p class="text-muted mb-0">{{ auth()->user()->designation }}</p>
        </div>

        <!--- Sidemenu -->
                {{ dd(Auth::user()->getRoleNames(),Auth::user()->hasRole('Admin') && Auth::user()->hasRole('SubAdmin') && Auth::user()->hasRole('Corporate')) }}
        <ul id="side-menu" class="menu">
            {{-- <li class="menu-title">Navigation</li> --}}
            @if (Auth::user()->hasRole('SuperAdmin'))

                <li class="menu-item">
                    <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}"
                        href="{{ route('admin.home') }}">
                        <span class="menu-icon">
                            <i class="fa fa-home"></i>
                        </span>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}"
                        href="{{ route('admin.user.adminhome') }}">
                        <span class="menu-icon">
                            <i class="fa fa-user"></i>
                        </span>
                        <span class="menu-text">Profile</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link textcolor" href="#Banksidebar" data-bs-toggle="collapse">
                        <span class="menu-icon"><i data-feather="globe"></i></span>
                        <span class="menu-text"> Manage Bank </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="Banksidebar">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.new_admin.index') }}" class="menu-link"><span
                                        class="menu-text">View Bank List</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.new_admin.create') }}" class="menu-link"><span
                                        class="menu-text">Add Bank</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <a class="menu-link textcolor" href="#Corporatesidebar" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="Corporatesidebar">
                        <span class="menu-icon"><i data-feather="globe"></i></span>
                        <span class="menu-text">Manage Corporates</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="Corporatesidebar">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.corp_admin.index') }}" class="menu-link"><span
                                        class="menu-text">View Corporate List</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.corp_admin.create') }}" class="menu-link"><span
                                        class="menu-text">Add Corporate</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="menu-item">
                    <a class="menu-link" href="{{ route('admin.new_admin.index') }}">
                        <span class="menu-icon"><i data-feather="home"></i></span>
                        <span class="menu-text"> Bank </span>
                    </a>
                </li> --}}


            <li class="menu-item">
                <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}"
                    href="{{ route('admin.home') }}">
                    <span class="menu-icon">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="menu-text">Home</span>
                </a>
            </li>
                <li class="menu-item">
                    <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}" href="{{ route('admin.user.adminhome') }}">
                    <span class="menu-icon">
                        <i class="fa fa-user"></i>
                    </span>
                 <span class="menu-text">Profile</span>
                </a>
            </li>
                {{-- <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon"><i data-feather="calendar"></i></span>
                        <span class="menu-text"> MIS </span>
                    </a>
                </li> --}}
                <!-- <li class="menu-title">Management</li> -->
                <li class="menu-item ">
                    <a class="menu-link textcolor" href="#Banksidebar" data-bs-toggle="collapse">
                        <span class="menu-icon"><i data-feather="globe"></i></span>
                        <span class="menu-text"> Manage Bank </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="Banksidebar">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.new_admin.index') }}" class="menu-link"><span
                                        class="menu-text">View Bank List</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.new_admin.create') }}" class="menu-link"><span
                                        class="menu-text">Add Bank</span></a>
                            </li>

                        </ul>
                    </div>
                </li>

            @elseif (Auth::user()->hasRole('Admin') && Auth::user()->hasRole('SubAdmin'))
                <!-- <li class="menu-title">Reports</li> -->
                <li class="menu-item">
                    <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}"
                        href="{{ route('admin.home') }}">
                        <span class="menu-icon">
                            <i class="fa fa-home"></i>
                        </span>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="menu-item">

                    <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}"
                        href="{{ route('admin.user.adminhome') }}">
                        <span class="menu-icon">
                            <i class="fa fa-user"></i>
                        </span>
                        <span class="menu-text">Profile</span>
                    </a>
                </li>
                <li class="menu-item">

                    <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}" href="{{ route('admin.user.adminhome') }}">
                    <span class="menu-icon">
                        <i class="fa fa-user"></i>
                    </span>
                 <span class="menu-text">Profile</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#sidebarDashboard" data-bs-toggle="collapse">
                    <span class="menu-icon"><i data-feather="users"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    <span class="menu-arrow"></span>
                </a> 
                <div class="collapse" id="sidebarDashboard">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('admin.bank_dash_environment') }}" class="menu-link"><span
                                    class="menu-text">Environment</span></a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.bank_dash_social') }}" class="menu-link"><span
                                    class="menu-text">Social</span></a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.bank_dash_governance') }}" class="menu-link"><span
                                    class="menu-text">Governance</span></a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.bank_dash_scoring') }}" class="menu-link"><span
                                    class="menu-text">ESG Score</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#sidebarClimate" data-bs-toggle="collapse">
                    <span class="menu-icon"><i data-feather="users"></i></span>
                    <span class="menu-text"> Climate Risk </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarClimate">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="#" class="menu-link"><span
                                    class="menu-text">Climate Risk Assement</span></a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link"><span
                                    class="menu-text">Check Climate Risk</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- {{ Request::routeIs('user.rbi_disclosure') ? 'active' : '' }} --}}
            {{-- <li class="menu-item">
                <a href="{{ route('admin.rbi_disclosure') }}" class="menu-link ">
                    <span class="menu-icon"><i data-feather="calendar"></i></span>
                    <span class="menu-text"> RBI Disclosure </span>
                </a>
            </li> --}}
            <li class="menu-item">
                <a href="{{ route('admin.bank_env_mis') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="calendar"></i></span>
                    <span class="menu-text"> MIS </span>
                </a>
            </li>

                {{-- <li class="menu-item">

                    <a href="{{ route('admin.env_mis') }}" class="menu-link">
                        <span class="menu-icon"><i data-feather="calendar"></i></span>
                        <span class="menu-text"> MIS </span>
                    </a>
                </li> --}}
                <li class="menu-item">
                    <a class="menu-link textcolor" href="#sidebarBranch" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarBranch">
                        <span class="menu-icon"><i data-feather="globe"></i></span>
                        <span class="menu-text">Manage Branch</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBranch">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.bank_branch.index') }}" class="menu-link"><span
                                        class="menu-text">View Branch List</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.bank_branch.addbranch') }}" class="menu-link"><span
                                        class="menu-text">Add Branch</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.bank_branch_bulk.create') }}" class="menu-link"><span
                                        class="menu-text">Bulk Upload Branch</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-item ">
                    <a class="menu-link" href="#sidebarExposure" data-bs-toggle="collapse">
                        <span class="menu-icon"><i data-feather="globe"></i></span>
                        <span class="menu-text"> Manage Exposure </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExposure">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.user.index') }}" class="menu-link"><span
                                        class="menu-text">View Exposure List</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.adduser') }}" class="menu-link"><span class="menu-text">Add
                                        Exposure</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.user.bulk.company.create') }}" class="menu-link"><span
                                        class="menu-text">Bulk Upload Exposure</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
            @elseif (Auth::user()->hasRole('SubAdmin'))
                <li class="menu-item">
                    <a class="menu-link" href="#sidebarDashboard" data-bs-toggle="collapse">
                        <span class="menu-icon"><i data-feather="users"></i></span>
                        <span class="menu-text"> Dashboard </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboard">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.dash_environment') }}" class="menu-link"><span
                                        class="menu-text">Environment</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.dash_social') }}" class="menu-link"><span
                                        class="menu-text">Social</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.dash_governance') }}" class="menu-link"><span
                                        class="menu-text">Governance</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.dash_scoring') }}" class="menu-link"><span
                                        class="menu-text">Scoring</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item">
                    <a class="menu-link {{ Request::routeIs('admin.user.adminhome') ? 'active' : '' }}"
                        href="{{ route('admin.user.adminhome') }}">
                        <span class="menu-icon">
                            <i class="fa fa-user"></i>
                        </span>
                        <span class="menu-text">Profile</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.env_mis') }}" class="menu-link">
                        <span class="menu-icon"><i data-feather="calendar"></i></span>
                        <span class="menu-text"> MIS </span>
                    </a>
                </li>
                <li class="menu-item ">
                    <a class="menu-link" href="#sidebarExposure" data-bs-toggle="collapse">
                        <span class="menu-icon"><i data-feather="globe"></i></span>
                        <span class="menu-text"> Manage Exposure </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExposure">
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{ route('admin.user.index') }}" class="menu-link"><span
                                        class="menu-text">View Exposure List</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.adduser') }}" class="menu-link"><span class="menu-text">Add
                                        Exposure</span></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('admin.user.bulk.company.create') }}" class="menu-link"><span
                                        class="menu-text">Bulk Upload Exposure</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
            @elseif (Auth::user()->hasRole('Admin') && Auth::user()->hasRole('SubAdmin') && Auth::user()->hasRole('Corporate'))
                <!-- <li class="menu-title">Reports</li> -->
                <li class="menu-item ">
                    <a href="{{ route('admin.dash') }}" class="menu-link">
                        <span class="menu-icon"><i data-feather="airplay"></i></span>
                        <span class="menu-text"> Dashboard </span>
                    </a>
                </li>
            @endif
        </ul>



        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
