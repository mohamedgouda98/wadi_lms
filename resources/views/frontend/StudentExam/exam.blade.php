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
                    @if(! is_null($studentExam))
                        <span class="exam__degree">Your Degree Is {{$studentExam->degree}}</span>
                    @else
                        <div class="my-course-content-wrap">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active show" id="#all-course">
                                    <div class="my-course-content-body mt-5 position-relative">
                                        {{--                                    <div class="quiz__timer">--}}
                                        {{--                                        <p class="quiz__timer__number">60</p>--}}
                                        {{--                                    </div>--}}
                                        <form action="{{ route('store-student-answers') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                            <div class="my-course-container d-flex align-items-center justify-content-start flex-wrap" style="gap:12px;">
                                                @foreach($questions as $question)
                                                    <div class="question shadow-lg d-flex flex-column align-items-start" style="gap:10px;">
                                                        <!-- question header -->
                                                        <p class="question__header">{!! $question->question !!}</p>
                                                        <div class="answers px-2 d-flex flex-column align-items-start" style="gap:5px">
                                                            @foreach($question->answers as $answer)
                                                                <!-- Adjust the name attribute to make it unique per question -->
                                                                <div class="answer d-flex align-items-start">
                                                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" id="answer-{{$answer->id}}">
                                                                    <label class="form-check-label" for="answer-{{$answer->id}}">{{ $answer->answer }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="submit" class="submit__exam__btn mt-4">@translate(Submit)</button>
                                        </form>
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
                    @endif

                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end my-courses-area -->
    <!-- ================================
           START MY COURSES
    ================================= -->
@endsection
