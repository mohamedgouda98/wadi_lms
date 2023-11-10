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
                @translate(Instructor Earning)
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
                            @translate(Amount)
                        </th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($instructors as $instructor)

                        <tr>
                            
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($instructors->currentPage() - 1)*$instructors->perPage() }}
                            </td> 
                            
                            <td>
                                {{ $instructor->name }}
                            </td>

                            <td>
                                <a href="{{ route('subscription.instructor.earning.view', $instructor->user_id) }}" class="btn btn-success">View</a>
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
                        {{ $instructors->links() }}
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
