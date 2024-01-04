@extends('layouts.master')
@section('title','dashboard')
@section('parentPageTitle', 'index')
@section('content')
   

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card m-2">

                <div class="card-title ml-2 mr-2">
                    <a href="{{ route('game.giveaway.reward') }}" class="btn btn-success w-100 mt-2">
                        @translate(Click To Giveaway Reward)
                    </a>
                </div>

                <div class="card-body t-div">
                    <div class="row mt-5">
                        @forelse ($games as $game)
                            <div class="col-4 mt-2">
                                <div class="news">
                                    <img src="{{ filePath('games/rush/images/rush-menu-scene.png') }}" class="w-100 rounded" alt="#No Addons Found">
                                    <a href="{{ route('games.' . $game->name) }}" class="btn btn-primary w-100 mt-2">{{ Str::upper($game->name) }}</a>
                                    <a href="{{ route('game.rank', $game->id) }}" class="btn btn-secondary w-100 mt-2" data-toggle="modal" data-target="#staticBackdrop{{ $game->id }}">@translate(Ranking)</a>
                                    <a href="{{ route('game.rules', $game->id) }}" class="btn btn-info w-100 mt-2" data-toggle="modal" data-target="#staticBackdropRules{{ $game->id }}">
                                        @translate(Game Rules)
                                    </a>

                                    <!-- Rules -->
                                    <div class="modal fade" id="staticBackdropRules{{ $game->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropRules{{ $game->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">{{ Str::upper($game->name) }} @translate(Rules)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('game.rules.update', $game->id) }}" method="POST">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="max_play">@translate(Maximum Played Limit)</label>
                                                    <input type="number" class="form-control" value="{{ $game->max_play }}" name="max_play" id="max_play" placeholder="Maximum Played Limit">
                                                </div>

                                                <div class="form-group">
                                                    <label for="points">@translate(Player Score To Rate)</label>
                                                    <input type="number" class="form-control" value="{{ $game->points }}" name="points" id="points" placeholder="Player Score To Rate">
                                                </div>

                                                <div class="form-group">
                                                    <label for="wallet">@translate(Convert Into Wallet Balance)</label>
                                                    <input type="number" class="form-control" value="{{ $game->wallet }}" name="wallet" id="wallet" placeholder="Convert Into Wallet Balance">
                                                    <small>@translate(Example: player score is 70. Score rate is 10. wallet convert rate is 2.)</small>
                                                    <br>
                                                    <small>@translate(Calc: player score / Score rate * wallet rate)</small>
                                                </div>
                                                

                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@translate(Close)</button>
                                                <button type="submit" class="btn btn-primary">@translate(Save)</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <!-- Ranking -->
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
                                                        <th scope="col">@translate(Rank)</th>
                                                        <th scope="col">@translate(Name)</th>
                                                        <th scope="col">@translate(Score)</th>
                                                        <th scope="col">@translate(Played)</th>
                                                        <th scope="col">@translate(Point)</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-script')
    
@endsection
