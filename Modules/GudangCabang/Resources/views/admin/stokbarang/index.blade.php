@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangcabang::stokbarang.manage_stokbarangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-cabang/stok-barang') }}">@lang('gudangcabang::stokbarang.manage_stokbarangs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangcabang::stokbarang.stokbarang_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangcabang::stokbarang.manage_stokbarangs')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangcabang::admin.shared.flash')
                            @include('gudangcabang::admin.stokbarang._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangcabang::stokbarang.nama_barang_label')</th>
                                        <th>@lang('gudangcabang::stokbarang.kategori_barang_label')</th>
                                        <th>@lang('gudangcabang::stokbarang.harga_barang_label')</th>
                                        <th>@lang('gudangcabang::stokbarang.stok_barang_label')</th>
                                        <th>@lang('gudangcabang::stokbarang.updated_at_label')</th>
                                        @if (Gate::check('edit_gudang_cabang-stok_barang') || Gate::check('delete_gudang_cabang-stok_barang'))
                                            <th width="25%"><i class="fa fa-cogs"></i></th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @forelse ($stokbarangs as $stokbarang)
                                            <tr>
                                                <td>{{ $stokbarang->nama }}</td>
                                                <td>{{ $stokbarang->kategori->nama }}</td>
                                                <td>@format_rupiah($stokbarang->harga)</td>
                                                <td>{{ $stokbarang->stok->firstWhere('id_cabang', $id_cabang)->stok ?? 0 }}
                                                </td>
                                                <td>{{ $stokbarang->updated_at_formatted }}</td>
                                                @if (Gate::check('edit_gudang_cabang-stok_barang'))
                                                    <td class="text-nowrap">
                                                        @can('edit_gudang_cabang-stok_barang')
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ url('admin/gudang-cabang/stok-barang/' . $stokbarang->id . '/edit') }}"><i
                                                                    class="fas fa-plus"></i> @lang('gudangcabang::stokbarang.btn_order_label') </a>
                                                            <a class="btn btn-sm btn-danger"
                                                                href="{{ url('admin/gudang-cabang/stok-barang/' . $stokbarang->id . '/retur') }}"><i
                                                                    class="fas fa-minus"></i> Return Barang Ke Gudang Pusat </a>
                                                        @endcan
                                                    </td>
                                                @endif;
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="font-weight-bold">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $stokbarangs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
