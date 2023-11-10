<form action="{{ route('subscription.update', $package->id) }}" method="post">
                @csrf

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-name">
                        @translate(Package Name) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" required
                            value="{{ $package->name }}"
                            class="form-control @error('name') is-invalid @enderror"
                            id="val-name" name="name" placeholder="@translate(Enter Subscription Package Name)" aria-required="true" autofocus>
                        @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="val-description-edit">
                        @translate(Package Description) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        
                        @foreach (json_decode($package->description) as $item)
                            <div><input type="text" required class="form-control mt-2" value="{{ $item }}" id="val-description-edit" name="description[]" placeholder="Enter Package Description" aria-required="true" autofocus> <a href="javascript:void(0);" class="remove_field_edit btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></div>
                        @endforeach
                        <div class="wrapper-edit"></div>
                                 
                        <button id="Array_name" class="add_fields_edit btn btn-primary mt-2"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Add More Description</button>

                    </div>
                </div>

                {{-- Provider --}}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="val-duration">
                    @translate(Subscription Duration) <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select  class="form-control lang val-duration @error('duration') is-invalid @enderror" id="val-duration" name="duration" required>
                        <option value="">
                            @translate(Select Duration)</option>
                        <option value="Free" {{ $package->duration == "Free" ? 'selected' : '' }}>
                            @translate(Free)</option>
                        <option value="Daily" {{ $package->duration == "Daily" ? 'selected' : '' }}>
                            @translate(Daily)</option>
                        <option value="Weekly" {{ $package->duration == "Weekly" ? 'selected' : '' }}>
                            @translate(Weekly)</option>
                        <option value="Monthly" {{ $package->duration == "Monthly" ? 'selected' : '' }}>
                            @translate(Monthly)</option>
                        <option value="Yearly" {{ $package->duration == "Yearly" ? 'selected' : '' }}>
                            @translate(Yearly)</option>
                    </select>
                </div>
                @error('duration') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>


                <div class="form-group row price_edit">
                    <label class="col-lg-3 col-form-label" for="val-price">
                        @translate(Subscription Price) - <strong> {{ activeCurrencySymbol() }} </strong>  <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text"
                            value="{{ $package->price }}"
                            class="form-control @error('price') is-invalid @enderror"
                            id="val-price" name="price" placeholder="@translate(Enter Subscription Package price)" aria-required="true" autofocus>
                        @error('price') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                </div>


                <div class="form-group row price_edit">
                    <label class="col-lg-3 col-form-label" for="val-instructor_payment">
                        @translate(Instructor Payment) - <strong> {{ activeCurrencySymbol() }} </strong>  <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" min="1"
                            value="{{ $package->instructor_payment }}"
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
                            <input type="checkbox" name="popular" class="js-switch-success" id="val-popular" {{ $package->popular == true ? 'checked' : '' }}/>
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


            <script>
  

//Add Input Fields
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper-edit"); //Input fields wrapper
    var wrapper_remove    = $(".wrapper-remove"); //Input fields wrapper
    var add_button = $(".add_fields_edit"); //Add button class or ID
    var x = 1; //Initial input field is set to 1

  
 //When user click on add input button
 $(add_button).click(function(e){
        e.preventDefault();
 //Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
 //add input field
            $(wrapper).append('<div><input type="text" required class="form-control mt-2" id="val-description" name="description[]" placeholder="Enter Package Description" aria-required="true" autofocus> <a href="javascript:void(0);" class="remove_field btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></div>');
        }
    });
 
    //when user click on remove button
    $('.remove_field_edit').on("click", function(e){ 
        e.preventDefault();
 $(this).parent('div').remove(); //remove input field
 x--; //inout field decrement
    })


    $('.val-duration').on('change', function(){
    var duration = $('.val-duration').val();
    

    if (duration == 'Free') {
        $('.price_edit').hide();
    }else{
        $('.price_edit').show();
    }

});

});

</script>