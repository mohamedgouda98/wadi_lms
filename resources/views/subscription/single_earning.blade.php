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
                @translate(Instructor Payments)
            </h3>
        </div>


        
       
 


        



         <div class="card-body">
          <span class="h5">Your Subscription Earning</span> <strong class="h4">{{ activeCurrencySymbol() }}</strong><strong class="h4 total_amount">0</strong> 

          @if (adminPower())

           <form action="{{ route('subscription.earning') }}" method="post" class="earningForm mt-3 mb-3">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $id }}">
                            <input type="hidden" name="amount" class="total_amount_value" value="0">
           
@php

    $start_month = \Carbon\Carbon::parse(date('Y-M-d'))->startOfMonth()->toDateTimeString();
    $end_month = \Carbon\Carbon::parse(date('Y-M-d'))->endOfMonth()->toDateTimeString();
    $start_year = \Carbon\Carbon::parse(date('Y-M-d'))->startOfYear()->toDateTimeString();
    $end_year = \Carbon\Carbon::parse(date('Y-M-d'))->endOfYear()->toDateTimeString();

    $months = array();
    $labels = array();
    for($i = 1 ; $i <= 12; $i++)
    {
        $m = date("M",mktime(0,0,0,$i,1,date("Y")));
        array_push($months,$m);
        array_push($labels, date("F",mktime(0,0,0,$i,1,date("Y"))));
        if(date('M') == $m){
            break;
        }
    }
    $inc =0;
    $inc1 =0;
    $labels = json_encode($labels);


    $check_value = \App\InstructorSubscriptionEarning::whereBetween('created_at',[$start_month, $end_month])->get()->sum('amount');

    
    @endphp

    @if ($check_value > 0)
    @else
    <button type="submit" class="btn btn-primary">Add To Instructor Earning</button>
    @endif


            </form>
              
          @endif

         
          
        </div>


        <div class="card-body">

            <div class="table-responsive">
                <table class="table foo-filtering-table text-center">
                    <thead class="text-center">
                    <tr class="footable-header">

                        <th data-breakpoints="xs" class="footable-first-visible">
                            @translate(S/L)
                        </th>
                        <th>
                            @translate(Instructor Name)
                        </th>
                        <th>
                            @translate(Email)
                        </th>
                        <th>
                            @translate(Subscription)
                        </th>
                        <th>
                            @translate(Course)
                        </th>
                        <th>
                            @translate(Amount)
                        </th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($payments as $payment)



                   @if ($payment->course->relationBetweenInstructorUser->id == $id)

                   @if (App\InstructorSubscriptionPayment::where('user_id', $payment->course->relationBetweenInstructorUser->id)->first() != null)
                       
                   
                       
                   <tr>
                       <td class="footable-first-visible">
                           {{ ($loop->index+1) + ($payments->currentPage() - 1)*$payments->perPage() }}
                       </td> 
                       
                       <td>
                           {{ $payment->course->relationBetweenInstructorUser->name }}
                       </td>
                       
                       <td>
                           {{ $payment->course->relationBetweenInstructorUser->email }}
                       </td>
                       
                       <td>
                           @foreach (json_decode($payment->subscription_duration) as $item)
                              <span class="badge badge-success text-white">{{ $item }}</span>
                           @endforeach
                       </td>
                       
                       <td>
                           <a href="{{route('course.single',$payment->course->slug)}}" target="_blank">
                               {{ $payment->course->title }}
                           </a>
                       </td>
                       <td>
                           @php
                            $price = 0;    
                           @endphp

                           @foreach (json_decode($payment->subscription_duration) as $item)
                               <p class="d-none">{{ $price  +=  App\Subscription::where('name','LIKE','%'.$item.'%')->sum('instructor_payment') }}</p>
                           @endforeach
                           {{ formatPrice($price) }}

                           <input type="hidden" class="price" value="{{ $price }}">

                       </td>
                       
                   </tr>

                        

                   @endif

                   @endif

                        @empty
                        <tr>
                            <td colspan="6">
                                <img src="{{ filePath('no_data.png') }}" class="img-fluid w-100" alt="#No Data Found">
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                    <div class="float-left">
                        {{ $payments->links() }}
                    </div>
                </table>
            </div>

        </div>

    </div>


    <!-- END:content -->
@endsection
@section('js-link')

@stop
@section('page-script')
<script>

    $(document).ready(function(){
       
        var total = 0;   
        $(".price").each( function(){
                total += $(this).val() * 1;
            $('.total_amount').text(total);
            $('.total_amount_value').val(total);
        });

    });


</script>
@stop
