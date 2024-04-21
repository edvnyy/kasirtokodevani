@extends('layouts.main', ['title' => 'Pelanggan'])

@section('title-content')
    <i class="fas fa-users mr-2"></i>
    Pelanggan
@endsection

@section('content')
    @if (session('store') == 'success')
        <x-alert type="success">
            <strong>Berhasil dibuat!</strong> Pelanggan berhasil dibuat.
        </x-alert>
    @endif

    @if (session('update') == 'success')
        <x-alert type="success">
            <strong>Berhasil diupdate!</strong> Pelanggan berhasil diupdate.
        </x-alert>
    @endif

    @if (session('destroy') == 'success')
        <x-alert type="success">
            <strong>Berhasil dihapus!</strong> Pelanggan berhasil dihapus.
        </x-alert>
    @endif

    <div class="card card-cyan card-outline">
        <div class="card-header form-inline">
            <a href="{{ route('pelanggan.create') }}" class="btn btn-outline-primary">
                <i class="fas fa-plus mr-2"></i> Tambah
            </a>
            <form action="{{ route('pelanggan.index') }}" method="get" class="input-group ml-auto">
                <input type="text" class="form-control" name="search" value="{{ request()->search }}"
                    placeholder="Nama">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="card-body p-8">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nomor Tlp</th>
                        <th>Alamat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $key => $pelanggan)
                        <tr>
                            <td>{{ $pelanggans->firstItem() + $key }}</td>
                            <td>{{ $pelanggan->nama }}</td>
                            <td>{{ $pelanggan->nomor_tlp }}</td>
                            <td>{{ $pelanggan->alamat }}</td>
                            <td class="text-right">
                                <a href="{{ route('pelanggan.edit', ['pelanggan' => $pelanggan->id]) }}"
                                    class="btn btn-xs text-success p-8 mr-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" data-toggle="modal" data-target="#modalDelete{{ $pelanggan->id }}"
                                    data-url="{{ route('pelanggan.destroy', ['pelanggan' => $pelanggan->id]) }}"
                                    class="btn btn-xs text-danger p-0 btn-delete" id="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data pelanggan yang sesuai dengan pencarian Anda.</td>
                        </tr>
                    @endforelse                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $pelanggans->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection


@push('modals')
    @foreach ($pelanggans as $pelanggan)
        <div class="modal fade" id="modalDelete{{ $pelanggan->id }}" tabindex="-1">
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
                        <form action="{{ route('pelanggan.destroy', ['pelanggan' => $pelanggan->id]) }}" method="post"
                            style="display: none;" id="formBatal{{ $pelanggan->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-danger"
                            onclick="event.preventDefault(); document.getElementById('formBatal{{ $pelanggan->id }}').submit();">
                            Ya, Hapus!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
