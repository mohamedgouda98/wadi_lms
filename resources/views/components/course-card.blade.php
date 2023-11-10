<div>
    
        {{-- <div class="single-course"> --}}
            <!-- top -->
            {{-- <span class="tag text-red bg-lite-red">{{ $level }}</span> --}}

            {{-- @auth
                <a href="javascript:;" 
                tabindex="0"
                onclick="addToCart({{ $addToWishList }})" class="love-{{$courseID}}">
                    <span class="heart text-green bg-lite-green love-span-{{$courseID}}">
                        <i class="love-icon-{{$courseID}} far fa-heart"></i>
                    </span>
                </a>
            @endauth

            @guest
                <a href="{{route('login')}}" 
                tabindex="0">
                    <span class="heart text-green bg-lite-green love-span-{{$courseID}}">
                        <i class="love-icon-{{$courseID}} far fa-heart"></i>
                    </span>
                </a>
            @endguest
            

            <img src="{{ $thumb }}" alt="img" class="img-item mb-40"> --}}
            <!-- progress bar -->
            {{-- @isset ($progress)
            <div class="d-flex justify-content-between mb-10 align-items-center">
                <div class="progress w-100 bg-lite-red">
                    <div class="progress-bar bg-red w-75" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                        <span class="percentage bg-red text-white">{{ $progress }}%</span>
                    </div>
                </div>
            </div>
            @endisset --}}

            <!-- bottom -->
            {{-- <a href="{{ $courseUrl }}" class="d-block"> --}}
                {{-- <h5>{{ $title }}</h5> --}}
                {{-- <h5>hello world title</h5> --}}
            {{-- </a>

             <div class="course-info-box-3 justify-content-between mb-10 align-items-center">
                <a href="{{ $instructorUrl }}" class="d-flex">
                    <small  class="text-red">{{ $instructor }}</small >
                </a>
            </div>

            <div class="course-info-box d-flex justify-content-between mb-20 align-items-center">
                <h6><span class="text-red">{{ $category }}</span></h6>
                <h6><span class="text-red"> {{ $enrolledCount }}</span> students</h6>
            </div>

            <div class="course-info-box-2 d-flex justify-content-between align-items-center mb-20">
                <h6><i class="fas fa-book-open"></i> {{ $classesCount }} Classes</h6>
                <h6><i class="far fa-calendar"></i> {{ $createdAt }}</h6>
                <h6><i class="far fa-clock"></i> {{ $courselength }}</h6>
            </div>


            <div class="course-info-box-2 d-flex mb-20">
                {{ $price }}
            </div> --}}



            {{-- <div class="course-info-box-3-3 d-flex justify-content-between align-items-center mb-20">
                <a href="{{ $courseUrl }}" class="rounded px-3 py-2 text-red bg-lite-tomatto text-capitalize">@translate(course details)</a> --}}
                {{-- {{ $addToCart }} --}}

                {{-- @auth()
                    @if(Auth::user()->user_type == 'Student')
                        <a href="javascript:;"
                            class="rounded px-3 py-2 text-red bg-lite-tomatto text-capitalize addToCart-{{$addToCart}} cartbtn"
                            onclick="addToCart({{$addToCart}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                    @else
                        <a href="{{route('login')}}" class="rounded px-3 py-2 text-red bg-lite-tomatto text-capitalize">@translate(Add to cart)</a>
                    @endif
                @endauth

                @guest()
                    <a href="{{route('login')}}" class="rounded px-3 py-2 text-red bg-lite-tomatto text-capitalize">@translate(Add to cart)</a>
                @endguest

            </div>
        </div> --}}

        {{-- working on --}}
        <div class="single-course position-relative">
            <!-- top -->
            <a href="#" tabindex="0" class="heart text-red bg-lite-red">
                <i class="far fa-heart"></i>
            </a>
            <a href="#" tabindex="0">
                <span class="tag text-red bg-lite-red">beginner</span>
            </a>
            <img src="https://images.pexels.com/photos/1094072/pexels-photo-1094072.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="img" class="img-item mb-40">
           <div class="px-4 pb-20">
            <!-- progress bar -->
            <div class="d-flex justify-content-between mt-20 mb-30 align-items-center">
                <div class="progress w-100 bg-lite-red">
                    <div class="progress-bar bg-red w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        <span class="percentage bg-red text-white">75%</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <span class="rating bg-lite-red text-red px-3 font-bold mb-20 d-inline-block d-flex justify-content-between">
                <span>
                    <i class="far fa-star"></i>
                </span>4.5
                </span>
                <a href="#" tabindex="0">
                    <span class="price-tag text-red bg-lite-red"><b>Price</b> : $45 <del>$30</del></span>
                </a>
            </div>
            <a href="#" class="d-block mb-20" tabindex="0">
                <h5 class="font-weight-bold">User Experience Design - Adobe XD UI UX Design</h5>
            </a>
            <!-- bottom -->
            <div class="course-info-box d-flex mb-20 align-items-center">
                <h6 class="font-weight-light mr-4">Adam Chris</h6>
                <h6 class="font-weight-light">enrolled :<span class="text-red"> 20</span></h6>
            </div>
            <div class="course-info-box d-flex mb-20  font-weight-light align-items-center">
                <h6 class="font-weight-light">in <span class="text-red">web design</span></h6>
            </div>
            <div class="course-info-box-2 d-flex font-weight-light  align-items-center mb-20">
                <h6 class="font-weight-light"><i class="fas fa-book-open"></i> 25 Classes</h6>
                <h6 class="ml-4 font-weight-light"><i class="far fa-calendar"></i> 24 aug 2021</h6>
            </div>
            <div class="course-info-box-2 d-flex justify-content-between align-items-center">
               <a class="rating bg-lite-red text-red px-3 font-bold text-capitalize" href="">enroll now</a>
               <a class="rating bg-lite-red text-red px-3 font-bold text-capitalize" href="">add to cart</a>
            </div>
           </div>
        </div>
    
</div>