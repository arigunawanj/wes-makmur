<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Masuk ke Halaman Jamu
        return view('jamu.tampil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Mengambil class Inheritance dan mendeklar Constructnya
        $hasil = new Saran($request->tahun, $request->keluhan);

        // Deklarasi variabel
        $keluhan = $request->keluhan;
        $NamaJamu = $hasil->namaJamu();
        $khasiat = $hasil->khasiat();
        $umur = $hasil->tahunLahir();
        $saran = $hasil->disarankan();

        // Menyimpan Data dari hasil deklarasi Variabel
        $data = [
            'keluhan' => $keluhan,
            'namajamu' => $NamaJamu,
            'khasiat' => $khasiat,
            'umur' => $umur,
            'saran' => $saran,
        ];

        return view('jamu.tampil', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

class Jamu {

    public function __construct($tahun, $keluhan)
    {
        // Fungsi Construct berisikan 2 Data yaitu tahun dan keluhan
        $this->tahun = $tahun;
        $this->keluhan = $keluhan;
    }

    public function namaJamu()
    {

        // Nama Jamu didapatkan dari construct keluhan
        if($this->keluhan == 'keseleo' || $this->keluhan == 'kurang nafsu makan'){
            return 'Beras Kencur';
        } else if ($this->keluhan == 'darah tinggi' || $this->keluhan == 'gula darah'){
            return 'Brotowali';
        } else if ($this->keluhan == 'kram perut' || $this->keluhan == 'masuk angin'){
            return 'Temulawak';
        } else if ($this->keluhan == 'pegal-pegal'){
            return 'Kunyit Asam';
        } else {
            return 'Silahkan Pilih Keluhannya';
        }
    }

    public function tahunLahir()
    {
        // Hasil Tahun didapatkan dari pengurangan 2022 - tahun yang diisi
        return 2022 - $this->tahun;
    }

    public function khasiat()
    {
        // Khasiat didapatkan dari Fungsi Nama Jamu
        if($this->namaJamu() == 'Beras Kencur'){
            return 'Meningkatkan nafsu makan';
        } else if ($this->namaJamu() == 'Brotowali'){
            return 'Menurunkan kadar gula darah';
        } else if ($this->namaJamu() == 'Temulawak'){
            return 'Meningkatkan Daya Tahan Tubuh';
        } else if ($this->namaJamu() == 'Kunyit Asam'){
            return 'Mencegah dan Mengurangi Risiko Kanker';
        } else {
            return 'Silahkan diisi Nama Jamunya';
        }
    }

}

class Saran extends Jamu {

    public function disarankan()
    {
        // Saran diambil dari Tahun Lahir, Nama Jamu dan Keluhan
        if($this->tahunLahir() <= 10 && $this->namaJamu() == 'Beras Kencur' && $this->keluhan == 'keseleo'){
            return 'Dikonsumsi 1x dan Harus dioleskan';
        } else {
            return 'Dikonsumsi 2x dan Harus dikosumsi';
        }
    }
}
