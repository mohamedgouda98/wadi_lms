<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
   @include('endUser.inc.head')
</head>

<body>
@include('endUser.inc.navbar')

@yield('content')

<!-- footer -->
<footer class="mt-5 py-5">
    <div class="footer__logo text-center">
        <img src="{{ asset('endUserAssets/assets/img/logo.png') }}" class="m-auto" alt="">
    </div>
    <div class="container footer__details my-5 d-flex align-items-start justify-content-start gap-5">
        <div class="footer__details__about footer_box">
            <h4 class="footer__header ms-2">About us</h4>
            <p class="footer__pargraph">Worldwide association of diving instructors is the newest association in the diving, experience with a moderated system and a unique way to raise the safety of divers with more enjoyably experiences moving forward to another wave of diving industry from materials and equipment technology and since with the priority of saving and protecting the environment.</p>
        </div>
        <div class="footer__details__contact footer_box">
            <h4 class="footer__header">Contact us</h4>
            <p class="footer__pargraph"><i class="fa-solid fa-location-dot color-green me-2"></i>WADI International Harju county, Tallinn, Kesklinna district, Tartu mnt 67 / 1-13b, 10115 Estonia.</p>
            <p class="footer__pargraph">
                <i class="fa-solid fa-envelope color-green me-2"></i>
                info@divewadi.com
            </p>
        </div>
        <div class="footer_box">
            <h4 class="footer__header">Quick Links
            </h4>
            <ul class="footer__links d-flex flex-column align-items-start gap-1">
                <li><a href="">All Courses</a></li>
                <li><a href="">Summer Sessions</a></li>
                <li><a href="">Professional Courses</a></li>
                <li><a href="">Privacy Policy</a></li>
                <li><a href="">Terms & Conditions</a></li>
            </ul>
        </div>
        <div>
            <h4 class="footer__header ms-3">
                Popular Courses
            </h4>
            <button class="footer__buttons">Discover Diving</button>
            <button class="footer__buttons">Open Water</button>
            <button class="footer__buttons">Advanced Open Water</button>
        </div>
    </div>
</footer>
<div class="footer__down">
    <div class=" container footer__down__container py-4  d-flex justify-content-between align-content-center">
        <div class="d-flex gap-4 align-items-center">
            <i class="fab fa-twitter fs-4"></i>
            <i class="fab fa-facebook-f fs-4"></i>
            <i class="fab fa-instagram fs-4"></i>
            <i class="fab fa-dribbble fa-fw fs-4"></i>
            <i class="fab fa-pinterest fa-fw fs-4"></i>
        </div>
        <div>
            <p class="footer__copy">Copyright &copy; 2024 Unlimited Software</p>
        </div>
    </div>
</div>
@include('endUser.inc.footer')
</body>

</html>
