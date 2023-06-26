<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $nama = request('search');
            $Produk = Produk::where('nama', 'LIKE', '%'.$nama.'%')->paginate(5);
            $kategori = Kategori::all();
            return view('dashboard.product', compact('kategori', 'Produk'));
        } else {
            $Produk = Produk::orderBy('id', 'desc')->paginate(5);
            $kategori = Kategori::all();
            return view('dashboard.product', compact('kategori', 'Produk')); 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'komposisi' => 'required',
            'karbo' => 'required',
            'protein' => 'required',
            'kalori' => 'required',
            'serat' => 'required',
        ]);

        if ($request->file('gambar')) {
            $gambar = $request->file('gambar')->store('images', 'public');
        }

        $produk = new Produk;
        $produk->nama = $request->get('nama');
        $produk->gambar = $gambar;
        $produk->deskripsi = $request->get('deskripsi');
        $produk->harga = $request->get('harga');
        $produk->komposisi = $request->get('komposisi');
        $produk->karbo = $request->get('karbo');
        $produk->protein = $request->get('protein');
        $produk->kalori = $request->get('kalori');
        $produk->serat = $request->get('serat');
        $produk->hidden = "no";
        $produk->save();

        $kategoris = $request->get('kategoris');
        foreach ($kategoris as $kat) {
            $kats = Kategori::findOrFail($kat);
            $produk->kategori()->attach($kats->id);
            $kats->save();
        }
        return redirect()->route('product.index')->with('success', 'Produk telah ditambahkan');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'komposisi' => 'required',
            'karbo' => 'required',
            'protein' => 'required',
            'kalori' => 'required',
            'serat' => 'required',
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && file_exists(storage_path('app/public/' . $produk->gambar))) {
                Storage::delete('public/' . $produk->gambar);
            }
            $gambar = $request->file('gambar')->store('images', 'public');
            $produk->gambar = $gambar;
        } 

        $produk->nama = $request->get('nama');
        $produk->deskripsi = $request->get('deskripsi');
        $produk->harga = $request->get('harga');
        $produk->komposisi = $request->get('komposisi');
        $produk->karbo = $request->get('karbo');
        $produk->protein = $request->get('protein');
        $produk->kalori = $request->get('kalori');
        $produk->serat = $request->get('serat');
        $produk->save();

        $kategoris = $request->get('kategoris');
        $produk->kategori()->sync($kategoris);

        return redirect()->route('product.index')->with('success', 'Produk telah diupdate');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->kategori()->detach();
            $produk->delete();
            return redirect()->route('product.index')->with('success', 'Produk telah dihapus');
        } catch (\Exception $e) {
            return redirect()->route('product.index')->with('error', 'Gagal, produk berkaitan dengan suatu Keranjang');
        }
    }

    public function hidden($id){
        $produk = Produk::findOrFail($id);
        $produk->hidden = "yes";
        $produk->save();
        return redirect()->route('product.index')->with('success', 'Berhasil merubah produk');
    }

    public function visible($id){
        $produk = Produk::findOrFail($id);
        $produk->hidden = "no";
        $produk->save();
        return redirect()->route('product.index')->with('success', 'Berhasil merubah produk');
    }
}
