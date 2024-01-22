@extends('endUser.master')

@section('title', 'Wadi LMS')

@section('content')
    <!-- hero  -->
    <section class="hero pt-3 d-flex flex-column align-items-center justify-content-start">
        <div class="">
            <h1 class="heor__pargraph">
                WORLDWIDE ASSOCIATION OF DIVING INSTRUCTOR
            </h1>
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
            <swiper-container slides-per-view="3" speed="500" loop="true" css-mode="true">
                @foreach($latestCourses as $l_course)
                    <swiper-slide>
                        <div class="card rounded-4">
                            <img src="{{ filePath($l_course->image) }}" width="354px" height="236px" class="card-img-top" alt="image__course">
                            <div class="card-body position-relative">
                                @auth()
                                    <a href="#!" onclick="addToCart({{$l_course->id}},'{{route('add.to.wishlist')}}')"><i class="fa-regular fa-heart position-absolute fs-3 addToWishlist"></i></a>
                                @endauth
                                @guest()
                                        <a href="{{route('login')}}"><i class="fa-regular fa-heart position-absolute fs-3 addToWishlist"></i></a>
                                @endguest
                                <p class="card-type">{{$l_course->level}}</p>
                                <h5 class="card-title"><a href="{{route('single.instructor',$l_course->slug)}}" class="font-bold">{{\Illuminate\Support\Str::limit($l_course->title,58)}}</a></h5>
                                <p class="enrolled__number">@translate(Enrolled) <span>{{\App\Models\Enrollment::where('course_id',$l_course->id)->count()}}</span></p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-play"></i>
                                        <p class="m-0">{{$l_course->classes->count()}} @translate(Classes)</p>
                                    </div>
                                    <div class="line"></div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa-regular fa-clock"></i>
                                        @php
                                            $total_duration = 0;
                                            foreach ($l_course->classes as $item){
                                                $total_duration +=$item->contents->sum('duration');
                                            }
                                        @endphp
                                        <p class="m-0">{{duration($total_duration)}}</p>
                                    </div>
                                </div>
                                <a href="{{route('course.single',$l_course->slug)}}" class="btn see-course-details mt-4">View more</a>
                            </div>
                        </div>
                    </swiper-slide>
                @endforeach
            </swiper-container>
            <button class="position-absolute carousel-control-next "><i class="fa-solid fa-chevron-right"></i></button>
            <button class="position-absolute carousel-control-prev swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></button>
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
