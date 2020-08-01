@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Edit Tim') }}</h3></div>
    
                    <div class="card-body">
                        <form method="POST" action="{{route('teams.store')}}">
                            @csrf
    
                            <div class="form-group row">
                                    <label for="team_name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Tim') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="team_name" type="text" class="form-control @error('team_name') is-invalid @enderror" name="team_name" value="{{ old('team_name') }}" required autocomplete="team_name" autofocus>
        
                                        @error('team_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                    
                                </div>
    
                                <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right" for="jumlah">Jumlah Anggota yang Dibutuhkan</label>
                                        <div class="col-md-6">
                                            <select name="jumlah" id="jumlah" class="form-control">
                                                <option> 1 </option>
                                                <option> 2 </option>
                                            </select>
                                        </div>
                                    </div>                   
                                
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="kategori">Kategori Lomba</label>
                                    <div class="col-md-6">
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option> Animasi </option>
                                            <option> Desain Pengalaman Pengguna </option>
                                            <option> Karya Tulis Ilmiah TIK </option>
                                            <option> Keamanan Siber </option>
                                            <option> Kota Cerdas </option>
                                            <option> Pemrograman </option>
                                            <option> Penambangan Data </option>
                                            <option> Pengembangan Aplikasi Permainan </option>
                                            <option> Pengembangan Bisnis TIK </option>
                                            <option> Pengembangan Perangkat Lunak </option>
                                            <option> Piranti Cerdas, Sistem Benam dan IoT </option>
                                        </select>
                                    </div>
                                </div>              
                                <div class="form-group row">
                                    <label for="comment" class="col-md-4 col-form-label text-md-right">Deskripsi Singkat</label>
                                    <div class="col-md-6">
                                        <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="5" id="comment" placeholder="Deskripsikan ide dan anggota yang anda butuhkan" value="{{ old('comment') }}" required autocomplete="comment"></textarea>
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Buat Tim') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection