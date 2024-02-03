@extends('frontend.app')
@section('content')
    <!-- ================================
      START BREADCRUMB AREA
  ================================= -->
    <section class="breadcrumb-area my-courses-bread">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content my-courses-bread-content">
                        <div class="section-heading">
                            <h2 class="section__title">@translate(My Questions)</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                    <div class="my-courses-tab">
                        <div class="section-tab section-tab-2">
                            <ul class="nav nav-tabs" role="tablist" id="review">
                                <li role="presentation" class="padding-r-3">
                                    <a href="{{route('my.courses')}}" class="active">
                                        @translate(All Courses)
                                    </a>
                                </li>
                                <li role="presentation" class="padding-r-3">
                                    <a href="{{route('my.wishlist')}}">
                                        @translate(Wishlist)
                                    </a>
                                </li>
                                @if(env('SUBSCRIPTION_ACTIVE') == "YES")
                                    <li role="presentation">
                                        <a href="{{route('my.subscription')}}">
                                            @translate(Subscription Courses)
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
        START FLASH MESSAGE
    ================================= -->

    @if (Session::has('message'))
        <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
    @endif

    <!-- ================================
      END FLASH MESSAGE
  ================================= -->

    <!-- ================================
           START MY COURSES
    ================================= -->
    <section class="my-courses-area padding-top-30px padding-bottom-90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="my-course-content-wrap">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="#all-course">
                                <div class="my-course-content-body mt-5 position-relative">
                                    <div class="quiz__timer">
                                        <p class="quiz__timer__number">60</p>
                                    </div>
                                    <div class="my-course-container d-flex flex-column align-items-start" style="gap:25px;">
                                        <div class="question d-flex flex-column align-items-start" style="gap:20px;">
                                            <!-- question header -->
                                            <p class="question__header">Q1 : How Are You ?</p>
                                            <div class="answers px-5">
                                                <input type="radio" class="" name="qustion1" value="a" id="radio1" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi soluta porro tenetur modi consequuntur ut? <br>
                                                <input type="radio" name="qustion1" value="b" id="radio2"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorum, unde quos id corrupti facilis quasi? <br>
                                                <input type="radio" name="qustion1" value="c" id="radio3"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minus eligendi, amet dicta non omnis!<br>
                                                <input type="radio" name="qustion1" value="d" id="radio4"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum, vero quisquam? Repellat voluptas fugit pariatur.<br>
                                            </div>
                                        </div>
                                        <div class="question d-flex flex-column align-items-start" style="gap:20px;">
                                            <!-- question header -->
                                            <p class="question__header">Q2 : what is your country ?</p>
                                            <div class="answers px-5">
                                                <input type="radio" name="qustion2" value="a" id="radio1" > Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum nostrum voluptatibus fugit. <br>
                                                <input type="radio" name="qustion2" value="b" id="radio2"> Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
                                                <input type="radio" name="qustion2" value="c" id="radio3"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga rem neque ratione obcaecati.<br>
                                                <input type="radio" name="qustion2" value="d" id="radio4"> Lorem ipsum dolor sit amet consectetur adipisicing.<br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-navigation-wrap mt-4 text-center">
                                        {{--                                        {{ $exams->links('frontend.include.paginate') }}--}}
                                    </div><!-- end page-navigation-wrap -->
                                </div>
                            </div><!-- end tab-pane -->

                            <div role="tabpanel" class="tab-pane fade" id="#wishlist">
                                <div class="my-wishlist-wrap">
                                    <div class="my-wishlist-card-body padding-top-35px">
                                        <div class="row">

                                        </div><!-- end row -->
                                    </div>

                                </div><!-- end my-wishlist-wrap -->
                            </div><!-- end tab-pane -->

                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end my-courses-area -->
    <!-- ================================
           START MY COURSES
    ================================= -->
@endsection
