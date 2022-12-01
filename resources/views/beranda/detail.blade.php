@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Detail Artikel</h1>
        <a href="/" class="btn btn-warning mb-3">Kembali</a>
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Detail Artikel dari <span class="badge bg-primary">{{ $post->judul }}</span> </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Isi Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Judul</th>
                                <td>{{ $post->judul }}</td>
                            </tr>
                            <tr>
                                <th>Isi</th>
                                <td>{{ $post->isi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td><span class="badge bg-info">{{ $post->tanggalDibuat }}</span></td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td><span class="badge bg-secondary">{{ $post->category->namaKategori }}</span></td>
                            </tr>
                            <tr>
                                <th>Pengisi</th>
                                <td><span class="badge bg-dark">{{ $post->user->name }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h1 class="text-center mt-3">Rekomendasi Hari ini</h1>
        <div class="row justify-content-center">
            @foreach ($product as $item)
                <div class="card ms-3" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->namaProduk }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->category->namaKategori }}</h6>
                        <p class="card-text">{{ $item->isi }}</p>
                        <blockquote class="blockquote mb-2">
                            <footer class="blockquote-footer">Harga : Rp.<cite title="Source Title">{{ $item->harga }}</cite>
                            </footer>
                        </blockquote>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
