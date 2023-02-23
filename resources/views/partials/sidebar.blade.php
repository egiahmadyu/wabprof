<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/assets/images/logo/paminal.png" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="/assets/images/logo/Paminal_v7.png" alt="" height="60">
            </span>
        </a>
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="/assets/images/logo/paminal.png" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="/assets/images/logo/Paminal_v5.png" alt="" height="60">
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
                    <a href="{{ route('logout') }}" class="nav-link menu-link"> 
                        <i class="bi bi-box-arrow-right"></i> <span data-key="t-dashboard">Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
