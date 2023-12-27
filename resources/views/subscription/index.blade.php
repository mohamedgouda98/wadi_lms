@extends('layouts.master')
@section('title','Course Index')
@section('parentPageTitle', 'All Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30 shadow">
        <div class="row px-3 pt-3">
            <h3 class="col-md-6">
                @translate(Subscription Manager)
            </h3>
        </div>


        <div class="card-body">


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('subscription.create') }}" method="post">
                @csrf

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-name">
                        @translate(Package Name) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" required
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            id="val-name" name="name" placeholder="@translate(Enter Subscription Package Name)" aria-required="true" autofocus>
                        @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-description">
                        @translate(Package Description) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        
                        <div class="wrapper">
                            <div><input type="text" required class="form-control" id="val-description" name="description[]" placeholder="@translate(Enter Package Description)" aria-required="true" autofocus></div>
                        </div>
                        <button id="Array_name" class="add_fields btn btn-primary mt-2"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Add More Description</button>

                    </div>
                </div>


                {{-- Provider --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-duration">
                    @translate(Subscription Duration) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select  class="form-control lang @error('duration') is-invalid @enderror" id="val-duration" name="duration" required>
                        <option value="">
                            @translate(Select Duration)</option>
                            @if (enableFreeTrial())
                                <option value="Free">
                            @translate(Free)</option>
                            @endif
                        
                        <option value="Daily">
                            @translate(Daily)</option>
                        <option value="Weekly">
                            @translate(Weekly)</option>
                        <option value="Monthly">
                            @translate(Monthly)</option>
                        <option value="Yearly">
                            @translate(Yearly)</option>
                    </select>
                </div>
                @error('duration') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>


                <div class="form-group row price">
                    <label class="col-lg-3 col-form-label" for="val-price">
                        @translate(Subscription Price) - <strong> {{ activeCurrencySymbol() }} </strong>  <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" min="1"
                            value="{{ old('price') }}"
                            class="form-control @error('price') is-invalid @enderror"
                            id="val-price" name="price" placeholder="@translate(Enter Subscription Package price)" aria-required="true" autofocus>
                        @error('price') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>

                <div class="form-group row price">
                    <label class="col-lg-3 col-form-label" for="val-instructor_payment">
                        @translate(Instructor Payment) - <strong> {{ activeCurrencySymbol() }} </strong>  <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" min="1"
                            value="{{ old('instructor_payment') }}"
                            class="form-control @error('instructor_payment') is-invalid @enderror"
                            id="val-instructor_payment" name="instructor_payment" placeholder="@translate(Enter Instructor Payment Amount)" aria-required="true" autofocus>
                        @error('instructor_payment') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>
           
    

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-is_discount">
                        @translate(Popular?)</label>
                    <div class="col-lg-9">
                        <div class="switchery-list">
                            <input type="checkbox" name="popular" class="js-switch-success" id="val-popular"/>
                            @error('popular') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>
                </div>


                {{-- Submit --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"></label>
                    <div class="col-lg-8">
                        <button type="submit" class="btn btn-primary">
                            @translate(Submit)</button>
                    </div>
                </div>

            </form>


        </div>

        <hr>


        <div class="card-body">
            <div class="row">

                @foreach ($packages as $package)
                    <div class="col-md-4">
                            <div class="card mb-4 box-shadow shadow border-success text-center">
                                <div class="card-header bg-success">
                                    <h4 class="my-0 font-weight-normal text-light">{{ $package->name }}</h4>
                                </div>
                                <div class="card-body">
                                    <h1><b>{{ formatPrice($package->price) }} </b><small class="text-muted">/ {{ $package->duration }}</small></h1>
                                    <h4><b><span class="badge badge-pill badge-success">{{ $package->popular == true ? 'Popular' : '' }}</span></b></h4>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        
                                        @foreach (json_decode($package->description) as $item)
                                            <li>{{ $item }}</li>
                                       @endforeach

                                    </ul> 

                                    <h5>
                                        <a href="{{ route('subscription.package.courses' , $package->duration) }}">
                                            {{ App\Models\SubscriptionCourse::where('subscription_duration','LIKE','%'.$package->duration.'%')->count() }} Courses
                                        </a>
                                    </h5>

                                    <small>Instructor Payment</small>
                                    <h6>
                                            {{ formatPrice($package->instructor_payment) }}
                                    </h6>
                                </div>

                                {{-- count --}}
                                

                                <div class="card-footer text-muted">
                                    <button 
                                     onclick="forModal('{{ route('subscription.edit',$package->id) }}', '{{$package->name}}')"
                                    type="button" 
                                    class="btn btn-lg btn-block btn-outline-info">Modify</button>

                                    @if ($package->deactive == 1)
                                        <a 
                                     href="{{ route('subscription.deactivate',$package->id) }}"
                                    class="btn btn-danger w-100 mt-2">Deactivate</a>
                                    @else
                                        <a 
                                     href="{{ route('subscription.deactivate',$package->id) }}"
                                    class="btn btn-success w-100 mt-2">Activate</a>
                                    @endif

                                    @if ($package->popular == 1)
                                        <a 
                                     href="{{ route('subscription.popular',$package->id) }}"
                                    class="btn btn-secondary w-100 mt-2">Unpopular</a>
                                    @else
                                        <a 
                                     href="{{ route('subscription.popular',$package->id) }}"
                                    class="btn btn-info w-100 mt-2">Popular</a>
                                    @endif
                                    

                                </div>

                            </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- END:content -->
@endsection
@section('js-link')

@stop
@section('page-script')

<script>
  

//Add Input Fields
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
    var x = 1; //Initial input field is set to 1

  
 //When user click on add input button
 $(add_button).click(function(e){
        e.preventDefault();
 //Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
 //add input field
            $(wrapper).append('<div><input type="text" required class="form-control mt-2" id="val-description" name="description[]" placeholder="Enter Package Description" aria-required="true" autofocus> <a href="javascript:void(0);" class="remove_field btn-sm btn-danger mt-2"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></div>');
        }
    });
 
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
 $(this).parent('div').remove(); //remove inout field
 x--; //inout field decrement
    });


$('#val-duration').on('change', function(){
    var duration = $('#val-duration').val();
    

    if (duration == 'Free') {
        $('.price').hide();
    }else{
        $('.price').show();
    }

});


});

</script>
@stop
