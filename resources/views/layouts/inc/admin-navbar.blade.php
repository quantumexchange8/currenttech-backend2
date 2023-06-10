<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <img src="{{ asset('assets/Images/current_tech_logo.png') }}" alt="Logo" width="200" height="66" class="logo">

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    <h3 class="ps-3"> {{ $title }}</h3>

    <!-- Navbar Search-->
<div class="ms-auto">
    <ul class="navbar-nav ms-md-0 me-3 me-lg-4 d-flex align-items-center">
        <li class="languages text-white mr-2" style="font-size: 11px;">
            <div class="align-middle ">
                <a class="text-white" href="{{ url('localization/en') }}">EN</a>
                <a class="text-white">|</a>
                <a class="text-white" href="{{ url('localization/cn') }}">CN</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" id="notificationsDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="text-white fas fa-bell fa-fw"></i> </a>

            <ul class="dropdown-menu dropdown-menu-end custom-dark-purple text-white" aria-labelledby="notificationsDropdown">
                <li><a class="dropdown-item" href="#!">My Profile</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="text-white"></i> <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt=""></a>

            <ul class="dropdown-menu dropdown-menu-end custom-dark-purple text-white" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('employee_detail') }}">My Profile</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
        </li>
        <li class="content">
                <p class="text-white mb-0 pt-3" style="font-size: 11px;"><strong>Jasmine Lee Mei Hwa</strong></p>
                <p class=" text-muted" style="font-size: 10px;">Super Admin</p>
        </li>
    </ul>
</div>
    <!-- Navbar-->

</nav>
