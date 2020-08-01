<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Team;
use DB;

class TeamsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $teams = Team::orderBy('created_at','desc')->paginate(10);
        
        $to=auth()->user()->nrp;

        $teams=DB::table('teams')
            ->whereNotExists(function ($query) {
                $me=auth()->user()->id;
                $query->select(DB::raw(1))
                      ->from('joinn')
                      ->whereRaw('joinn.user_id = ?', $me)
                      ->whereRaw('joinn.team_id = teams.id');
            })
            ->where('teams.leader_nrp', '<>', $to)
            ->where('teams.jumlah', '>', '0')
            ->paginate(10);
        
        return view('teams.index')->with('teams', $teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'team_name' => 'required',
            'comment' => ['required'],
        ]);

        // Create
        $teams = new Team;
        $teams->jumlah=$request->input('jumlah');
        $teams->leader_name=auth()->user()->name;
        $teams->leader_nrp=auth()->user()->nrp;
        $teams->leader_contact=auth()->user()->no_hp;
        $teams->team_name=$request->input('team_name');
        $teams->category = $request->input('kategori');
        $teams->description = $request->input('comment');
        $teams->save();

        return redirect('/home')->with('success', 'Tim berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teams=DB::table('teams')
                ->where('teams.id', '=', $id)
                ->first();

        if(auth()->user()->nrp !==$teams->leader_nrp){
            return redirect('/home')->with('error', 'Unauthorized Page');
        }
        $teame=DB::table('joinn')
                ->select('user_id', 'status')
                ->where('team_id', '=', $id);
        
        $users=DB::table('users')                
                ->rightJoinSub($teame,'teame', function($join){
                $join->on('users.id', '=', 'teame.user_id');
                })->where('status', '=', "Menunggu konfirmasi")
                ->paginate(10);
        
        return view('teams.show')->with('team', $teams)->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team=DB::table('teams')
            ->where('id', '=', $id)
            ->first();
        return view('teams.edit')->with('team', $team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek=DB::table('teams')
            ->where('id', '=', $id)
            ->first();

        if($cek==NULL)
        {
            return redirect('/home')->with('error', 'Not Found');
        }

        DB::table('joinn')
            ->where('team_id','=',$id)
            ->delete();

            $cek=DB::table('teams')
            ->where('id', '=', $id)
            ->delete();;
        return redirect('/home')->with('success', 'Tim telah dihapus');    
    }

    
}
