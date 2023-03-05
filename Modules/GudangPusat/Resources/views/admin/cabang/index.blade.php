@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangpusat::cabang.manage_cabangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/gudang-pusat/cabang') }}">@lang('gudangpusat::cabang.manage_cabangs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangpusat::cabang.cabang_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangpusat::cabang.manage_cabangs')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangpusat::admin.shared.flash')
                            @include('gudangpusat::admin.cabang._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangpusat::cabang.name_label')</th>
                                        <th>@lang('gudangpusat::cabang.manajer_cabang')</th>
                                        <th>@lang('gudangpusat::cabang.admin_cabang')</th>
                                        <th>@lang('gudangpusat::cabang.lokasi_label')</th>
                                        <th>@lang('gudangpusat::cabang.updated_at_label')</th>
                                        <th width="25%"><i class="fa fa-cogs"></i></th>
                                    </thead>
                                    <tbody>
                                        @forelse ($cabangs as $cabang)
                                            <tr>
                                                <td>{{ $cabang->nama }}</td>
                                                <td>{{ $cabang->manajer->name ?? '-' }}</td>
                                                <td>{{ $cabang->admin->name ?? '-' }}</td>
                                                <td>{{ $cabang->lokasi }}</td>
                                                <td>{{ $cabang->updated_at_formatted }}</td>
                                                <td>
                                                    @if ($cabang->trashed())
                                                        @can('delete_gudang_pusat-cabang')
                                                            <a class="btn btn-sm btn-warning"
                                                                href="{{ url('admin/gudang-pusat/cabang/' . $cabang->id . '/restore') }}"><i
                                                                    class="fa fa-sync-alt"></i> @lang('gudangpusat::cabang.btn_restore_label') </a>
                                                            <a href="{{ url('admin/gudang-pusat/cabang/' . $cabang->id) }}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini secara permanen?')) {
                                                                document.getElementById('delete-role-{{ $cabang->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::cabang.btn_delete_permanent_label')
                                                            </a>
                                                            <form id="delete-role-{{ $cabang->id }}"
                                                                action="{{ url('admin/gudang-pusat/cabang/' . $cabang->id) }}"
                                                                method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_permanent_delete" value="TRUE">
                                                                @csrf
                                                            </form>
                                                        @endcan
                                                    @else
                                                        @can('edit_gudang_pusat-cabang')
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ url('admin/gudang-pusat/cabang/' . $cabang->id . '/edit') }}"><i
                                                                    class="far fa-edit"></i> @lang('gudangpusat::cabang.btn_edit_label') </a>
                                                        @endcan
                                                        @can('delete_gudang_pusat-cabang')
                                                            <a href="{{ url('admin/gudang-pusat/cabang/' . $cabang->id) }}"
                                                                class="btn btn-sm btn-warning"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Yakin ingin menghapus data ini?')) {
                                                                document.getElementById('delete-role-{{ $cabang->id }}').submit();
                                                            }">
                                                                <i class="far fa-trash-alt"></i> @lang('gudangpusat::cabang.btn_delete_label')
                                                            </a>
                                                            <form id="delete-role-{{ $cabang->id }}"
                                                                action="{{ url('admin/gudang-pusat/cabang/' . $cabang->id) }}"
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
                            {{ $cabangs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
