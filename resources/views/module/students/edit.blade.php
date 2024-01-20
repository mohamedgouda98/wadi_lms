@extends('layouts.master')
@section('title','Profile')
@section('parentPageTitle', 'Edit')

@section('css-link')
    @include('layouts.include.form.form_css')
@stop

@section('page-style')

@stop

@section('content')
    <!-- BEGIN:content -->
    <div class="card mb-3">
        <div class="py-2 px-3">
            <div class="float-left">
                <h3>@translate(Student Update)</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row flex-row">
                <div class="col-xl-3">
                    <!-- Begin Widget -->
                    <div class="widget has-shadow">
                        <div class="widget-body">
                            <div class="text-center">

                                <img src="{{filePath($student->image)}}" alt="avatar" class="img-fluid rounded-circle avatar-xl">
                            </div>
                            <h3 class="text-center mt-3 mb-1">{{ $student->name }}</h3>
                            <div class="em-separator separator-dashed"></div>
                        </div>
                    </div>
                    <!-- End Widget -->
                </div>
                <div class="col-xl-9">
                    <div class="widget has-shadow">
                        <div class="widget-header bordered no-actions d-flex align-items-center">
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                                <div class="widget-body">
                                    <form action="{{ route('students.update') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        @error('student_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <table class="table table-bordered table-striped">
                                        <thead>
                                        </thead>
                                        <tbody>

                                        <tr class="text-center">
                                            <td>@translate(Name)</td>
                                            <td><input type="text" value="{{ old('name',$student->name) }}" name="name" class="form-control @error('name') is-invalid @enderror"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>@translate(Email)</td>
                                            <td><input type="email" value="{{ old('email',$student->email) }}" name="email" class="form-control @error('email') is-invalid @enderror"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>@translate(Phone)</td>
                                            <td><input type="tel" value="{{ old('phone', $student->phone )}}" name="phone" class="form-control @error('phone') is-invalid @enderror"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>@translate(Address)</td>
                                            <td><input type="text" value="{{ old('address', $student->address) }}" name="address" class="form-control @error('address') is-invalid @enderror"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>@translate(Linked In)</td>
                                            <td><input type="url" value="{{ old('linked', $student->linked )}}" name="linked" class="form-control @error('linked') is-invalid @enderror"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>@translate(Facebook)</td>
                                            <td><input type="url" value="{{ old('fb', $student->fb) }}" name="fb" class="form-control @error('fb') is-invalid @enderror"></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>@translate(Twitter)</td>
                                            <td><input type="url" value="{{ old('tw', $student->tw) }}" name="tw" class="form-control @error('tw') is-invalid @enderror"></td>
                                        </tr>
{{--                                        <tr class="text-center">--}}
{{--                                            <td>@translate(Skype)</td>--}}
{{--                                            <td><input type="text" value="{{ old('skype',$student->skype) }}" name="skype" class="form-control @error('skype') is-invalid @enderror"></td>--}}
{{--                                        </tr>--}}
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                        <button type="submit" class="btn btn-primary">@translate(Student Update)</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
    </div>
    <!-- END:content -->
@endsection

@section('js-link')
    @include('layouts.include.form.form_js')
@stop

@section('page-script')

@stop
