<!-- navbar -->
<nav class="px-3 navbar navbar-expand-lg bg-body-tertiary py-0">
    <div class="container p-0">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img src="{{ asset('endUserAssets/assets/img/logo.png') }}" width="150" alt="">
        </a>
        <div class="dropdown ms-4 category">
            <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-table-cells"></i>
                Categories
            </div>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item active" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item px-4">
                    <a class="nav-link active p-lg-4" aria-current="page" href="#">Courses</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link p-lg-4" href="#">WADI Pro</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link p-lg-4" href="#">WADI Students</a>
                </li>
                <li class="nav-item px-4 position-relative">
                    <div class="dropdown">
                        <a href="" role="button" id="dropdownMenuLink"  data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('endUserAssets/assets/img/Flag-Egypt-circle-png.png') }}" width="35" class="flagLun">
                        </a>
                        <ul class="dropdown-menu language_dropdown_menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <img src="{{ asset('endUserAssets/assets/img/united-kingdom.png') }}"
                                         width="35" class="flagLun" alt="" srcset=""> English</a></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <img src="{{ asset('endUserAssets/assets/img/russian.png') }}"
                                         width="35" class="flagLun" alt="" srcset=""> Russian</a></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <img src="{{ asset('endUserAssets/assets/img/italian.png') }}"
                                         width="35" class="flagLun" alt="" srcset=""> Italy</a></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <img src="{{ asset('endUserAssets/assets/img/german.png') }}"
                                         width="35" class="flagLun" alt="" srcset=""> Germany</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item px-4">
                    <a href="">
                        <!-- <i class="fa-solid fa-user login-icon fs-3"></i> -->
                        <i class="fa-solid fa-circle-user login-icon fs-1"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
