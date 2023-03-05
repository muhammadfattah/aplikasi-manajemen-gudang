@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangcabang::permintaanbarang.manage_permintaanbarangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-cabang/permintaan-order') }}">@lang('gudangcabang::permintaanbarang.manage_permintaanbarangs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangcabang::permintaanbarang.permintaanbarang_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangcabang::permintaanbarang.manage_permintaanbarangs')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangcabang::admin.shared.flash')
                            @include('gudangcabang::admin.permintaanbarang._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangcabang::permintaanbarang.nama_outlet_label')</th>
                                        <th>@lang('gudangcabang::permintaanbarang.nama_barang_label')</th>
                                        <th>@lang('gudangcabang::permintaanbarang.kategori_barang_label')</th>
                                        <th>@lang('gudangcabang::permintaanbarang.harga_barang_label')</th>
                                        <th>@lang('gudangcabang::permintaanbarang.permintaan_order_label')</th>
                                        <th>@lang('gudangcabang::permintaanbarang.status_order_label')</th>
                                        <th>@lang('gudangcabang::permintaanbarang.updated_at_label')</th>
                                        @if (Gate::check('edit_gudang_cabang-permintaan_order') || Gate::check('delete_gudang_cabang-permintaan_order'))
                                            <th width="25%"><i class="fa fa-cogs"></i></th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @forelse ($permintaanbarangs as $permintaanbarang)
                                            <tr>
                                                <td>{{ ($permintaanbarang->cabang->nama ?? '') . ' - ' . ($permintaanbarang->cabang->lokasi ?? '') }}
                                                </td>
                                                <td>{{ $permintaanbarang->barang->nama ?? '-' }}</td>
                                                <td>{{ $permintaanbarang->barang->kategori->nama ?? '-' }}</td>
                                                <td>@format_rupiah($permintaanbarang->barang->harga ?? 0)</td>
                                                <td>{{ $permintaanbarang->jumlah ?? 0 }}</td>
                                                <td><span
                                                        class="badge badge-primary">{{ ucwords($permintaanbarang->status) }}</span>
                                                </td>
                                                <td>{{ $permintaanbarang->updated_at_formatted }}</td>
                                                <td class="text-nowrap">
                                                    @can('edit_gudang_cabang-permintaan_order')
                                                        @if ($permintaanbarang->status == 'menunggu konfirmasi' || $permintaanbarang->status == 'order dipending')
                                                            <a href="{{ url('admin/gudang-cabang/permintaan-order/' . $permintaanbarang->id . '?status=sedang-diproses') }}"
                                                                class="btn btn-sm btn-success"
                                                                onclick="
                                                            return (confirm('Ingin mengubah status orderan ini?'))">
                                                                <i class="fas fa-check-circle"></i> Konfirmasi Order Untuk
                                                                Diproses
                                                            </a>
                                                        @endif
                                                        @if ($permintaanbarang->status == 'sedang diproses')
                                                            <a href="{{ url('admin/gudang-cabang/permintaan-order/' . $permintaanbarang->id . '?status=sedang-dalam-pengiriman') }}"
                                                                class="btn btn-sm btn-success"
                                                                onclick="
                                                            return (confirm('Ingin mengubah status orderan ini?'))">
                                                                <i class="fas fa-check-circle"></i> Konfirmasi Order Sedang
                                                                Dikirim
                                                            </a>
                                                        @endif
                                                        @if ($permintaanbarang->status == 'menunggu konfirmasi')
                                                            <a href="{{ url('admin/gudang-cabang/permintaan-order/' . $permintaanbarang->id . '?status=order-dipending') }}"
                                                                class="btn btn-sm btn-primary"
                                                                onclick="
                                                            return (confirm('Ingin mengubah status orderan ini?'))">
                                                                <i class="fas fa-check-circle"></i> Konfirmasi Order Untuk
                                                                Dipending
                                                            </a>
                                                        @endif
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="font-weight-bold">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $permintaanbarangs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
