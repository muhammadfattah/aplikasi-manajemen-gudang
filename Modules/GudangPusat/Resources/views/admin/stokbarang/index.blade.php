@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangpusat::stokbarang.manage_stokbarangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-pusat/stok-barang') }}">@lang('gudangpusat::stokbarang.manage_stokbarangs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangpusat::stokbarang.stokbarang_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangpusat::stokbarang.manage_stokbarangs')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangpusat::admin.shared.flash')
                            @include('gudangpusat::admin.stokbarang._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangpusat::stokbarang.nama_barang_label')</th>
                                        <th>@lang('gudangpusat::stokbarang.kategori_barang_label')</th>
                                        <th>@lang('gudangpusat::stokbarang.harga_barang_label')</th>
                                        <th>@lang('gudangpusat::stokbarang.stok_barang_label')</th>
                                        <th>@lang('gudangpusat::stokbarang.updated_at_label')</th>
                                        <th width="25%"><i class="fa fa-cogs"></i></th>
                                    </thead>
                                    <tbody>
                                        @forelse ($stokbarangs as $stokbarang)
                                            <tr>
                                                <td>{{ $stokbarang->nama }}</td>
                                                <td>{{ $stokbarang->kategori->nama ?? '-' }}</td>
                                                <td>@format_rupiah($stokbarang->harga)</td>
                                                <td>{{ $stokbarang->stok->stok ?? 0 }}</td>
                                                <td>{{ $stokbarang->updated_at_formatted }}</td>
                                                <td class="text-nowrap">
                                                    @if ($stokbarang->trashed())
                                                        @can('delete_gudang_pusat-stok_barang')
                                                            <a class="btn btn-sm btn-warning"
                                                                href="{{ url('admin/gudang-pusat/stok-barang/' . $stokbarang->id . '/restore') }}"><i
                                                                    class="fa fa-sync-alt"></i> @lang('gudangpusat::stokbarang.btn_restore_label') </a>
                                                            <a href="{{ url('admin/gudang-pusat/stok-barang/' . $stokbarang->id) }}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini secara permanen?')) {
                                                                document.getElementById('delete-role-{{ $stokbarang->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::stokbarang.btn_delete_permanent_label')
                                                            </a>
                                                            <form id="delete-role-{{ $stokbarang->id }}"
                                                                action="{{ url('admin/gudang-pusat/stok-barang/' . $stokbarang->id) }}"
                                                                method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_permanent_delete" value="TRUE">
                                                                @csrf
                                                            </form>
                                                        @endcan
                                                    @else
                                                        @can('edit_gudang_pusat-stok_barang')
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ url('admin/gudang-pusat/stok-barang/' . $stokbarang->id . '/tambah-stok') }}"><i
                                                                    class="fas fa-plus"></i> @lang('gudangpusat::stokbarang.btn_tambah_stok_label') </a>
                                                        @endcan
                                                        @can('edit_gudang_pusat-stok_barang')
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ url('admin/gudang-pusat/stok-barang/' . $stokbarang->id . '/edit') }}"><i
                                                                    class="far fa-edit"></i> @lang('gudangpusat::stokbarang.btn_edit_label') </a>
                                                        @endcan
                                                        @can('delete_gudang_pusat-stok_barang')
                                                            <a href="{{ url('admin/gudang-pusat/stok-barang/' . $stokbarang->id) }}"
                                                                class="btn btn-sm btn-warning"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini?')) {
                                                                document.getElementById('delete-role-{{ $stokbarang->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::stokbarang.btn_delete_label')
                                                            </a>
                                                            <form id="delete-role-{{ $stokbarang->id }}"
                                                                action="{{ url('admin/gudang-pusat/stok-barang/' . $stokbarang->id) }}"
                                                                method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                @csrf
                                                            </form>
                                                        @endcan
                                                    @endif
                                                </td>
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
