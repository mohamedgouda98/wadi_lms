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
                @translate(Subscription Member)
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
                            @translate(Email)
                        </th>
                        <th>
                            @translate(Subscription)
                        </th>
                        <th>
                            @translate(Start Date)
                        </th>
                        <th>
                            @translate(End Date)
                        </th>
                        <th>
                            @translate(Status)
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($members as $member)

                        <tr>
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($members->currentPage() - 1)*$members->perPage() }}
                            </td> 
                            
                            <td>
                                {{ $member->user->name }}
                            </td>
                            
                            <td>
                                {{ $member->user->email }}
                            </td>
                            
                            <td class="badge badge-success text-white">
                                {{ $member->subscription_package }}
                            </td>
                            
                            <td>
                                {{ $member->start_at }}
                            </td>
                            <td>
                                {{ $member->end_at }}
                            </td>
                            <td>
                                @php        
                                    $subs = App\Models\SubscriptionEnrollment::where('subscription_package', $member->subscription_package)->where('end_at',  '>' , Carbon\Carbon::now())->where('user_id', $member->user_id)->count();
                                @endphp

                                @if ($subs > 0) 
                                    <span class="badge badge-success text-white">
                                        Active
                                    </span>    
                                @else
                                    <span class="badge badge-danger text-white">
                                        Expired
                                    </span>    
                                @endif
                                
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
                        {{ $members->links() }}
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
