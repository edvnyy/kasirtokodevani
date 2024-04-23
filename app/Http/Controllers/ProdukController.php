<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $produks = Produk::select('produks.*', 'kategoris.nama_kategori')
            ->join('kategoris', 'kategoris.id', 'produks.kategori_id')
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->when($search, function ($q) use ($search) {
                return $q->orWhere('kode_produk', 'like', "%{$search}%");
            })
            ->orderBy('produks.id')
            ->paginate();

        if ($search) {
            $produks->appends(['search' => $search]);
        }

        return view('produk.index', ['produks' => $produks]);
    }

    public function create()
    {
        $lastProduk = Produk::orderBy('id', 'desc')->first();
        $kodeProduk = $lastProduk ? ++$lastProduk->kode_produk : 'P001';

        $dataKategori = Kategori::orderBy('nama_kategori')->get();
        $kategoris = [['', 'Pilih Kategori:']];
        

        foreach ($dataKategori as $kategori) {
            $kategoris[] = [$kategori->id, $kategori->nama_kategori];
        }

        return view('produk.create', compact('kodeProduk', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => ['required', 'max:250', 'unique:produks'],
            'nama_produk' => ['required', 'max:150'],
            'harga' => ['required', 'numeric'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'diskon' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('store', 'success');
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'kode_produk' => ['required', 'max:250', 'unique:produks,kode_produk,' . $produk->id],
            'nama_produk' => ['required', 'max:150'],
            'harga' => ['required', 'numeric'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'diskon' => ['nullable', 'numeric', 'min:0', 'max:100'], // Validasi diskon
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')->with('update', 'success');
    }

    public function show(Produk $produk)
    {
        abort(404);
    }

    public function edit(Produk $produk)
    {
        $dataKategori = Kategori::orderBy('nama_kategori')->get();
        $kategoris = [['', 'Pilih Kategori:']];

        foreach ($dataKategori as $kategori) {
            $kategoris[] = [$kategori->id, $kategori->nama_kategori];
        }

        return view('produk.edit', ['produk' => $produk, 'kategoris' => $kategoris]);
    }


    public function destroy(Produk $produk)
    {
        $produk->delete();

        return back()->with('destroy', 'success');
    }
}
