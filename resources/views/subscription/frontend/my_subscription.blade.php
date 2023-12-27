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
                            <h2 class="section__title">@translate(My courses)</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                    <div class="my-courses-tab">
                        <div class="section-tab section-tab-2">
                            <ul class="nav nav-tabs" role="tablist" id="review">
                                <li role="presentation" class="padding-r-3">
                                    <a href="{{route('my.courses')}}">
                                        @translate(All Courses)
                                    </a>
                                </li>

                                <li role="presentation" class="padding-r-3">
                                    <a href="{{route('my.wishlist')}}">
                                        @translate(Wishlist)
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{route('my.subscription')}}" class="active">
                                        @translate(Subscription Courses)
                                    </a>
                                </li>

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
                                <div class="my-course-content-body">
                                    <div class="my-course-container">
                                        <div class="row">
                                            @foreach($subscriptions as $subscription)
                                                <div class="col-lg-4 column-td-half">

                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title"> {{ formatPrice($subscription->subscription_price) }}/{{ $subscription->subscription_package }}</h5>
                                                            <h6 class="card-subtitle mb-2 text-muted">{{ App\Models\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->subscription_package.'%')->count() }} Courses</h6>
                                                                    
                                                            
                                                    @if ($subscription->subscription_package == 'Free')
                                                        <a href="{{ route('my.subscription.package.course', $subscription->subscription_package) }}" class="card-link btn btn-success">View Courses</a>
                                                    @else

                                                    <div class="row">
                                                            <form action="{{ route('subscription.cart') }}" method="get">
                                                        @csrf
                                                        <input type="hidden" value="{{ $subscription->subscription_package }}" name="subscription_package">
                                                        <input type="hidden" value="{{ $subscription->subscription_price }}" name="subscription_price">
                                                        <input type="hidden" value="{{ $subscription->id }}" name="subscription_id">
                                                        @foreach (App\Models\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->duration.'%')->get() as $item)
                                                            <input type="hidden" name="course_id[]" value="{{ $item->course_id }}">
                                                        @endforeach
                                                        <button type="submit" class="btn btn-primary">Renew Subscription</button>
                                                    </form>

                                                    @if (expire($subscription->subscription_package))
                                                        <a href="{{ route('my.subscription.package.course', $subscription->subscription_package) }}" class="card-link btn btn-success ml-3">View Courses</a>
                                                    @endif

                                                        

                                                    </div>

                                                    @endif
                                                                        
                                                                  
                                                              

                                                            

                                                        </div>
                                                    </div>

                                                </div><!-- end col-lg-4 -->
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="page-navigation-wrap mt-4 text-center">
                                        {{ $subscriptions->links('frontend.include.paginate') }}
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
