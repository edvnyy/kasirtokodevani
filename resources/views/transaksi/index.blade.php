@extends('layouts.main', ['title' => 'Transaksi'])
@section('title-content')
    <i class="fas fa-cash-register mr-2"></i>
    Transaksi
@endsection
@section('content')
    @if (session('store') == 'success')
        <x-alert type="success">
            <strong>Berhasil dibuat!</strong> Transaksi berhasil dibuat.
        </x-alert>
    @endif

    <div class="card card-cyan card-outline">
        <div class="card-header form-inline">
            <a href="{{ route('transaksi.create') }}" class="btn btn-outline-primary">
                <i class="fas fa-plus mr-2"></i>Buat Transaksi Baru
            </a>
            <form action="{{ route('transaksi.index') }}" method="get" class="ml-auto">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" value="<?= request()->search ?>"
                        placeholder="Nomor Transaksi">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nomor Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Kasir</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penjualans as $key => $penjualan)
                    <tr>
                        <td>{{ $penjualans->firstItem() + $key }}</td>
                        <td>{{ str_replace('-', '', $penjualan->nomor_transaksi) }}</td>
                        <td>{{ $penjualan->nama_pelanggan }}</td>
                        <td>{{ $penjualan->nama_kasir }}</td>
                        <td>{{ $penjualan->total }}</td>
                        <td>
                            <i
                                class="fas {{ $penjualan->status == 'selesai' ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($penjualan->tanggal)) }}</td>
                        <td class="text-right">
                            <a href="{{ route('transaksi.show', [
                                'transaksi' => $penjualan->id,
                            ]) }}"
                                class="btn btn-xs btn-success">
                                <i class="fas fa-file-invoice mr-1"></i> Invoice
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Tidak ada data nomor transaksi yang sesuai dengan pencarian Anda.</td>
                    </tr>
                @endforelse            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $penjualans->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
