@extends('frontend.app')
@section('content')

    <!--================================
         START SLIDER AREA
=================================-->
    <section class="slider-area slider-area2">
        <div class="homepage-slide2">
            @foreach($sliders as $item)
                <div class="single-slide-item">
                    <div id="perticles-js-2"></div>
                    <div class="slide-item-table">
                        <div class="slide-item-tablecell">
                            <div class="container">
                                <div class="row">
                                    <!-- <div class="col-lg-8">
                                        <div class="section-heading">
                                            <h2 class="section__title">{{$item->title}}</h2>
                                            <p class="section__desc">
                                                {{$item->sub_title}}
                                            </p>
                                        </div>
                                        <div class="hero-search-form">
                                            <div class="contact-form-action">
                                                <form>
                                                    <div class="input-box">
                                                        <div class="form-group mb-0">

                                                            <input class="form-control" id="slider-search" type="text"
                                                                   name="search"
                                                                   placeholder="@translate(Search for anything)">
                                                            <span class="la la-search search-icon"></span>




                                                            <div class="overflow-hidden search-list w-100">
                                                                <div id="appendSearchCart2"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>


                        </div><!-- slide-item-tablecell -->
                    </div><!-- slide-item-table -->
                </div><!-- end single-slide-item -->
            @endforeach
        </div><!-- end homepage-slides -->
    </section>
    <!--================================
            END SLIDER AREA
    =================================-->


    <!--======================================
           START LatestCourse AREA
   ======================================-->
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


    <div class="section-block"></div>



    <div class="section-block"></div>





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
