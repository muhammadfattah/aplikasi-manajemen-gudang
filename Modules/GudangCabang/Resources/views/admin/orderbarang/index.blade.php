@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangcabang::orderbarang.manage_orderbarangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-cabang/order-barang') }}">@lang('gudangcabang::orderbarang.manage_orderbarangs')</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">@lang('gudangcabang::orderbarang.orderbarang_list')</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@lang('gudangcabang::orderbarang.manage_orderbarangs')</h4>
                        </div>
                        <div class="card-body">
                            @include('gudangcabang::admin.shared.flash')
                            @include('gudangcabang::admin.orderbarang._filter')
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <th>@lang('gudangcabang::orderbarang.nama_barang_label')</th>
                                        <th>@lang('gudangcabang::orderbarang.kategori_barang_label')</th>
                                        <th>@lang('gudangcabang::orderbarang.harga_barang_label')</th>
                                        <th>@lang('gudangcabang::orderbarang.order_barang_label')</th>
                                        <th>@lang('gudangcabang::orderbarang.status_order_label')</th>
                                        <th>@lang('gudangcabang::orderbarang.updated_at_label')</th>
                                        @if (Gate::check('edit_gudang_cabang-order_barang') || Gate::check('delete_gudang_cabang-order_barang'))
                                            <th width="25%"><i class="fa fa-cogs"></i></th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @forelse ($orderbarangs as $orderbarang)
                                            <tr>
                                                <td>{{ $orderbarang->barang->nama ?? '-' }}</td>
                                                <td>{{ $orderbarang->barang->kategori->nama ?? '-' }}</td>
                                                <td>@format_rupiah($orderbarang->barang->harga ?? 0)</td>
                                                <td>{{ $orderbarang->jumlah ?? 0 }}</td>
                                                <td><span
                                                        class="badge badge-primary">{{ ucwords($orderbarang->status) }}</span>
                                                </td>
                                                <td>{{ $orderbarang->updated_at_formatted }}</td>
                                                <td>
                                                    @if ($orderbarang->status == 'sedang dalam pengiriman')
                                                        @can('edit_gudang_cabang-order_barang')
                                                            <a href="{{ url('admin/gudang-cabang/order-barang/' . $orderbarang->id) }}"
                                                                class="btn btn-sm btn-success"
                                                                onclick="
                                                            event.preventDefault();
                                                            if (confirm('Ingin mengkonfirmasi orderan ini?')) {
                                                                document.getElementById('delete-role-{{ $orderbarang->id }}').submit();
                                                            }">
                                                                <i class="fas fa-check-circle"></i> @lang('gudangcabang::orderbarang.btn_konfirmasi_label')
                                                            </a>
                                                            <form id="delete-role-{{ $orderbarang->id }}"
                                                                action="{{ url('admin/gudang-cabang/order-barang/' . $orderbarang->id) }}"
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
                            {{ $orderbarangs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
