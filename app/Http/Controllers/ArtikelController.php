<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
 public function index(Request $request)
    {
        // Tidak perlu lagi query data di sini, karena Livewire HomeArticle akan melakukannya
        return view('discover-maja.Artikel.awalartikel');
    }

    // Metode destroy tetap dihapus
    public function destroy($id)
    {
        $artikel = Article::findOrFail($id); // Menggunakan findOrFail agar otomatis 404 jika tidak ada

        // Hapus file gambar terkait jika ada (sesuaikan logika jika Anda punya upload gambar artikel)
        if ($artikel->image && file_exists(public_path('uploads/' . $artikel->image))) {
            unlink(public_path('uploads/' . $artikel->image));
        }

        $artikel->delete(); // Menghapus data menggunakan Eloquent

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }


    
    public function show($id)
    {
        $article = DB::table('news')->where('id', $id)->first();

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan.');
        }

        return view('discover-maja.Artikel.detailartikel', compact('article'));
    }

    public function showUser($id)
{
    $article = Article::findOrFail($id);
    return view('discover-maja-user.Artikel.detailartikeluser', compact('article'));
}


    public function create()
    {
        return view('discover-maja.Artikel.tambahartikel');
    }

     // Simpan artikel dari form tambah
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'author' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
        }

        DB::table('news')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'nama_author' => $request->author,
            'category' => $request->category,
            'image' => $filename,
            'created_at' => now()
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $article = DB::table('news')->where('id', $id)->first();
        
        if (!$article) {
            abort(404, 'Artikel tidak ditemukan.');
        }

        return view('discover-maja.Artikel.editartikel', compact('article'));
    }


public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'category' => 'required|string|max:100',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Ambil data lama
    $article = DB::table('news')->where('id', $id)->first();
    $filename = $article->image;

    // Jika upload gambar baru
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
    }

    // Update data
    DB::table('news')->where('id', $id)->update([
        'title' => $request->title,
        'content' => $request->content,
        'category' => $request->category,
        'image' => $filename,
    ]);

    return redirect()->route('artikel.show', $id)->with('success', 'Artikel berhasil diperbarui!');
}
    
}
