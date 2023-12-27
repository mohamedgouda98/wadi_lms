<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePlayedAndRank;
use App\Models\GamePlayerRanking;
use App\Models\GameReward;
use App\Models\PointTransaction;
use Auth;
use Alert;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * frontend_index
     */
    public function frontend_index(Request $request)
    {
        $games = Game::get(); // get all games

        return view('games.frontend_index', compact('games'));
    }

    public function index()
    {
        $games = Game::get(); // get all games

        return view('games.index', compact('games'));
    }

    // Rush Game::Start
    public function rush()
    {

        // check total games played today
        $total_games_played = GamePlayedAndRank::where('user_id', Auth::user()->id)->where('created_at', '>=', date('Y-m-d'))->count();

        // check total game max played
        $total_game_max_played = Game::where('name', 'rush')->first();

        // check if user has played max games today
        if ($total_games_played >= $total_game_max_played->max_play) {
            notify()->warning(translate('You have played max games today'));

            return redirect()->route('dashboard.games.index');
        }

        // All Player Top Score Ranking
        $top_score_ranking = GamePlayedAndRank::where('game_id', $total_game_max_played->id)->orderBy('score', 'desc')->get()->take(20);

        return view('games.rush');
    }

    // store score
    public function rush_score_store(Request $request)
    {
        $user = Auth::user();
        $game = Game::where('name', 'rush')->first();
        $game_played = new GamePlayedAndRank;
        $game_played->user_id = $user->id;
        $game_played->game_id = $game->id;
        $game_played->score = $request->score;
        $game_played->save();

        $rank = GamePlayerRanking::where('user_id', $user->id)
                                ->where('game_id', $game->id)
                                ->whereDay('created_at', date('d'))
                                ->first();

        if ($rank) {
            $rank->user_id = $user->id;
            $rank->game_id = $game->id;
            $rank->score = player_score($user->id, $game->id);
            $rank->played = player_played($user->id, $game->id);
            $rank->point = player_average_score($user->id, $game->id);
            $rank->save();
        } else {
            $rank = new GamePlayerRanking;
            $rank->user_id = $user->id;
            $rank->game_id = $game->id;
            $rank->score = player_score($user->id, $game->id);
            $rank->played = player_played($user->id, $game->id);
            $rank->point = player_average_score($user->id, $game->id);
            $rank->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Score saved successfully']);
    }

    /**
     * giveaway_reward
     */
    public function giveaway_reward()
    {
        
        $winners = GamePlayerRanking::whereDay('created_at', date('d')) // today
                                    ->orderBy('point', 'DESC') // order by point desc
                                    ->take(3) // top 3
                                    ->get(); // get top 10 players

        foreach ($winners as $winner) {

            $game = Game::find($winner->game_id); // get game

            // check the player is already rewarded today
            $reward = GameReward::where('user_id', $winner->user_id)
                                ->where('game_id', $winner->game_id)
                                ->whereDay('created_at', date('d'))
                                ->first();

            if (!$reward) {

                $score = $winner->score; // player score
            
                //  each 10 points, player get 2 wallet
                $wallet = $score / $game->points; // get wallet
                $wallet = $wallet * $game->wallet; // total wallet
                $wallet = round($wallet); // This is the player wallet amount

                $reward = new GameReward;
                $reward->user_id = $winner->user_id; // player id
                $reward->game_id = $winner->game_id; // game id
                $reward->total_points = $score; // total points
                $reward->reward = $wallet; // total wallet
                $reward->save(); // save reward

                $add_to_wallet = PointTransaction::where('pointable_id', 2)->first(); // get player wallet
                $add_to_wallet->current = $add_to_wallet->current + $wallet; // add wallet to player wallet
                $add_to_wallet->save(); // save wallet

            }
        }

        Alert::success(translate('Reward has been sent to winners'));
        return back(); // back to previous page

    }

    /**
     * game_rules_update
     */
    public function game_rules_update(Request $request, $id)
    {
        $game = Game::find($id);
        $game->max_play = $request->max_play;
        $game->points = $request->points;
        $game->wallet = $request->wallet;
        $game->save();
        
        Alert::success(translate('Game rules has been updated'));
        return back();
    }

    // Rush Game::End

    //EDNS
}
