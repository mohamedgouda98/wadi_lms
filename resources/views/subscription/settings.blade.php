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
                @translate(Subscription Settings)
            </h3>
        </div>
        
        <hr>

        <div class="card-body">

           <div class="row">
             <div class="col-md-10 offset-md-1 px-5">
                <div class="card m-2">
                
                    <div class="card-body mx-5">
                    <form method="post" action="{{route('subscription.settings.update')}}" enctype="multipart/form-data">
                    @csrf

                        <!--Enable Instructor Request-->
                        <label class="label text-black">@translate(Enable Instructor Request)</label>
                        <input type="hidden" value="enable_instructor_request" name="enable_instructor_request">

                        <div class="switchery-list">
                            <input type="checkbox" name="enable_instructor_request_value" class="js-switch-success" id="val-instructor" {{getSubscriptionSetting('enable_instructor_request')->value == true ? 'checked' : ''}}/>
                            <br>
                            <p class="text-black">Note: Enabling Instructor request will disable all course subscription. </p>
                            <br>
                        </div>

                        <!--Enable All Course In Subscription-->
                        <label class="label text-black">@translate(Enable All Course In Subscription)</label>
                        <input type="hidden" value="enable_all_course" name="enable_all_course">

                        <div class="switchery-list">
                            <input disabled type="checkbox" class="js-switch-success" id="val-course" {{ getSubscriptionSetting('enable_all_course')->value == true ? 'checked' : '' }}/>
                            <br>
                            <p class="text-black">Note: Disabling Instructor request will enable all course subscription. </p>
                            <br>
                        </div>

                        <!--Enable Free Trial-->
                        <label class="label text-black">@translate(Enable Free Trial)</label>
                        <input type="hidden" value="enable_free_trial" name="enable_free_trial">

                        <div class="switchery-list">
                            <input type="checkbox" name="enable_free_trial_value" class="js-switch-success" id="val-popular" {{getSubscriptionSetting('enable_free_trial')->value == true ? 'checked' : ''}}/>
                            <br>
                            <p class="text-black">Note: Enabling Free trail will display Free option. </p>
                            <br>
                        </div>

                        <!--Enable Free Trial-->
                        <label for="val-payment_schedule" class="label text-black">@translate(Payment Schedule)</label>
                        <input type="hidden" value="payment_schedule" name="payment_schedule">

                        <select  class="form-control lang @error('payment_schedule_value') is-invalid @enderror" id="val-payment_schedule" name="payment_schedule_value" required>
                            <option value="">
                                @translate(Select Duration)</option>
                            <option value="Weekly" {{ getSubscriptionSetting('payment_schedule')->value == 'Weekly' ? 'selected' : null }} >
                                @translate(Weekly)</option>
                            <option value="Monthly" {{ getSubscriptionSetting('payment_schedule')->value == 'Monthly' ? 'selected' : null }}>
                                @translate(Monthly)</option>
                            <option value="Yearly" {{ getSubscriptionSetting('payment_schedule')->value == 'Yearly' ? 'selected' : null }}>
                                @translate(Yearly)</option>
                        </select>

                        <div class="mt-2">
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

        </div>

    </div>
    <!-- END:content -->
@endsection
@section('js-link')

@stop
@section('page-script')

@stop
