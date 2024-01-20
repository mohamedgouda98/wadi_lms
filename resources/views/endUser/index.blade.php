@extends('endUser.master')

@section('title', 'Wadi LMS')

@section('content')
    <!-- hero  -->
    <section class="hero pt-3 d-flex flex-column align align-items-center justify-content-between">
        <div class="d-flex flex-column align-items-center justify-content-between gap-5">
            <h1 class="heor__pargraph">
                WORLDWIDE ASSOCIATION OF DIVING INSTRUCTOR
            </h1>
            <div class="hero__btns d-flex align-items-center gap-5">
                <button>Check Courses</button>
                <a href="{{ route('student.register') }}"><button>Be a Student</button></a>
            </div>
        </div>

        <div class="hero__video text-center">
            <video autoplay="true" loop="" playsinline="" class="video w-100">
                <source src="{{ asset('endUserAssets/assets/img/hero_video.webm') }}" type="video/mp4">
            </video>
        </div>
    </section>

    <!-- who we are -->
    <section class="whoWeAre">
        <div class="container px-5 py-5 d-flex align-items-start justify-content-between">
            <div class="whoWeAre__left w-50">
                <div>
                    <h1 class="whoWeAre__header">WHO WE ARE ?
                        <div class="whoWeAre__line"></div>
                    </h1>
                    <p class="whoWeAre__pargraph">
                        <span class="whoWeAre__wadi">WADI </span>is a new dive instructors association. We aim to
                        provide the best environment to dive for divers of any level as well as instructors. We are
                        focused on constantly updating or diving practices, and provide an extensive knowledge of
                        environment preservation. Today's divers and instructors have the responsibility to build
                        together the diving of tomorrow.
                    </p>
                </div>
            </div>
            <div class="whoWeAre__right w-50">
                <img src="{{ asset('endUserAssets/assets/img/whoWeAre.png') }}" class="w-100" alt="">
            </div>
        </div>
    </section>

    <!-- for student -->
    <section class="for__students">
        <div class="container px-5 py-5 d-flex align-items-center justify-content-between">
            <div class="for__students__left w-50">
                <h1 class="for__students__left__word">FOR STUDENTS <br> ABOUT <br>
                    COURSES <br>
                    <i class="fa-solid fa-chalkboard-user"></i>
                </h1>
            </div>
            <div class="for__students__right w-50">
                <p class="for__students__right__words">
                    WADI courses are built to be an easy way to gain knowledge of diving and practice it in safe manners. Choose the course category you like and which level you are allowed to start with, review your course, and go ahead start learn from home until your next vacation comes. Purchasing the course includes theory and the certification issuing fee.
                </p>
            </div>
        </div>
    </section>

    <!-- contact us -->
    <section class="contactUS py-5 my-5">
        <div class="container d-flex flex-column align-items-center justify-content-between gap-3">
            <div class="contactUS__upper">
                <h1 class="contactUS__upper__header text-center">GET IN TOUCH WITH US
                </h1>
                <p class="contactUS__upper__pargraph text-center">GROW WITH US, FUTURE IS OURS
                </p>
            </div>
            <div class="contactUS__down text-center d-flex align-items-center justify-content-center align-self-center">
                <input type="email"  placeholder="Write Your Email Here">
                <button class="subscribe__btn" type="submit">Subscribe</button>
            </div>
        </div>
    </section>
@endsection
