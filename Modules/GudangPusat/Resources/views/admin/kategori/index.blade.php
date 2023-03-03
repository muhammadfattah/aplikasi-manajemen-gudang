@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangpusat::kategori.manage_kategoris')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-pusat/kategori-barang') }}">@lang('gudangpusat::kategori.manage_kategoris')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangpusat::kategori.kategori_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangpusat::kategori.manage_kategoris')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangpusat::admin.shared.flash')
                            @include('gudangpusat::admin.kategori._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangpusat::kategori.name_label')</th>
                                        <th>@lang('gudangpusat::kategori.updated_at_label')</th>
                                        <th width="25%"><i class="fa fa-cogs"></i></th>
                                    </thead>
                                    <tbody>
                                        @forelse ($kategoris as $kategori)
                                            <tr>
                                                <td>{{ $kategori->nama }}</td>
                                                <td>{{ $kategori->updated_at_formatted }}</td>
                                                <td>
                                                    @if ($kategori->trashed())
                                                        @can('delete_gudang_pusat-kategori_barang')
                                                            <a class="btn btn-sm btn-warning"
                                                                href="{{ url('admin/gudang-pusat/kategori-barang/' . $kategori->id . '/restore') }}"><i
                                                                    class="fa fa-sync-alt"></i> @lang('gudangpusat::kategori.btn_restore_label') </a>
                                                            <a href="{{ url('admin/gudang-pusat/kategori-barang/' . $kategori->id) }}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini secara permanen?')) {
                                                                document.getElementById('delete-role-{{ $kategori->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::kategori.btn_delete_permanent_label')
                                                            </a>
                                                            <form id="delete-role-{{ $kategori->id }}"
                                                                action="{{ url('admin/gudang-pusat/kategori-barang/' . $kategori->id) }}"
                                                                method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_permanent_delete" value="TRUE">
                                                                @csrf
                                                            </form>
                                                        @endcan
                                                    @else
                                                        @can('edit_gudang_pusat-kategori_barang')
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ url('admin/gudang-pusat/kategori-barang/' . $kategori->id . '/edit') }}"><i
                                                                    class="far fa-edit"></i> @lang('gudangpusat::kategori.btn_edit_label') </a>
                                                        @endcan
                                                        @can('delete_gudang_pusat-kategori_barang')
                                                            <a href="{{ url('admin/gudang-pusat/kategori-barang/' . $kategori->id) }}"
                                                                class="btn btn-sm btn-warning"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini?')) {
                                                                document.getElementById('delete-role-{{ $kategori->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::kategori.btn_delete_label')
                                                            </a>
                                                            <form id="delete-role-{{ $kategori->id }}"
                                                                action="{{ url('admin/gudang-pusat/kategori-barang/' . $kategori->id) }}"
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
                                                <td colspan="3" class="font-weight-bold">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $kategoris->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
