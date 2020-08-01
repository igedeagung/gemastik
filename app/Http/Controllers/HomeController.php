<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $aidi=auth()->user()->nrp;
        $tims=DB::table('teams')
                ->where('leader_nrp', '=', $aidi)
                ->paginate(10);

        $me=auth()->user()->id;
        $to=auth()->user()->nrp;
        $teame=DB::table('joinn')
                ->select('team_id', 'status')
                ->where('user_id', '=', $me);
        
        $teams=DB::table('teams')                
                ->rightJoinSub($teame,'teame', function($join){
                $join->on('teams.id', '=', 'teame.team_id');
                })
                ->paginate(10);
        
        return view('home')->with('datas1', $tims)->with('datas2', $teams);
    }
}
