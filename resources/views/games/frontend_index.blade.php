@extends('frontend.app')
@section('content')
    <!-- ================================
      START BREADCRUMB AREA
  ================================= -->
    <section class="breadcrumb-area instructor-breadcrumb-area text-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content instructor-bread-content d-flex align-items-center">
                        <div class="section-heading">
                            <h2 class="section__title font-size-50">@translate(Play & Earn Wallet)</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START SPEAKER AREA
    ======================================-->
    <section class="team-detail-area section-padding">
        <div class="container">
            <div class="row">
                

                @forelse ($games as $game)
                            <div class="col-4 mt-2">
                                <div class="news">
                                    <img src="{{ filePath('games/rush/images/rush-menu-scene.png') }}" class="w-100 rounded" alt="#No Addons Found">
                                    <a href="{{ route('games.' . $game->name) }}" class="btn btn-primary w-100 mt-2 text-white">{{ Str::upper($game->name) }}</a>
                                    <a href="{{ route('game.rank', $game->id) }}" class="btn btn-secondary w-100 mt-2 text-white" data-toggle="modal" data-target="#staticBackdrop{{ $game->id }}">@translate(Ranking)</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{ $game->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">@translate(Top 10 Rank) - {{ Carbon\Carbon::now()->format('d F, Y') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h5 class="mb-2">@translate(Total Player Participants) : {{ player_rank($game->id)['players_count'] }}</h5>
                                                
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col">Rank</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Score</th>
                                                        <th scope="col">Played</th>
                                                        <th scope="col">Point</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse (ranking($game->id) as $rank)
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }} 
                                                                    @if ($loop->iteration <= 3)
                                                                        <i class="fa fa-diamond ml-2"
                                                                        style="color: 
                                                                        {{ $loop->iteration == 1 ? '#FFD700' : null}}
                                                                        {{ $loop->iteration == 2 ? '#cd7f32 ' : null}}
                                                                        {{ $loop->iteration == 3 ? '#C0C0C0 ' : null}}
                                                                        "></i>
                                                                    @endif
                                                                </th>
                                                                <td>{{ player_name($rank->user_id) }}</td>
                                                                <td>{{ $rank->score }}</td>
                                                                <td>{{ $rank->played }}</td>
                                                                <td>{{ $rank->point }}</td>
                                                            </tr>
                                                            
                                                        @empty
                                                            
                                                        @endforelse
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-sm btn-secondary" data-dismiss="modal">@translate(Close)</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal::ENDS -->
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <img src="{{ filePath('no-addon-found.jpg') }}" class="w-100" alt="#No Addons Found">
                            </div>
                        @endforelse


            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end team-detail-area -->
    <!--======================================
            END SPEAKER AREA
    ======================================-->
@endsection
