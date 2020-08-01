@extends('layouts.app')

@section('content')
@include('inc.messageError')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/teams/create" class="btn btn-primary">Buat Tim</a>
                    <a href="/teams" class="btn btn-primary">Gabung Tim</a>
                    
                    <hr>
                    <h3>Tim Saya</h3>
                    @if(count($datas1) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th style="text-align:center">Nama Tim</th>
                                
                                <th style="text-align:center">Jumlah Anggota yang Dibutuhkan</th>
                                <th style="text-align:center">Kategori</th>
                                <th style="text-align:center">Deskripsi</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                            @foreach($datas1 as $team)
                                <tr>
                                    <td style="text-align:center">{{$team->team_name}}</td>
                                    
                                    <td style="text-align:center">{{$team->jumlah}}</td>
                                    <td style="text-align:center">{{$team->category}}</td>
                                    <td style="text-align:center">{{$team->description}}</td>
                                    <td style="text-align:center">                                    
                                        
                                            <form action="{{route('teams.destroy', $team->id)}}" method="post">
                                                    {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            <a href="{{route('teams.show', $team->id)}}" class="btn btn-primary">Lihat</a>            
                                            {{-- <a href="{{route('teams.edit', $team->id)}}" class="btn btn-primary">Edit</a>             --}}
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ?');">Hapus</a>
                                        </form>
                                        
                                
                                    </td>   
                                </tr>
                            @endforeach
                        </table>
                        {{$datas1->links()}}
                    @else
                        <p>Anda tidak memiliki tim</p>
                    @endif
                    <hr>
                    <h3>Tim Sementara</h3>
                    @if(count($datas2) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th style="text-align:center">Nama Tim</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">NRP</th>
                                <th style="text-align:center">Kontak</th>
                                <th style="text-align:center">Kategori</th>
                                
                                <th style="text-align:center">Deskripsi</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                            @foreach($datas2 as $team)
                                <tr>
                                    <td style="text-align:center">{{$team->team_name}}</td>
                                    <td style="text-align:center">{{$team->leader_name}}</td>
                                    <td style="text-align:center">{{$team->leader_nrp}}</td>
                                    <td style="text-align:center">{{$team->leader_contact}}</td>
                                    <td style="text-align:center">{{$team->category}}</td>
                                
                                    <td style="text-align:center">{{$team->description}}</td>    
                                    <td style="text-align:center">{{$team->status}}</td>    
                                    <td style="text-align:center">
                                        <a href="/join/delete/{{$team->id}}" class="btn btn-danger">Batalkan Bergabung</a>    
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{$datas2->links()}}
                    @else
                        <p>Tim tidak ditemukan</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
