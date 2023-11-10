@extends('layouts.master')
@section('title','Course Create')
@section('parentPageTitle', 'Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
   
        <div class="card m-b-30">
            <h4 class="card-header">@translate(Quiz Result)</h4>
            <div class="card-body mx-3">
                <table class="table table-striped- table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>@translate(Name)</th>
                        <th>@translate(Score)</th>
                        <th>@translate(Right Answer)</th>
                        <th>@translate(Wrong Answer)</th>
                        <th>@translate(Status)</th>
                        <th>@translate(Exam Taken)</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($quiz as $item)

                        @forelse ($item->scores as $score)
                        <tr>
                            <td>{{ ($loop->index+1) + ($quiz->currentPage() - 1)*$quiz->perPage() }}</td>
                            <td>{{ $score->student->name }}</td>
                            <td>{{ $score->score }}</td>
                            <td>{{ $score->right }}</td>
                            <td>{{ $score->wrong }}</td>
                            <td>{{ $score->status }}</td>
                            <td>{{ $score->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                            
                        @endforelse

                        
                    @empty

                        <tr></tr>
                        <tr></tr>
                        <tr>
                            <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        <tr></tr>
                        <tr></tr>

                    @endforelse
                    </tbody>
                    <div class="float-left">
                        {{ $quiz->links() }}
                    </div>
                </table>
            </div>
        </div>
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
@stop
@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>
@stop
