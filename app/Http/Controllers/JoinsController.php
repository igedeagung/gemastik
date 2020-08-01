<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Join;

class JoinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function joinn($id)
    {
        $user_idd=auth()->user()->id;
        
        $team=DB::table('teams')->where('id', '=', $id)->first();
        if($team==NULL)
        {
            return redirect('/home')->with('error', 'Error');
        }
        if($user_idd==$team->leader_nrp)
        {
            return redirect('/home')->with('error', 'Itu Tim Anda');
        }
        if ($team->jumlah == NULL)
        {
            return redirect('/home')->with('error', 'Tim Penuh');
        }
        $pernah=DB::table('joinn')
            ->where('team_id', '=', $id)
            ->where('user_id', '=', $user_idd)
            ->first();

        if ($pernah!=NULL)
        {
            return redirect('/home')->with('error', 'Anda sudah mengajukan permintaan join');
        }
        $status="Menunggu konfirmasi";
        DB::table('joinn')->insert(
            ['team_id' => $id, 'user_id'=>$user_idd, 'status'=> $status]
        );
        return redirect('/teams')->with('success', 'Berhasil join, kontak leader tim atau tunggu konfirmasi leader tim');
    }

    public function cancell($id)
    {   
        $us_id=auth()->user()->id;

        $pernah=DB::table('joinn')
            ->where('team_id', '=', $id)
            ->where('user_id', '=', $us_id)
            ->first();
        $hasil=DB::table('teams')
            ->where('id', '=', $pernah->team_id)
            ->first();
        $hasil2=$hasil->jumlah+1;
        if ($pernah==NULL)
        {
            return redirect('/home')->with('error', 'Anda tidak pernah join di tim ini');
        }
        if ($pernah->status=="Diterima") {
            DB::table('teams')
                ->where('id', '=', $pernah->user_id)
                ->update([
                    'jumlah' => $hasil2
                    ]);
        DB::table('joinn')->where('team_id', '=', $id)->where('user_id', '=', $us_id)->delete();
        return redirect('/home')->with('success', 'Permintaan join dibatalkan');
        }
        DB::table('joinn')->where('team_id', '=', $id)->where('user_id', '=', $us_id)->delete();
        return redirect('/home')->with('success', 'Permintaan join dibatalkan');
    }

    public function acceptt($id, $iid)
    {
        $hasil=DB::table('teams')
                ->where('id', '=', $iid)->first();
        
        $ussr=DB::table('users')
                ->where('id', '=', $id)->first();

        $cek=DB::table('joinn')
                ->where('team_id', '=', $iid)
                ->where('user_id', '=', $id)
                ->first();

        $leader=auth()->user()->nrp;
        
        if($cek==NULL)
        {
            //gaada join
            return redirect('/home')->with('error', 'Error');
        }

        if ($hasil->leader_nrp != $leader)
        {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }

        if ($hasil->jumlah>0) {
            $hasill=$hasil->jumlah-1;
            DB::table('teams')
                ->where('id', '=', $iid)
                ->update([
                    'jumlah' => $hasill
                    ]);
            if ($hasill>0) {
                DB::table('joinn')
                ->where('team_id', '=', $iid)
                ->where('user_id', '=', $id)
                ->update([
                    'status' => "Diterima"
                    ]);
            } else {
                DB::table('joinn')
                ->where('team_id', '=', $iid)
                ->where('user_id', '=', $id)
                ->update([
                    'status' => "Diterima"
                    ]);

                DB::table('joinn')
                ->where('team_id', '=', $iid)
                ->where('user_id', '<>', $id)
                ->update([
                    'status' => "Ditolak"
                    ]);
            }
            return redirect('/teams/'.$iid)->with('success', 'Berhasil ditambahkan');
        } else {
            return redirect('/teams/'.$iid)->with('error', 'Team sudah penuh');
        }
    }

    public function declinee($id, $iid)
    {
        $leader=auth()->user()->nrp;
        $hasil=DB::table('teams')
                ->where('id', '=', $iid)->first();
        
        $cek=DB::table('joinn')
                ->where('team_id', '=', $iid)
                ->where('user_id', '=', $id)
                ->first();
        if($cek==NULL)
        {
            return redirect('/home')->with('error', 'Hayo ngapain ?');
        }

        if ($hasil->leader_nrp != $leader)
        {
            return redirect('/home')->with('error', 'Unauthoorized Page');
        }

        DB::table('joinn')
                ->where('team_id', '=', $iid)
                ->where('user_id', '=', $id)
                ->update([
                    'status' => "Ditolak"
                    ]);
        return redirect('/teams/'.$iid)->with('success', 'Permintaan Bergabung ditolak');
    }
}
