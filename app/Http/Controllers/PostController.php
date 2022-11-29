<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil Seluruh Data yang ada di Tabel Post
        $post = Post::all();

        // Mengambil Seluruh Data yang ada di Tabel Category
        $category = Category::all();

        // Setelah mengambil data dari variabel, data akan dikirim ke halaman post
        return view('post.tampil', compact('post', 'category'));
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
        // Mengambil Seluruh value yang ada didalam form
        $data = $request->all();

        // Merubah isi data user ID menjadi Id User yang login saja
        $data['user_id'] = Auth::user()->id;

        // Setelah itu data akan disimpan
        Post::create($data);

        // Setelah berhasil menyimpan, akan dialihkan ke halaman Post kembali
        return redirect('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Mengupdate isi data dari Tabel Post
        $post->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggalDibuat' => $request->tanggalDibuat,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id
        ]);

        // Setelah Selesai update data akan dialihkan ke halaman post
        return redirect('post');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Menghapus data dari tambel Post
        $post->delete();

        // Jika berhasil akan dialihkan ke halaman Post
        return redirect('post');
    }

    public function hide($id)
    {
        // Mencari ID dalam Tabel Post
        $post = Post::findorFail($id);

        // Jika Dalam database tampilPost bernilai 1 maka akan diganti ke 0
        if($post->tampilPost == 1){
            $post->update([
                'tampilPost' => 0
            ]);
        } else {
            $post->update([
                'tampilPost' => 1
            ]);
        }

        // Jika sudah akan dialihkan ke halaman Post
        return redirect('post');
    }
}
