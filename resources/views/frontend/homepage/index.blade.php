@extends('frontend.app')
@section('content')

    <!--================================
         START SLIDER AREA
=================================-->

    <!--================================
            END SLIDER AREA
    =================================-->
    <section class="hero pt-3 d-flex flex-column align-items-center justify-content-start">
        <div class="conatainer">
            <p class="hero__pargraph">
                WORLDWIDE ASSOCIATION OF DIVING INSTRUCTORS
            </p>
        </div>
        <div class="hero__video text-center">
            <video autoplay="true" loop="" playsinline="" class="video w-100">
                <source src="{{ asset('endUserAssets/assets/img/hero_video.webm') }}" type="video/mp4">
            </video>
        </div>
    </section>
    <!--======================================

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
        <div class="container px-4 py-5 position-relative">
            <swiper-container slides-per-view="3" speed="500" loop="true" css-mode="true">
                @foreach($latestCourses as $l_course)
                    <swiper-slide>
                        <div class="card rounded-4 position-relative">
                            <a href="" class="text-decoration-none"><img src="{{ filePath($l_course->image) }}" width="354px" height="236px" class="card-img-top" alt="image__course"></a>
                            <div class="card-body d-flex flex-column gap-2 position-relative">
                                @auth()
                                    <a href="#!" class="fs-2" onclick="addToCart({{$l_course->id}},'{{route('add.to.wishlist')}}')"><i class="fa-regular fa-heart position-absolute fs-1 addToWishlist"></i></a>
                                @endauth
                                @guest()
                                        <a href="{{route('login')}}"><i class="fa-regular fa-heart position-absolute fs-3 addToWishlist"></i></a>
                                @endguest
                                <p class="card-type mt-2">{{$l_course->level}}</p>
                                <p class="card-title mt-2"><a href="{{route('single.instructor',$l_course->slug)}}" class="font-bold text-decoration-none">{{\Illuminate\Support\Str::limit($l_course->title,58)}}</a></p>
                                <p class="enrolled__number my-1">@translate(Enrolled) <span>{{\App\Models\Enrollment::where('course_id',$l_course->id)->count()}}</span></p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="courses_videos d-flex align-items-center justify-content-between gap-1" style="width:30%">
                                        <i class="fa-solid fa-play"></i>
                                        <p class="">{{$l_course->classes->count()}} @translate(Classes)</p>
                                    </div>
                                    <div class="line"></div>
                                    <div class="courses_time d-flex align-items-center justify-content-between gap-1" style="width:30%">
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
                                <div class="d-flex align-items-center justify-content-between">
                                    @if($l_course->is_free)
                                    <p class="m-0 card-price">@translate(Free)</p>
                                    @else
                                        @if($l_course->is_discount)
                                            <p class="m-0 card-price">{{formatPrice($l_course->discount_price)}}</p>
                                            <p class="m-0 card-price"><del>{{formatPrice($l_course->price)}}</del></p>
                                        @else
                                            <p class="m-0 card-price">{{formatPrice($l_course->price)}}</p>
                                        @endif
                                    @endif
                                    @auth()
                                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                <a href="#!" class="text-btn my-4 addCart addToCart-{{$l_course->id}}"
                                                    onclick="addToCart({{$l_course->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                        @endif
                                        @else
                                            <a href="{{route('login')}}" class="text-btn my-4 btn addCart">@translate(Add to cart)</a>
                                    @endauth
                                </div>
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
    <section class="contactUS py-5 mt-5">
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
   <!-- <section class=" whoWeAre-area padding-top-60px my-5 px-5 padding-bottom-60px">
    <div class="container row px-5">
        <div class="whoWeAre-area__text col-md-6 d-flex flex-column align-items-start gap-5 justify-content-start">
            <h1 class="font-color">WHO WE ARE ?</h1>
            <div class="line"></div>
            <p class="WhoAreAnswer"><span class="wadiName">WADI</span> is a new dive instructors association. We aim to provide the best environment to dive for divers of any level as well as instructors. We are focused on constantly updating or diving practices, and provide an extensive knowledge of environment preservation. Today's divers and instructors have the responsibility to build together the diving of tomorrow.</p>
        </div>
        <div class="col-md-6 whoWeAre-area__image">
            <img src="https://64bd40bb5ffc102ff96dc740--spiffy-parfait-ec8f02.netlify.app/static/media/vecteezy_scuba-diver-cartoon-sticker_.8cd5e1289c1bc9895d0a.png" alt="" class="w-100">
        </div>
    </div>
   </section> -->
    <!--======================================
           END LatestCourse AREA
   ======================================-->

    <!--======================================
           START LatestCourse AREA
   ======================================-->
    <!-- <section class="course-area padding-top-120px">
        <div class="course-wrapper">
            <div class="course-area__hero" >
                <div class="row margin-top-28px">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div class="course-carousel">
                                @foreach($latestCourses as $l_course)
                                    <div class="card-item card-preview"
                                         data-tooltip-content="#tooltip_content_{{$l_course->id}}">
                                        <div class="card-image">
                                            <a href="{{route('course.single',$l_course->slug)}}"
                                               class="card__img"><img
                                                    src="{{ filePath($l_course->image) }}"
                                                    alt="{{$l_course->title}}"></a>
                                            @if(bestSellingTags($l_course->id))
                                                <div class="card-badge">
                                                    <span
                                                        class="badge-label">@translate(bestseller)</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-content">
                                            <p class="card__label">
                                                <span class="card__label-text">{{$l_course->level}}</span>
                                                @auth()
                                                    <a href="#!"
                                                       onclick="addToCart({{$l_course->id}},'{{route('add.to.wishlist')}}')"
                                                       class="card__collection-icon love-{{$l_course->id}}"><span
                                                            class="la la-heart-o love-span-{{$l_course->id}}"></span></a>
                                                @endauth

                                                @guest()
                                                    <a href="{{route('login')}}"
                                                       class="card__collection-icon"
                                                       data-toggle="tooltip" data-placement="top"
                                                       title="Add to Wishlist"><span
                                                            class="la la-heart-o"></span></a>
                                                @endguest
                                            </p>
                                            <h3 class="card__title">
                                                <a href="{{route('course.single',$l_course->slug)}}" style="color:#8BCD50 !important">{{\Illuminate\Support\Str::limit($l_course->title,58)}}</a>
                                            </h3>
                                            <p class="card__author">
                                                @if ($l_course->relation_between_instructor_user != null)
                                                <a href="{{route('single.instructor',$l_course->slug)}}">
                                                        {{$l_course->name}}</a>
                                                @endif
                                            </p>
                                            <div class="rating-wrap d-flex mt-2 mb-3">
                                                    <span class="star-rating-wrap">
                                                     @translate(Enrolled) <span
                                                            class="star__count">{{\App\Models\Enrollment::where('course_id',$l_course->id)->count()}}</span>
                                                  </span>
                                            </div>
                                            <div class="card-action">
                                                <ul class="card-duration d-flex justify-content-between align-items-center">
                                                    <li>
                                                          <span class="meta__date">
                                                              <i class="la la-play-circle"></i> {{$l_course->classes->count()}} @translate(Classes)
                                                          </span>
                                                    </li>
                                                    <li>
                                                          <span class="meta__date">
                                                              @php
                                                                  $total_duration = 0;
                                                                  foreach ($l_course->classes as $item){
                                                                      $total_duration +=$item->contents->sum('duration');
                                                                  }
                                                              @endphp
                                                              <i class="la la-clock-o"></i>{{duration($total_duration)}}

                                                          </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div
                                                class="card-price-wrap d-flex justify-content-between align-items-center">

                                                @if($l_course->is_free)
                                                    <span class="card__price">@translate(Free)</span>
                                                @else
                                                    @if($l_course->is_discount)
                                                        <span class="card__price">{{formatPrice($l_course->discount_price)}}</span>
                                                        <span class="card__price"><del>{{formatPrice($l_course->price)}}</del></span>
                                                    @else
                                                        <span
                                                            class="card__price">{{formatPrice($l_course->price)}}</span>
                                                    @endif
                                                @endif

                                                @auth()
                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                        <a href="#!" class="text-btn addToCart-{{$l_course->id}}"
                                                           onclick="addToCart({{$l_course->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                                    @else
                                                        <a href="{{route('login')}}" class="text-btn">@translate(Add to cart)</a>
                                                    @endif
                                                @endauth

                                                @guest()
                                                    <a href="{{route('login')}}" class="text-btn">@translate(Add to cart)</a>
                                                @endguest


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    @foreach($latestCourses as $l_c_tooltip)
        <div class="tooltip_templates">
            <div id="tooltip_content_{{$l_c_tooltip->id}}">
                <div class="card-item">
                    <div class="card-content">
                        <p class="card__author">
                            @translate(By) <a
                                href="{{route('single.instructor',$l_c_tooltip->slug)}}">{{$l_c_tooltip->name}}</a>
                        </p>
                        <h3 class="card__title">
                            <a href="{{route('course.single',$l_c_tooltip->slug)}}">{{\Illuminate\Support\Str::limit($l_c_tooltip->title,58)}}</a>
                        </h3>
                        <p class="card__label">
                            <span class="mr-1">@translate(in)</span><a
                                href="{{route('course.category',$l_c_tooltip->category->slug)}}"
                                class="mr-1">{{$l_c_tooltip->category->name}}</a>
                        </p>
                        <div class="rating-wrap d-flex mt-2 mb-3">

                                                                    <span class="star-rating-wrap">
                                                             @translate(Enrolled) <span
                                                                            class="star__count">{{\App\Models\Enrollment::where('course_id',$l_c_tooltip->id)->count()}}</span>
                                                        </span>
                        </div><!-- end rating-wrap -->
                        <ul class="list-items mb-3 font-size-14">
                            @foreach(json_decode($l_c_tooltip->requirement) as $requirement)
                                <li>{{$requirement}}</li>
                            @endforeach

                        </ul>
                        <div class="card-action">
                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                <li><span class="meta__date"><i
                                            class="la la-play-circle"></i> {{$l_c_tooltip->classes->count()}} @translate(Classes)</span>
                                </li>
                                <li><span class="meta__date">
                                                                    @php
                                                                        $total_duration = 0;
                                                                        foreach ($l_c_tooltip->classes as $item){
                                                                            $total_duration +=$item->contents->sum('duration');
                                                                        }
                                                                    @endphp
                                                                    <i class="la la-clock-o"></i>{{duration($total_duration)}}
                                          </span>
                                </li>
                            </ul>
                        </div><!-- end card-action -->
                        <div class="btn-box w-100 text-center mb-3">
                            <a href="{{route('course.single',$l_c_tooltip->slug)}}"
                               class="theme-btn d-block">
                                @translate(Preview this course)</a>
                        </div>
                    </div><!-- end card-content -->
                </div><!-- end card-item -->
            </div>
        </div>
    @endforeach
    <!--======================================
            END LatestCourse AREA
    ======================================-->

    <!--======================================
            END CATEGORY AREA
    ======================================-->

    <!--======================================
            START COURSE AREA
    ======================================-->
    @foreach($trading_courses as $t_tooltip)
        <div class="tooltip_templates">
            <div id="tooltip_content_{{$t_tooltip->id}}">
                <div class="card-item">
                    <div class="card-content">
                        <p class="card__author">
                            @translate(By) <a
                                href="{{route('single.instructor',$t_tooltip->slug)}}">{{$t_tooltip->name}}</a>
                        </p>
                        <h3 class="card__title">
                            <a href="{{route('course.single',$t_tooltip->slug)}}">{{\Illuminate\Support\Str::limit($t_tooltip->title,58)}}</a>
                        </h3>
                        <p class="card__label">
                            <span class="mr-1">@translate(in)</span><a
                                href="{{route('course.category',$t_tooltip->category->slug)}}"
                                class="mr-1">{{$t_tooltip->category->name}}</a>
                        </p>
                        <div class="rating-wrap d-flex mt-2 mb-3">

                                                                    <span class="star-rating-wrap">
                                                             @translate(Enrolled) <span
                                                                            class="star__count">{{\App\Models\Enrollment::where('course_id',$t_tooltip->id)->count()}}</span>
                                                        </span>
                        </div><!-- end rating-wrap -->
                        <ul class="list-items mb-3 font-size-14">
                            <!--todo::need to change-->
                            {!! $t_tooltip->short_discription !!}

                        </ul>
                        <div class="card-action">
                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                <li><span class="meta__date"><i
                                            class="la la-play-circle"></i> {{$t_tooltip->classes->count()}} @translate(Classes)</span>
                                </li>
                                <li><span class="meta__date">
                                                                    @php
                                                                        $total_duration = 0;
                                                                        foreach ($t_tooltip->classes as $item){
                                                                            $total_duration +=$item->contents->sum('duration');
                                                                        }
                                                                    @endphp
                                                                    <i class="la la-clock-o"></i>{{duration($total_duration)}}
                                          </span>
                                </li>
                            </ul>
                        </div><!-- end card-action -->
                        <div class="btn-box w-100 text-center mb-3">
                            <a href="{{route('course.single',$t_tooltip->slug)}}"
                               class="theme-btn d-block">
                                @translate(Preview this course)</a>
                        </div>
                    </div><!-- end card-content -->
                </div><!-- end card-item -->
            </div>
        </div>
    @endforeach
    <!--======================================
                END COURSE AREA
        ======================================-->

    <!--======================================
            START SUBSCRIPTION AREA
    ======================================-->
@if (subscriptionActive())

  <section class="package-area section--padding">
    <div class="container">
        <div class="row">

        @foreach ($subscriptions as $subscription)
            <div class="col-lg-4 column-td-half">
                <div class="package-item package-item-active">

                @if ($subscription->popular == true)
                     <div class="package-tooltip">
                        <span class="package__tooltip">Recommended</span>
                    </div><!-- end package-tooltip -->
                @endif

                    <div class="package-title text-center">
                        <h3 class="package__price"><span>{{ formatPrice($subscription->price) }}</span></h3>
                        <h3 class="package__title">{{ $subscription->name }}</h3>
                    </div><!-- end package-title -->

                    <ul class="list-items margin-bottom-35px">
                        @foreach (json_decode($subscription->description) as $item)
                            <li><i class="la la-check"></i> {{ $item }}</li>
                        @endforeach
                    </ul>

                    <div class="btn-box">
                        <a href="{{ route('subscription.frontend', $subscription->duration) }}" class="theme-btn">{{ App\Models\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->duration.'%')->count() }} Courses</a>
                        <form action="{{ route('subscription.cart') }}" method="get">
                            @csrf

                            <input type="hidden" value="{{ $subscription->duration }}" name="subscription_package">
                            <input type="hidden" value="{{ $subscription->price }}" name="subscription_price">
                            <input type="hidden" value="{{ $subscription->id }}" name="subscription_id">
                            @foreach (App\Models\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->duration.'%')->get() as $item)
                                <input type="hidden" name="course_id[]" value="{{ $item->course_id }}">
                            @endforeach

                            @auth
                                @if (!App\Models\SubscriptionEnrollment::where('user_id', Auth::user()->id)->where('subscription_package', $subscription->duration)->exists())
                                <button type="submit" class="theme-btn mt-3">choose plan</button>
                                @else
                                <button type="button" disabled class="theme-btn mt-3">Purchased</button>
                                @endif
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="theme-btn mt-3">choose plan</a>
                            @endguest




                        </form>
                        <p class="package__meta">no hidden charges!</p>
                    </div>

                </div><!-- end package-item -->
            </div><!-- end col-lg-4 -->
        @endforeach

        </div><!-- end row -->
    </div><!-- end container -->
    </section>

 @endif
    <!--======================================
            END SUBSCRIPTION AREA
    ======================================-->
@endsection

