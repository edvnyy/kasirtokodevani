<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pelanggans = Pelanggan::orderBy('id')
            ->when($search, function ($q) use ($search) {
                return $q->where('nama', 'like', "%{$search}%");
            })
            ->paginate();

        if ($search) {
            $pelanggans->appends(['search' => $search]);
        }

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => ['required', 'max:100'],
                'alamat' => ['nullable', 'max:500'],
                'nomor_tlp' => ['nullable', 'max:14']
            ]);

            Pelanggan::create($request->all());

            return redirect()->route('pelanggan.index')->with('store', 'success');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1406) { // Error code 1406: Data too long for column
                return redirect()->back()->withInput()->with('error', 'Alamat terlalu panjang.');
            }
            // Re-throw the exception if it's not the expected one
            throw $e;
        }
    }

    public function show(Pelanggan $pelanggan)
    {
        abort(404);
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => ['required', 'max:100'],
            'alamat' => ['nullable', 'max:500'],
            'nomor_tlp' => ['nullable', 'max:14']
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('update', 'success');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return back()->with('destroy', 'success');
    }
}
