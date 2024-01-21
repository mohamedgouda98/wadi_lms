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
        <div class="container px-5 py-5 position-relative">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="cards-wrapper">
                            <div class="card rounded-4">
                                <img src="https://img.freepik.com/free-vector/online-tutorials-concept_52683-37480.jpg?size=626&ext=jpg&ga=GA1.1.632798143.1705708800&semt=ais" class="card-img-top" alt="image__course">
                                <div class="card-body position-relative">
                                    <i class="fa-regular fa-heart position-absolute fs-3 addToWishlist"></i>
                                    <p class="card-type">Beginner</p>
                                    <h5 class="card-title">The Compete Android Course</h5>
                                    <p class="enrolled__number">Enrolled <span>0</span></p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-play"></i>
                                            <p class="m-0">2 Classes</p>
                                        </div>
                                        <div class="line"></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-regular fa-clock"></i>
                                            <p class="m-0">00:22:00</p>
                                        </div>
                                    </div>
                                    <a href="#" class="btn see-course-details mt-4">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="cards-wrapper">
                            <div class="card rounded-4">
                                <img src="https://img.freepik.com/free-vector/online-tutorials-concept_52683-37480.jpg?size=626&ext=jpg&ga=GA1.1.632798143.1705708800&semt=ais" class="card-img-top" alt="image__course">
                                <div class="card-body position-relative">
                                    <i class="fa-regular fa-heart position-absolute fs-3 addToWishlist"></i>
                                    <p class="card-type">Beginner</p>
                                    <h5 class="card-title">The Compete Android Course</h5>
                                    <p class="enrolled__number">Enrolled <span>0</span></p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-play"></i>
                                            <p class="m-0">2 Classes</p>
                                        </div>
                                        <div class="line"></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-regular fa-clock"></i>
                                            <p class="m-0">00:22:00</p>
                                        </div>
                                    </div>
                                    <a href="#" class="btn see-course-details mt-4">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="cards-wrapper">
                            <div class="card rounded-4">
                                <img src="https://img.freepik.com/free-vector/online-tutorials-concept_52683-37480.jpg?size=626&ext=jpg&ga=GA1.1.632798143.1705708800&semt=ais" class="card-img-top" alt="image__course">
                                <div class="card-body position-relative">
                                    <i class="fa-regular fa-heart position-absolute fs-3 addToWishlist"></i>
                                    <p class="card-type">Beginner</p>
                                    <h5 class="card-title">The Compete Android Course</h5>
                                    <p class="enrolled__number">Enrolled <span>0</span></p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-play"></i>
                                            <p class="m-0">2 Classes</p>
                                        </div>
                                        <div class="line"></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-regular fa-clock"></i>
                                            <p class="m-0">00:22:00</p>
                                        </div>
                                    </div>
                                    <a href="#" class="btn see-course-details mt-4">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="cards-wrapper">
                            <div class="card rounded-4">
                                <img src="https://img.freepik.com/free-vector/online-tutorials-concept_52683-37480.jpg?size=626&ext=jpg&ga=GA1.1.632798143.1705708800&semt=ais" class="card-img-top" alt="image__course">
                                <div class="card-body position-relative">
                                    <i class="fa-regular fa-heart position-absolute fs-3 addToWishlist"></i>
                                    <p class="card-type">Beginner</p>
                                    <h5 class="card-title">The Compete Android Course</h5>
                                    <p class="enrolled__number">Enrolled <span>0</span></p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-play"></i>
                                            <p class="m-0">2 Classes</p>
                                        </div>
                                        <div class="line"></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-regular fa-clock"></i>
                                            <p class="m-0">00:22:00</p>
                                        </div>
                                    </div>
                                    <a href="#" class="btn see-course-details mt-4">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
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
