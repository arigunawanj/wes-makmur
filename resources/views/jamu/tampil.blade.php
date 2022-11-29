@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Rekomendasi Jamu</div>
                    <div class="card-body">
                        <form action="{{ route('jamu.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="">Keluhan</label>
                                <select name="keluhan" id="" class="form-select">
                                    <option value="keseleo">Keseleo</option>
                                    <option value="kurang nafsu makan">Kurang Nafsu Makan</option>
                                    <option value="pegal-pegal">Pegal-Pegal</option>
                                    <option value="darah tinggi">Darah Tinggi</option>
                                    <option value="gula darah">Gula Darah</option>
                                    <option value="kram perut">Kram Perut</option>
                                    <option value="masuk angin">Masuk Angin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Umur</label>
                                <select name="tahun" id="" class="form-select">
                                    <option selected>Pilih Tahun Lahir....</option>
                                    @for ($i = 1980; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Rekomendasi Jamu</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Isi Data</th>
                                    <th scope="col">Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data)
                                <tr>
                                    <th scope="row">Nama Jamu</th>
                                    <td>{{ $data['namajamu'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Khasiat</th>
                                    <td>{{ $data['khasiat'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Keluhan</th>
                                    <td>{{ $data['keluhan'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Umur</th>
                                    <td><span class="badge bg-primary">{{ $data['umur'] }} Tahun</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Saran Penggunaan</th>
                                    <td>{{ $data['saran'] }}</td>
                                </tr>
                                @endisset

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
