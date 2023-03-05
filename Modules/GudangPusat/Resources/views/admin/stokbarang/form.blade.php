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
        @if (isset($stokbarang))
            {!! Form::model($stokbarang, [
                'url' => ['admin/gudang-pusat/stok-barang/update-stok', $stokbarang->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/gudang-pusat/stok-barang', 'files' => true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($stokbarang) ? __('gudangpusat::stokbarang.stokbarang_add_new') : __('gudangpusat::stokbarang.stokbarang_add') }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($stokbarang) ? __('gudangpusat::stokbarang.add_card_title') : __('gudangpusat::stokbarang.stokbarang_add') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('admin.shared.flash')
                            <div class="form-group">
                                {!! Form::label('nama', __('gudangpusat::stokbarang.nama_barang_label')) !!}
                                {!! Form::text('nama', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('nama') ? ' is-invalid' : '') .
                                        (!$errors->has('nama') && old('nama') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangpusat::stokbarang.nama_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('kategori', __('gudangpusat::stokbarang.kategori_barang_label')) !!}
                                {!! Form::text('kategori', $stokbarang->kategori->nama, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('kategori') ? ' is-invalid' : '') .
                                        (!$errors->has('kategori') && old('kategori') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangpusat::stokbarang.kategori_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('harga', __('gudangpusat::stokbarang.harga_barang_label')) !!}
                                {!! Form::number('harga', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('harga') ? ' is-invalid' : '') .
                                        (!$errors->has('harga') && old('harga') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangpusat::stokbarang.harga_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('id_supplier', __('gudangpusat::cabang.manajer_cabang')) !!}
                                {!! Form::select(
                                    'id_supplier',
                                    $listSupplier,
                                    !empty($stokbarang->id_supplier) ? $stokbarang->id_supplier : old('id_supplier'),
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-- Pilih Supplier --',
                                    ],
                                ) !!}
                                @error('id_supplier')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('jumlah_stok', __('gudangpusat::stokbarang.jumlah_stok_label')) !!}
                                {!! Form::number('jumlah_stok', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('jumlah_stok') ? ' is-invalid' : '') .
                                        (!$errors->has('jumlah_stok') && old('jumlah_stok') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangpusat::stokbarang.jumlah_stok_label'),
                                ]) !!}
                                @error('jumlah_stok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('gudangpusat::stokbarang.btn_save_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
