@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangcabang::returbarang.manage_returbarangs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-cabang/retur-barang') }}">@lang('gudangcabang::returbarang.manage_returbarangs')</a>
                </div>
            </div>
        </div>
        @if (isset($returbarang))
            {!! Form::model($returbarang, [
                'url' => ['admin/gudang-cabang/retur-barang', $returbarang->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/gudang-cabang/retur-barang', 'files' => true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($returbarang) ? __('gudangcabang::returbarang.returbarang_retur_new') : __('gudangcabang::returbarang.returbarang_retur') }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($returbarang) ? __('gudangcabang::returbarang.add_card_title') : __('gudangcabang::returbarang.returbarang_retur') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('admin.shared.flash')
                            <div class="form-group">
                                {!! Form::label('nama', __('gudangcabang::returbarang.nama_barang_label')) !!}
                                {!! Form::text('nama', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('nama') ? ' is-invalid' : '') .
                                        (!$errors->has('nama') && old('nama') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::returbarang.nama_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('kategori', __('gudangcabang::returbarang.kategori_barang_label')) !!}
                                {!! Form::text('kategori', $returbarang->kategori->nama, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('kategori') ? ' is-invalid' : '') .
                                        (!$errors->has('kategori') && old('kategori') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::returbarang.kategori_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('harga', __('gudangcabang::returbarang.harga_barang_label')) !!}
                                {!! Form::number('harga', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('harga') ? ' is-invalid' : '') .
                                        (!$errors->has('harga') && old('harga') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::returbarang.harga_barang_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('jumlah_retur', __('gudangcabang::returbarang.jumlah_retur_label')) !!}
                                {!! Form::number('jumlah_retur', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('jumlah_retur') ? ' is-invalid' : '') .
                                        (!$errors->has('jumlah_retur') && old('jumlah_retur') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::returbarang.jumlah_retur_label'),
                                ]) !!}
                                @error('jumlah_retur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('gudangcabang::returbarang.btn_save_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
