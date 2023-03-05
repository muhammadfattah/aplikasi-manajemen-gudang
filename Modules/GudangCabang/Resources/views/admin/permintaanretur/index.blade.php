@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangcabang::permintaanretur.manage_permintaanreturs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-cabang/permintaan-retur') }}">@lang('gudangcabang::permintaanretur.manage_permintaanreturs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangcabang::permintaanretur.permintaanretur_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangcabang::permintaanretur.manage_permintaanreturs')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangcabang::admin.shared.flash')
                            @include('gudangcabang::admin.permintaanretur._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangcabang::permintaanretur.nama_outlet_label')</th>
                                        <th>@lang('gudangcabang::permintaanretur.nama_retur_label')</th>
                                        <th>@lang('gudangcabang::permintaanretur.kategori_retur_label')</th>
                                        <th>@lang('gudangcabang::permintaanretur.harga_retur_label')</th>
                                        <th>@lang('gudangcabang::permintaanretur.permintaan_retur_label')</th>
                                        <th>@lang('gudangcabang::permintaanretur.status_retur_label')</th>
                                        <th>@lang('gudangcabang::permintaanretur.updated_at_label')</th>
                                        @if (Gate::check('edit_gudang_cabang-permintaan_retur') || Gate::check('delete_gudang_cabang-permintaan_retur'))
                                            <th width="25%"><i class="fa fa-cogs"></i></th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @forelse ($permintaanreturs as $permintaanretur)
                                            <tr>
                                                <td>{{ ($permintaanretur->cabang->nama ?? '') . ' - ' . ($permintaanretur->cabang->lokasi ?? '') }}
                                                </td>
                                                <td>{{ $permintaanretur->barang->nama ?? '-' }}</td>
                                                <td>{{ $permintaanretur->barang->kategori->nama ?? '-' }}</td>
                                                <td>@format_rupiah($permintaanretur->barang->harga ?? 0)</td>
                                                <td>{{ $permintaanretur->jumlah ?? 0 }}</td>
                                                <td><span
                                                        class="badge badge-primary">{{ ucwords($permintaanretur->status) }}</span>
                                                </td>
                                                <td>{{ $permintaanretur->updated_at_formatted }}</td>
                                                <td class="text-nowrap">
                                                    @can('edit_gudang_cabang-permintaan_retur')
                                                        @if ($permintaanretur->status == 'menunggu konfirmasi')
                                                            <a href="{{ url('admin/gudang-cabang/permintaan-retur/' . $permintaanretur->id . '?status=permintaan-retur-diterima') }}"
                                                                class="btn btn-sm btn-success"
                                                                onclick="
                                                            return (confirm('Ingin mengubah status retur ini?'))">
                                                                <i class="fas fa-check-circle"></i> Konfirmasi Permintaan Retur
                                                            </a>
                                                        @endif
                                                        @if ($permintaanretur->status == 'sedang dalam pengiriman')
                                                            <a href="{{ url('admin/gudang-cabang/permintaan-retur/' . $permintaanretur->id . '?status=selesai') }}"
                                                                class="btn btn-sm btn-success"
                                                                onclick="
                                                            return (confirm('Ingin mengubah status retur ini?'))">
                                                                <i class="fas fa-check-circle"></i> Konfirmasi Barang Retur
                                                                Telah Diterima
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
                            {{ $permintaanreturs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
