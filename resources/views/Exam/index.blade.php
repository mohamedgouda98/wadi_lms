@extends('layouts.master')
@section('title','Exam Index')
@section('parentPageTitle', 'All Exam')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <div class="row px-3 pt-3">
            <h3 class="col-md-6">
                @translate(All Exam)
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
                            @translate(Name)
                        </th>
                        <th>
                            @translate(Course)
                        </th>
                        <th data-breakpoints="xs">
                            @translate(Degree)
                        </th>
                        <th>@translate(Limit Questions)</th>
                        <th data-breakpoints="xs">@translate(Active)</th>
                        <th data-breakpoints="xs">@translate(Close)</th>
                        <th>@translate(Action)</th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($exams as $exam)
                        <tr>
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($exams->currentPage() - 1)*$exams->perPage() }}
                            </td>
{{--                            <td class="w-45 text-left">--}}
{{--                                <a href="{{  route('course.show',[$course->id,$course->slug]) }}">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="row no-gutters">--}}
{{--                                            <div class="col-md-4 overflow-auto my-auto">--}}
{{--                                                <img src="{{$course->image}}" class="card-img avatar-xl"--}}
{{--                                                     alt="Card image">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-8">--}}
{{--                                                <div class="card-body">--}}
{{--                                                    <h5 class="card-title font-16">{{ $course->title }}</h5>--}}
{{--                                                    <p class="text-secondary">{{$course->level}}</p>--}}
{{--                                                    <div class="d-flex justify-content-between">--}}
{{--                                                        <span--}}
{{--                                                            class="badge badge-{{ $course->is_published == true ? 'success'  : 'primary' }} p-2">{{ $course->is_published == true ? 'Published'  : 'Not Published' }}</span>--}}
{{--                                                        @if ($course->is_discount == true )--}}
{{--                                                            <span>{{ formatPrice($course->discount_price) }}</span>--}}
{{--                                                            <span> <del> {{ formatPrice($course->price) }} </del> </span>--}}
{{--                                                        @else--}}
{{--                                                            <span>{{ $course->price != null ? formatPrice($course->price)  : 'Free' }}</span>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </td>--}}
                            <td>{{ $exam->name }}</td>
                            <td><span class="badge badge-info">{{ $exam->course->title }}</span></td>
                            <td>
                                {{ $exam->degree }}
                            </td>
                            <td>
                                <p class="text-primary">{{ $exam->limit_questions }}</p>
                            </td>
                            <td>
                               {{ $exam->active ? translate('active') : translate('not_active') }}
                            </td>
                            <td>{{ $exam->close ? translate('closed') : translate('not_closed') }}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 font-18 float-right" type="button"
                                            id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="feather icon-more-horizontal-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right st-drop"
                                         aria-labelledby="widgetRevenue" x-placement="bottom-end">
                                        <a class="dropdown-item font-13"
                                           href="{{ route('exam.edit', $exam) }}">
                                            @translate(Edit)
                                        </a>
                                        <a class="dropdown-item font-13"
                                           href="{{ route('question.create', $exam) }}">
                                            @translate(Add Question)
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <img src="{{ filePath('no-course-found.jpg') }}" class="img-fluid w-100" alt="#No COurse Found">
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="float-right">
                    {{ $exams->links() }}
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
