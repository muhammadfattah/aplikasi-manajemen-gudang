@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangpusat::supplier.manage_suppliers')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/gudang-pusat/supplier') }}">@lang('gudangpusat::supplier.manage_suppliers')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangpusat::supplier.supplier_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangpusat::supplier.manage_suppliers')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangpusat::admin.shared.flash')
                            @include('gudangpusat::admin.supplier._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangpusat::supplier.name_label')</th>
                                        <th>@lang('gudangpusat::supplier.updated_at_label')</th>
                                        <th width="25%"><i class="fa fa-cogs"></i></th>
                                    </thead>
                                    <tbody>
                                        @forelse ($suppliers as $supplier)
                                            <tr>
                                                <td>{{ $supplier->nama }}</td>
                                                <td>{{ $supplier->updated_at_formatted }}</td>
                                                <td>
                                                    @if ($supplier->trashed())
                                                        @can('delete_gudang_pusat-supplier')
                                                            <a class="btn btn-sm btn-warning"
                                                                href="{{ url('admin/gudang-pusat/supplier/' . $supplier->id . '/restore') }}"><i
                                                                    class="fa fa-sync-alt"></i> @lang('gudangpusat::supplier.btn_restore_label') </a>
                                                            <a href="{{ url('admin/gudang-pusat/supplier/' . $supplier->id) }}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini secara permanen?')) {
                                                                document.getElementById('delete-role-{{ $supplier->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::supplier.btn_delete_permanent_label')
                                                            </a>
                                                            <form id="delete-role-{{ $supplier->id }}"
                                                                action="{{ url('admin/gudang-pusat/supplier/' . $supplier->id) }}"
                                                                method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_permanent_delete" value="TRUE">
                                                                @csrf
                                                            </form>
                                                        @endcan
                                                    @else
                                                        @can('edit_gudang_pusat-supplier')
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ url('admin/gudang-pusat/supplier/' . $supplier->id . '/edit') }}"><i
                                                                    class="far fa-edit"></i> @lang('gudangpusat::supplier.btn_edit_label') </a>
                                                        @endcan
                                                        @can('delete_gudang_pusat-supplier')
                                                            <a href="{{ url('admin/gudang-pusat/supplier/' . $supplier->id) }}"
                                                                class="btn btn-sm btn-warning"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini?')) {
                                                                document.getElementById('delete-role-{{ $supplier->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::supplier.btn_delete_label')
                                                            </a>
                                                            <form id="delete-role-{{ $supplier->id }}"
                                                                action="{{ url('admin/gudang-pusat/supplier/' . $supplier->id) }}"
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
                            {{ $suppliers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
