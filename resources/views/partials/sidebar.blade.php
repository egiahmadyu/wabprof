<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/assets/images/logo/wabprof.png" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="/assets/images/logo/wabprof_normal.png" alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a href="/" class="nav-link menu-link {{ Request::segment(1) == '' ? 'active' : '' }}"> <i
                            class="bi bi-speedometer2"></i> <span data-key="t-dashboard">Dashboard</span> </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kasus.index') }}"
                        class="nav-link menu-link {{ Request::segment(1) == 'data-kasus' ? 'active' : '' }}"> <i
                            class="bi bi-card-list"></i> <span data-key="t-dashboard">Data Pelanggar</span> </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kasus.input') }}"
                        class="nav-link menu-link {{ Request::segment(1) == 'input-data-kasus' ? 'active' : '' }}"> <i
                            class="bi bi-clipboard-data"></i> <span data-key="t-dashboard">Input Data Pelanggar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/history-pelanggar"
                        class="nav-link menu-link {{ Request::segment(1) == 'history-pelanggar' ? 'active' : '' }}"> <i
                            class="bi bi-clipboard-data"></i> <span data-key="t-dashboard">TimeLine</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penyidik.index') }}"
                        class="nav-link menu-link {{ Request::segment(1) == 'kelola-penyidik' ? 'active' : '' }}"> <i
                            class="bi bi-card-list"></i> <span data-key="t-dashboard">Kelola Akreditor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pangkat.index') }}"
                        class="nav-link menu-link {{ Request::segment(1) == 'kelola-pangkat' ? 'active' : '' }}"> <i
                            class="bi bi-card-list"></i> <span data-key="t-dashboard">Kelola Pangkat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wujud-perbuatan.index') }}"
                        class="nav-link menu-link {{ Request::segment(1) == 'kelola-wujud-perbuatan' ? 'active' : '' }}">
                        <i class="bi bi-card-list"></i> <span data-key="t-dashboard">Kelola Wujud Perbuatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penyidik.index') }}"
                        class="nav-link menu-link {{ Request::segment(1) == 'kelola-sidang' ? 'active' : '' }}"> <i
                            class="bi bi-card-list"></i> <span data-key="t-dashboard">Kelola Sidang</span>
                    </a>
                </li>
                <li class="menu-title"><span data-key="t-menu">Settings</span></li>
                <li class="nav-item">
                    <a href="/user" class="nav-link menu-link {{ Request::segment(1) == 'user' ? 'active' : '' }}">
                        <i class="fas fa-users"></i> <span data-key="t-dashboard">User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/role" class="nav-link menu-link {{ Request::segment(1) == 'role' ? 'active' : '' }}">
                        <i class="far fa-user-tag"></i> <span data-key="t-dashboard">Role</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link menu-link">
                        <i class="bi bi-box-arrow-right"></i> <span data-key="t-dashboard">Logout</span>
                    </a>
                </li>
                <li class="nav-item">
                    <img src="/maskot-polri.png" alt="" class="img-fluid">
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
