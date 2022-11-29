@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Postingan Hari ini</h1>
        <div class="row justify-content-center">
            @foreach ($post as $item)
                <div class="card ms-3" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->category->namaKategori }}</h6>
                        <p class="card-text">{{ $item->isi }}</p>
                        <blockquote class="blockquote mb-2">
                            <footer class="blockquote-footer"><cite title="Source Title">{{ $item->user->name }}</cite>
                            </footer>
                        </blockquote>
                        <a href="{{ route('beranda.show', $item->id) }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
