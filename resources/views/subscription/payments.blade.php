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

                        <tr>
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($payments->currentPage() - 1)*$payments->perPage() }}
                            </td>

                            <td>
                                {{ $payment->course->name }}
                            </td>

                            <td>
                                {{ $payment->course->email }}
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
                                    <p class="d-none">{{ $price  +=  \App\Subscription::where('name','LIKE','%'.$item.'%')->sum('instructor_payment') }}</p>
                                @endforeach
                                {{ formatPrice($price) }}
                            </td>


                        </tr>




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

@stop
