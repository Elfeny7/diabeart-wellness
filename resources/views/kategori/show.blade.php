@extends('dashboard.header')

@section('title', 'Admin')

@section('main-content')

<div class="container mt-10">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-body">
                List Produk 
                @foreach($produk as $produk)
                <img width="100px" src="{{asset('storage/'.$produk->gambar)}}">
                <li class="list-group-item"><b>Nama Produk                     : </b>{{ $produk->nama }}</li>
                @endforeach
            </div>
            <a class="btn btn-success mt3" href="{{ route('kategori.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
