@extends('layouts.main', ['title' => 'stok'])
@section('title-content')
    <i class="fas fa-pallet mr-2"></i>
    Stok
@endsection

@section('content')
    @if (session('store') == 'success')
        <x-alert type="success">
            <strong>Berhasik dibuat!</strong> Stok berhasil dibuat.
        </x-alert>
    @endif
    @if (session('destroy') == 'success')
        <x-alert type="success">
            <strong>Berhasil dihapus!</strong> Stok berhasil dihapus.
        </x-alert>
    @endif

    <div class="card card-cyan card-outline">
        <div class="card-header form-inline">
            <a href="{{ route('stok.create') }}" class="btn btn-outline-primary">
                <i class="fas fa-plus mr-2"></i> Tambah
            </a>
            <form action="?" method="get" class="ml-auto">
                <div class="input-group">
                    <input type="date" class="form-control" name="search" value="<?= request()->search ?>"
                        placeholder="Tanggal">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Nama Suplier</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stoks as $key => $stok)
                        <tr>
                            <td>{{ $stoks->firstItem() + $key }}</td>
                            <td>{{ $stok->nama_produk }}</td>
                            <td>{{ $stok->jumlah }}</td>
                            <td>{{ $stok->nama_suplier }}</td>
                            <td>{{ $stok->tanggal }}</td>
                            <td class="text-right">
                                <button type="button" data-toggle="modal" data-target="#modalDelete{{ $stok->id }}"
                                    data-url="{{ route('stok.destroy', ['stok' => $stok->id]) }}"
                                    class="btn btn-xs text-danger p-0 btn-delete" id="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data stok yang sesuai dengan pencarian Anda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $stoks->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@push('modals')
    @foreach ($stoks as $stok)
        <div class="modal fade" id="modalDelete{{ $stok->id }}" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah yakin akan dihapus?</p>
                        <form action="{{ route('stok.destroy', ['stok' => $stok->id]) }}" method="post"
                            style="display: none;" id="formBatal{{ $stok->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-danger"
                            onclick="event.preventDefault(); document.getElementById('formBatal{{ $stok->id }}').submit();">
                            Ya, Hapus!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
