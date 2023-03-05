@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('outlet::transaksi.manage_transaksis')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/outlet/transaksi') }}">@lang('outlet::transaksi.manage_transaksis')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('outlet::transaksi.transaksi_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('outlet::transaksi.manage_transaksis')</h4>
                        </div>
                        <div class="card-body">
                            @include('outlet::admin.shared.flash')
                            @include('outlet::admin.transaksi._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('outlet::transaksi.nama_barang_label')</th>
                                        <th>@lang('outlet::transaksi.kategori_barang')</th>
                                        <th>@lang('outlet::transaksi.harga_barang_label')</th>
                                        <th>@lang('outlet::transaksi.jumlah_barang_label')</th>
                                        <th>@lang('outlet::transaksi.total_harga_label')</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($transaksis as $transaksi)
                                            <tr>
                                                <td>{{ $transaksi->barang->nama ?? '-' }}</td>
                                                <td>{{ $transaksi->barang->kategori->nama ?? '-' }}</td>
                                                <td>@format_rupiah($transaksi->barang->harga ?? 0) </td>
                                                <td>{{ $transaksi->jumlah }}</td>
                                                <td>@format_rupiah($transaksi->barang->harga * $transaksi->jumlah ?? 0) </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="font-weight-bold">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $transaksis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
