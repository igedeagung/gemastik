@extends('layouts.app')

@section('content')
@include('inc.messageError')
    <h1>Semua tim</h1>
    @if(count($teams) > 0)
        <table class="table table-striped">
            <tr>
                <th style="text-align:center">Nama Tim</th>
                <th style="text-align:center">Nama</th>
                <th style="text-align:center">NRP</th>
                <th style="text-align:center">Kontak</th>
                <th style="text-align:center">Kategori</th>
                <th style="text-align:center">Jumlah Anggota yang Dibutuhkan</th>
                <th style="text-align:center">Deskripsi</th>
                <th style="text-align:center">Aksi</th>
            </tr>
            @foreach($teams as $team)
                <tr>
                    <td style="text-align:center">{{$team->team_name}}</td>
                    <td style="text-align:center">{{$team->leader_name}}</td>
                    <td style="text-align:center">{{$team->leader_nrp}}</td>
                    <td style="text-align:center">{{$team->leader_contact}}</td>
                    <td style="text-align:center">{{$team->category}}</td>
                    <td style="text-align:center">{{$team->jumlah}}</td>
                    <td style="text-align:center">{{$team->description}}</td>    
                    <td style="text-align:center">
                        <a href="/join/{{$team->id}}" class="btn btn-primary">Join</a>    
                    </td>
                </tr>
            @endforeach
        </table>
        {{$teams->links()}}
        <a href="/home" class="btn btn-primary">Kembali</a>
    @else
        <p>Tim tidak ditemukan</p>
    @endif
@endsection