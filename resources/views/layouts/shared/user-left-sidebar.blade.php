<!-- ========== Left Sidebar Start ========== -->
<div class="app-menu">

    <div class="logo-box">
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
        <div class="user-box text-center border-bottom border-top p-2">
            <img src="/images/user-profile.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-lg">
            <div class="dropdown">
                <a href="javascript: void(0);" class=" h5 mb-1 d-block"
                    data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a> --}}

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a> --}}

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a> --}}

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted mb-0">Admin Head</p>
        </div>

        <!--- Sidemenu -->

        <ul id="side-menu" class="menu">
            <li class="menu-title">Navigation</li>

            <li class="menu-item">
              <a class="menu-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <span class="menu-icon">
                    <i class="fa fa-user"></i>
                </span>
                <span class="menu-text">Profile</span>
              </a>
            </li>
            

            <li class="menu-item ">
                <a class="menu-link" href="#sidebarExposure" data-bs-toggle="collapse">
                    <span class="menu-icon"><i data-feather="globe"></i></span>
                    <span class="menu-text"> Environment </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExposure">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('user.bank') }}" class="menu-link"><span class="menu-text">Carbon Footprint</span></a>
                        </li>

                    <li class="menu-item">
                    @if (Auth::user()->plant_flag == 'Y')
                        <a href="{{ route('user.plant.edit', Auth::user()->id) }}"
                            class="menu-link {{ Request::routeIs('user.plant.edit') ? 'active' : '' }}">        <span class="menu-text"> Plant Locations </span>

                        </a>
                    @else
                        <a href="{{ route('user.plant.index') }}"
                            class="menu-link {{ Request::routeIs('user.plant.index') ? 'active' : '' }}">
                            <span class="menu-text"> Plant Locations </span>
                        </a>
                    @endif
                   </li>

              <!--       <li class="menu-item ">
                        <a class="menu-link" href="#climate_risk" data-bs-toggle="collapse">
                            <span class="menu-text">Climate Risk</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="climate_risk">
                            <ul class="sub-menu">
                                <li class="menu-item">
                                    <a href="{{ route('user.thematic') }}" class="menu-link"><span class="menu-text">Thematic</span></a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('user.risk') }}" class="menu-link"><span class="menu-text">Risk</span></a>
                                </li>
                                <li class="menu-item ">
                                    <a href="#" class="menu-link"><span class="menu-text">Opportunity</span></a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
                    </ul>
                </div>
            </li>



            <li class="menu-item">
                <a class="menu-link {{ Request::routeIs('user.social.index') ? 'active' : '' }}"
                    href="{{ route('user.social.index') }}">
                    <span class="menu-icon"><i data-feather="rss"></i></span>
                    <span class="menu-text"> Social </span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ Request::routeIs('user.governance.index') ? 'active' : '' }}"
                    href="{{ route('user.governance.index') }}">
                    <span class="menu-icon"><i data-feather="droplet"></i></span>
                    <span class="menu-text"> Governance </span></a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ Request::routeIs('user.scoring.index') ? 'active' : '' }}"
                    href="{{ route('user.scoring.index') }}">
                    <span class="menu-icon"><i data-feather="layout"></i></span>
                    <span class="menu-text"> Scoring </span></a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ Request::routeIs('user.seq.index') ? 'active' : '' }}"
                    href="{{ route('user.seq.index') }}">
                    <span class="menu-icon"><i data-feather="cloud-lightning"></i></span>
                    <span class="menu-text"> Carbon SEQ </span></a>
            </li>

            <li class="menu-item">
                <a class="menu-link {{ Request::routeIs('user.brsr.index') ? 'active' : '' }}"
                    href="{{ route('user.brsr.index') }}">
                    <span class="menu-icon"><i data-feather="layers"></i></span>
                    <span class="menu-text"> BRSR </span></a>
            </li>
        </ul>

        {{-- </div> --}}
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
