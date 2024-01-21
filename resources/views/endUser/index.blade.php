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
            <!--======================================
        START LatestCourse AREA
======================================-->
            <section class="course-area padding-top-120px">
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
                                                </div><!-- end card-image -->
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
                                                    </div><!-- end rating-wrap -->
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
                                                    </div><!-- end card-action -->
                                                    <div
                                                        class="card-price-wrap d-flex justify-content-between align-items-center">
                                                        <!--if free-->
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
                                                        <!--there are the login-->
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


                                                    </div><!-- end card-price-wrap -->
                                                </div><!-- end card-content -->
                                            </div>
                                        @endforeach
                                    </div><!-- end course-carousel -->
                                </div><!-- end tab-content -->
                            </div><!-- end col-lg-12 -->
                        </div><!-- end row -->
                    </div><!-- end container -->
                </div><!-- end course-wrapper -->
            </section><!-- end courses-area -->
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
