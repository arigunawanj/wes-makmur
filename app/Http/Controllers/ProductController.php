<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menampilkan isi data dari Database Product
        $product = Product::all();

        // Menampilkan isi data dari Database Category
        $category = Category::all();

        // Pindah ke halaman dan membawa data dari variabel product dan category
        return view('barang.tampil', compact('product', 'category'));
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
        // Memvalidasi Data sebelum disimpan
        $data = $request->validate([
            'namaProduk' => 'required',
            'descProduk' => 'required',
            'harga' => 'required',
            'foto' => 'required|mimes:png,jpg',
            'category_id' => 'required',
        ]);

        // Menyimpan File Foto ke Dalam Folder Storage->img
        $file = $request->file('foto')->store('img');

        // Merubah isi penyimpanan Foto dari variabel File
        $data['foto'] = $file;

        // Menyimpan seluruh value Data Produk kedalam Database
        Product::create($data);

        // Setelah selesai menyimpan akan dialihkan ke halaman Product
        return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $isi = $request->all();
        
        // Jika File Foto sudah ada dan ingin diganti
        if ($request->hasFile('foto')) {
            
            // Maka Data yang baru akan disimpan ke dalam folder Img
            $file = $request->file('foto')->store('img');

            // Data yang sebelumnya akan dihapus di dalam folder Img
            Storage::delete($product->foto);

            $isi['foto'] = $file;

            // Setelah itu akan dilakukan update data
            $product->update($isi);

        } else {

            // Jika tidak ingin ada perubahan foto maka foto tidak perlu diupdate
            $product->update([
                'namaProduk' => $request->namaProduk,
                'descProduk' => $request->descProduk,
                'harga' => $request->harga,
                'category_id' => $request->category_id,
            ]);
        }

        // Jika Selesai melakukan perubahan data maka akan dialihkan ke halaman Product
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Menghapus foto di dalam Folder
        Storage::delete($product->foto);

        // Menghapus Data dari Tabel Product
        $product->delete();

        // Setelah melakukan hapus data maka dialihkan ke halaman product
        return redirect('product');
    }

    public function hide($id)
    {
        // Mencari ID dalam Tabel Product
        $product = Product::findorFail($id);

        // Jika Dalam database tampilBarang bernilai 1 maka akan diganti ke 0
        if($product->tampilBarang == 1){
            $product->update([
                'tampilBarang' => 0
            ]);
        } else {
            $product->update([
                'tampilBarang' => 1
            ]);
        }

        // Jika sudah akan dialihkan ke halaman Product
        return redirect('product');
    }
}
