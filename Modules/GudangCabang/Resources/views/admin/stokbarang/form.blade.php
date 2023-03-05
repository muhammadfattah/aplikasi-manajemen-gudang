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
        @if (isset($stokbarang))
            {!! Form::model($stokbarang, [
                'url' => ['admin/gudang-cabang/stok-barang', $stokbarang->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/gudang-cabang/stok-barang', 'files' => true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($stokbarang) ? __('gudangcabang::stokbarang.stokbarang_order_new') : __('gudangcabang::stokbarang.stokbarang_order') }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($stokbarang) ? __('gudangcabang::stokbarang.add_card_title') : __('gudangcabang::stokbarang.stokbarang_order') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('admin.shared.flash')
                            <div class="form-group">
                                {!! Form::label('nama', __('gudangcabang::stokbarang.nama_barang_label')) !!}
                                {!! Form::text('nama', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('nama') ? ' is-invalid' : '') .
                                        (!$errors->has('nama') && old('nama') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::stokbarang.nama_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('kategori', __('gudangcabang::stokbarang.kategori_barang_label')) !!}
                                {!! Form::text('kategori', $stokbarang->kategori->nama, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('kategori') ? ' is-invalid' : '') .
                                        (!$errors->has('kategori') && old('kategori') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::stokbarang.kategori_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('harga', __('gudangcabang::stokbarang.harga_barang_label')) !!}
                                {!! Form::number('harga', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('harga') ? ' is-invalid' : '') .
                                        (!$errors->has('harga') && old('harga') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::stokbarang.harga_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('jumlah_order', __('gudangcabang::stokbarang.jumlah_order_label')) !!}
                                {!! Form::number('jumlah_order', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('jumlah_order') ? ' is-invalid' : '') .
                                        (!$errors->has('jumlah_order') && old('jumlah_order') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::stokbarang.jumlah_order_label'),
                                ]) !!}
                                @error('jumlah_order')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('gudangcabang::stokbarang.btn_save_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
