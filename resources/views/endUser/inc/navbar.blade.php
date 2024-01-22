<!-- navbar -->
<nav class="px-3 navbar navbar-expand-lg bg-body-tertiary py-0">
    <div class="container p-0 align-items-center">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img src="{{ asset('endUserAssets/assets/img/logo.png') }}" width="150" alt="">
        </a>
        <!-- start categories section -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-0 mb-2 mb-lg-0 align-items-center w-100 d-flex justify-content-between">
{{--                <li class="nav-item px-4">--}}
{{--                    <a class="nav-link active p-lg-4" aria-current="page" href="#">Courses</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item px-4">--}}
{{--                    <a class="nav-link p-lg-4" href="#">WADI Pro</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item px-4">--}}
{{--                    <a class="nav-link p-lg-4" href="#">WADI Students</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <div class="header-category">
                        <ul>
                            <li>
                                <a href="http://127.0.0.1:8000/courses"><i class="fa fa-th p-2 fs-4"></i>Categories</a>
                                <ul class="dropdown-menu-item">
                                    <li>
                                        <a href="http://127.0.0.1:8000/courses/web-development1">Web Development</a>
                                    </li>
                                    <li>
                                        <a href="http://127.0.0.1:8000/courses/education2">Education</a>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <a href="http://127.0.0.1:8000/courses/business3">Business</a>
                                        <i class="fa-solid fa-angle-right pe-1"></i>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="http://127.0.0.1:8000/courses/finance-and-banking4">Finance and Banking</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="http://127.0.0.1:8000/courses/marketing5">Marketing</a>
                                    </li>
                                    <li>
                                        <a href="http://127.0.0.1:8000/courses/photography6">Photography</a>
                                    </li>
                                    <li>
                                        <a href="http://127.0.0.1:8000/courses/music7">Music</a>
                                    </li>
                                    <li>
                                        <a href="http://127.0.0.1:8000/courses/mobile-apps-development">Mobile Apps Development</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
                <div class="nav-item userAndLang d-flex align-items-center justify-content-between gap-4">
                    <li class="nav-item px-4 position-relative">
                        <div class="dropdown">
                            <a href="" role="button" id="dropdownMenuLink"  data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('endUserAssets/assets/img/Flag-Egypt-circle-png.png') }}" width="45" class="flagLun" alt="wadi Lms">
                            </a>
                            <ul class="dropdown-menu language_dropdown_menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <img src="{{ asset('endUserAssets/assets/img/united-kingdom.png') }}"
                                            width="45" class="flagLun" alt="" srcset=""> English</a></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <img src="{{ asset('endUserAssets/assets/img/russian.png') }}"
                                            width="45" class="flagLun" alt="" srcset=""> Russian</a></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <img src="{{ asset('endUserAssets/assets/img/italian.png') }}"
                                            width="45" class="flagLun" alt="" srcset=""> Italy</a></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <img src="{{ asset('endUserAssets/assets/img/german.png') }}"
                                            width="45" class="flagLun" alt="" srcset=""> Germany</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item px-4">
                        <a href="{{ route('login') }}">
                            <!-- <i class="fa-solid fa-user login-icon fs-3"></i> -->
                            <i class="fa-solid fa-circle-user login-icon fs-1"></i>
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>

<!-- mobile navabar -->
<div class="navBar__mobile__menu">
    <i class="close_mobile_nav fa-solid fa-circle-xmark fs-3 position-absolute end-0 top-0 m-3"></i>
    <div class="navBar__mobile__menu__home">
        <a href="">Home</a>
    </div>
    <hr>
    <div class="navBar__mobile__menu__category">
        <div class="d-flex align-items-center justify-content-between">
            <a href="">Categories</a>
            <button class="show_category">+</button>
        </div>
        <ul class="mobile_dropdown-menu-item" id="category_mobile">
            <li>
                <a href="http://127.0.0.1:8000/courses/web-development1">Web Development</a>
            </li>
            <li>
                <a href="http://127.0.0.1:8000/courses/education2">Education</a>
            </li>
            <li class="">
                <a href="http://127.0.0.1:8000/courses/business3">Business</a>
                <ul >
                    <li>
                        <a href="http://127.0.0.1:8000/courses/finance-and-banking4">Finance and Banking</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="http://127.0.0.1:8000/courses/marketing5">Marketing</a>
            </li>
            <li>
                <a href="http://127.0.0.1:8000/courses/photography6">Photography</a>
            </li>
            <li>
                <a href="http://127.0.0.1:8000/courses/music7">Music</a>
            </li>
            <li>
                <a href="http://127.0.0.1:8000/courses/mobile-apps-development">Mobile Apps Development</a>
            </li>
        </ul>
    </div>
    <hr>
    <div class="navBar__mobile__menu__login d-flex justify-content-between align-items-center">
        <button><a href="">LOGIN</a></button>
        <li class="nav-item px-4 position-relative">
            <div class="dropdown">
                <a href="" role="button" id="dropdownMenuLink"  data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('endUserAssets/assets/img/Flag-Egypt-circle-png.png') }}" width="35" class="flagLun" alt="wadi Lms">
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
    </div>
</div>
