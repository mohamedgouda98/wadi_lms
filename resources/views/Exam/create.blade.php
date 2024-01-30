@extends('layouts.master')
@section('title','Exam Create')
@section('parentPageTitle', 'Exam')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <h4 class="card-header">@translate(Add New Exam)</h4>
        <div class="card-body mx-3">
            <form action="{{ route('exam.store') }}" method="post">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                @include('Exam.inc._form')
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
    </div>
    <!-- END:content -->
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
@stop



