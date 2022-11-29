@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <a href="" data-bs-toggle="modal" data-bs-target="#tambahModal" class="btn btn-primary mb-3">Tambah
                    Data</a>
                <div class="card">
                    <div class="card-header">Data Product</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Deskripsi Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->namaProduk }}</td>
                                        <td>{{ $item->descProduk }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td><span class="badge bg-primary">{{ $item->category->namaKategori }}</span></td>
                                        <td><img src="{{ asset('storage/'. $item->foto) }}" width="100px" alt="" srcset=""></td>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" class="btn btn-warning">Edit</a>
                                            <a href="/product/{{ $item->id }}" class="btn btn-danger">Hapus</a>
                                            @if ($item->tampilBarang == 1)
                                            <a href="/tampilBarang/{{ $item->id }}" class="btn btn-primary">Sembunyi</a>
                                            @else
                                                <a href="/tampilBarang/{{ $item->id }}" class="btn btn-warning">Tampil</a>
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
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Produk</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Produk</label>
                                                            <input type="text" class="form-control" value="{{ $item->namaProduk }}" name="namaProduk">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi Produk</label>
                                                            <input type="text" class="form-control" value="{{ $item->descProduk }}" name="descProduk">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Harga</label>
                                                            <input type="number" class="form-control" value="{{ $item->harga }}" name="harga">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kategori</label>
                                                            <select name="category_id" class="form-select" id="">
                                                                @foreach ($category as $data)
                                                                    <option value="{{ $data->id }}" @selected($data->id == $item->category_id)>{{ $data->namaKategori }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Foto</label>
                                                            <input type="file" class="form-control" name="foto">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Foto Sebelumnya : </label>
                                                        </div>
                                                        <div class="mb-3">
                                                            <img src="{{ asset('storage/'. $item->foto) }}" width="100px" alt="" srcset="">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="namaProduk">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Produk</label>
                            <input type="text" class="form-control" name="descProduk">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" id="">
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}">{{ $data->namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
