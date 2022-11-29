@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <a href="" data-bs-toggle="modal" data-bs-target="#tambahModal" class="btn btn-primary mb-3">Tambah
                    Data</a>
                <div class="card">
                    <div class="card-header">Data Postingan</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Isi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Penulis</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->isi }}</td>
                                        <td>{{ $item->tanggalDibuat }}</td>
                                        <td><span class="badge bg-primary">{{ $item->category->namaKategori }}</span> </td>
                                        <td><span class="badge bg-danger">{{ $item->user->name }}</span></td>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" class="btn btn-warning">Edit</a>
                                            <a href="/post/{{ $item->id }}" class="btn btn-danger">Hapus</a>
                                                @if ($item->tampilPost == 1)
                                                    <a href="/tampilPost/{{ $item->id }}" class="btn btn-primary">Sembunyi</a>
                                                @else
                                                    <a href="/tampilPost/{{ $item->id }}" class="btn btn-warning">Tampil</a>
                                                @endif
                                        </td>
                                    </tr>
                                    {{-- Modal Edit --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Postingan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('post.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label class="form-label">Judul</label>
                                                            <input type="text" class="form-control" value="{{ $item->judul }}" name="judul">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Isi</label>
                                                            <input type="text" class="form-control" value="{{ $item->isi }}" name="isi">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal</label>
                                                            <input type="date" class="form-control" value="{{ $item->tanggalDibuat }}" name="tanggalDibuat">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kategori</label>
                                                            <select name="category_id" class="form-select" id="">
                                                                @foreach ($category as $data)
                                                                    <option value="{{ $data->id }}" @selected($data->id == $item->category_id)>{{ $data->namaKategori }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Postingan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi</label>
                            <input type="text" class="form-control" name="isi">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggalDibuat">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" id="">
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}">{{ $data->namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
