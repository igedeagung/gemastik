@extends('layouts.app')

@section('content')
@include('inc.messageError')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Lihat Tim') }}</h3></div>
    
                        <div class="card-body">
                            <a href="/home" class="btn btn-primary">Kembali</a>
                            <hr>
                            <h3>Calon Anggota</h3>
                            @if(count($users) > 0)
                            <table class="table table-striped">
                                    <tr>
                                        <th style="text-align:center">Nama </th>
                                        <th style="text-align:center">NRP</th>
                                        <th style="text-align:center">Kontak</th>
                                        <th style="text-align:center">E-mail</th>
                                        <th style="text-align:center">Aksi</th>
                                    </tr>
                                    @foreach($users as $user)
                                        <tr>
                                            <td style="text-align:center">{{$user->name}}</td>
                                            <td style="text-align:center">{{$user->nrp}}</td>
                                            <td style="text-align:center">{{$user->no_hp}}</td>
                                            <td style="text-align:center">{{$user->email}}</td>
                                            <td style="text-align:center">
                                                <a href="/tambah/{{$user->id}}/{{$team->id}}" class="btn btn-primary">Terima</a>    
                                                <a href="/tambah/delete/{{$user->id}}/{{$team->id}}" class="btn btn-danger">Tolak</a>    
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{$users->links()}}
                            @else
                                <p>Tidak ada calon anggota</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection