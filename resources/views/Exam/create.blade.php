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
    <script>
        // Get the checkbox element
        const specificClassCheckbox = document.getElementById('specific_class');
        // Get the select element
        const classSelect = document.getElementById('class_select');

        // Add event listener to the checkbox
        specificClassCheckbox.addEventListener('change', function() {
            // If checkbox is checked, show the select element; otherwise, hide it
            if (this.checked) {
                classSelect.style.display = 'block';
            } else {
                classSelect.style.display = 'none';
            }
        });

        // Initially hide the select element if checkbox is not checked
        if (!specificClassCheckbox.checked) {
            classSelect.style.display = 'none';
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#class').change(function() {
                const classId = $(this).val();
                if (classId) {
                    $.ajax({
                        url: '/getClassContents/' + classId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#class_content').empty();
                            $('#class_content').append('<option value="">Select Class Content</option>');
                            $.each(data, function(key, value) {
                                $('#class_content').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                } else {
                    $('#class_content').empty();
                }
            });
        });
    </script>
@stop



