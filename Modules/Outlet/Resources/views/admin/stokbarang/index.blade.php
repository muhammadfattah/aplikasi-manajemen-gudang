@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('outlet::stokbarang.manage_stokbarangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/outlet/stok-barang') }}">@lang('outlet::stokbarang.manage_stokbarangs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('outlet::stokbarang.stokbarang_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('outlet::stokbarang.manage_stokbarangs')</h4>
                        </div>
                        <div class="card-body">
                            @include('outlet::admin.shared.flash')
                            @include('outlet::admin.stokbarang._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('outlet::stokbarang.nama_barang_label')</th>
                                        <th>@lang('outlet::stokbarang.kategori_barang_label')</th>
                                        <th>@lang('outlet::stokbarang.harga_barang_label')</th>
                                        <th>@lang('outlet::stokbarang.stok_barang_label')</th>
                                        <th>@lang('outlet::stokbarang.updated_at_label')</th>
                                        @if (Gate::check('edit_outlet-stok_barang') || Gate::check('delete_outlet-stok_barang'))
                                            <th width="25%"><i class="fa fa-cogs"></i></th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @forelse ($stokbarangs as $stokbarang)
                                            <tr>
                                                <td>{{ $stokbarang->nama }}</td>
                                                <td>{{ $stokbarang->kategori->nama }}</td>
                                                <td>@format_rupiah($stokbarang->harga)</td>
                                                <td>{{ $stokbarang->stok->firstWhere('id_outlet', $id_outlet)->stok ?? 0 }}
                                                <td>{{ $stokbarang->updated_at_formatted }}</td>
                                                @if (Gate::check('edit_outlet-stok_barang'))
                                                    <td class="text-nowrap">
                                                        @can('edit_outlet-stok_barang')
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ url('admin/outlet/stok-barang/' . $stokbarang->id . '/edit') }}"><i
                                                                    class="fas fa-plus"></i> Order Barang Ke Gudang Cabang </a>
                                                            <a class="btn btn-sm btn-danger"
                                                                href="{{ url('admin/outlet/stok-barang/' . $stokbarang->id . '/retur') }}"><i
                                                                    class="fas fa-minus"></i> Return Barang Ke Gudang Cabang
                                                            </a>
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
