@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('outlet::returbarang.manage_returbarangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/outlet/retur-barang') }}">@lang('outlet::returbarang.manage_returbarangs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('outlet::returbarang.returbarang_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('outlet::returbarang.manage_returbarangs')</h4>
                        </div>
                        <div class="card-body">
                            @include('outlet::admin.shared.flash')
                            @include('outlet::admin.returbarang._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('outlet::returbarang.nama_barang_label')</th>
                                        <th>@lang('outlet::returbarang.kategori_barang_label')</th>
                                        <th>@lang('outlet::returbarang.harga_barang_label')</th>
                                        <th>@lang('outlet::returbarang.retur_barang_label')</th>
                                        <th>@lang('outlet::returbarang.status_retur_label')</th>
                                        <th>@lang('outlet::returbarang.updated_at_label')</th>
                                        @if (Gate::check('edit_outlet-retur_barang') || Gate::check('delete_outlet-retur_barang'))
                                            <th width="25%"><i class="fa fa-cogs"></i></th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @forelse ($returbarangs as $returbarang)
                                            <tr>
                                                <td>{{ $returbarang->barang->nama ?? '-' }}</td>
                                                <td>{{ $returbarang->barang->kategori->nama ?? '-' }}</td>
                                                <td>@format_rupiah($returbarang->barang->harga ?? 0)</td>
                                                <td>{{ $returbarang->jumlah ?? 0 }}</td>
                                                <td><span
                                                        class="badge badge-primary">{{ ucwords($returbarang->status) }}</span>
                                                </td>
                                                <td>{{ $returbarang->updated_at_formatted }}</td>
                                                <td>
                                                    @if ($returbarang->status == 'permintaan retur diterima')
                                                        @can('edit_outlet-retur_barang')
                                                            <a href="{{ url('admin/outlet/retur-barang/' . $returbarang->id) }}"
                                                                class="btn btn-sm btn-success"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Ingin mengkonfirmasi memproses retur ini?')) {
                                                                document.getElementById('delete-role-{{ $returbarang->id }}').submit();
                                                            }">
                                                                <i class="fas fa-check-circle"></i> Konfirmasi Untuk Memproses
                                                                Retur
                                                            </a>
                                                            <form id="delete-role-{{ $returbarang->id }}"
                                                                action="{{ url('admin/outlet/retur-barang/' . $returbarang->id) }}"
                                                                method="POST">
                                                                <input type="hidden" name="_method" value="PUT">
                                                                @csrf
                                                            </form>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="font-weight-bold">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $returbarangs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
