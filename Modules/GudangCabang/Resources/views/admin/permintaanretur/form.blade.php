@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangcabang::permintaanretur.manage_permintaanreturs')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a
                        href="{{ url('admin/gudang-cabang/permintaan-retur') }}">@lang('gudangcabang::permintaanretur.manage_permintaanreturs')</a>
                </div>
            </div>
        </div>
        @if (isset($permintaanretur))
            {!! Form::model($permintaanretur, [
                'url' => ['admin/gudang-cabang/permintaan-retur', $permintaanretur->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/gudang-cabang/permintaan-retur', 'files' => true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($permintaanretur) ? __('gudangcabang::permintaanretur.permintaanretur_permintaan_new') : __('gudangcabang::permintaanretur.permintaanretur_permintaan') }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($permintaanretur) ? __('gudangcabang::permintaanretur.add_card_title') : __('gudangcabang::permintaanretur.permintaanretur_permintaan') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('admin.shared.flash')
                            <div class="form-group">
                                {!! Form::label('nama', __('gudangcabang::permintaanretur.nama_retur_label')) !!}
                                {!! Form::text('nama', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('nama') ? ' is-invalid' : '') .
                                        (!$errors->has('nama') && old('nama') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::permintaanretur.nama_retur_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('kategori', __('gudangcabang::permintaanretur.kategori_retur_label')) !!}
                                {!! Form::text('kategori', $permintaanretur->kategori->nama, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('kategori') ? ' is-invalid' : '') .
                                        (!$errors->has('kategori') && old('kategori') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::permintaanretur.kategori_retur_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('harga', __('gudangcabang::permintaanretur.harga_retur_label')) !!}
                                {!! Form::number('harga', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('harga') ? ' is-invalid' : '') .
                                        (!$errors->has('harga') && old('harga') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::permintaanretur.harga_retur_label'),
                                    'readonly' => 'true',
                                ]) !!}
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('jumlah_permintaan', __('gudangcabang::permintaanretur.jumlah_permintaan_label')) !!}
                                {!! Form::number('jumlah_permintaan', null, [
                                    'class' =>
                                        'form-control' .
                                        ($errors->has('jumlah_permintaan') ? ' is-invalid' : '') .
                                        (!$errors->has('jumlah_permintaan') && old('jumlah_permintaan') ? ' is-valid' : ''),
                                    'placeholder' => __('gudangcabang::permintaanretur.jumlah_permintaan_label'),
                                ]) !!}
                                @error('jumlah_permintaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button
                                class="btn btn-primary">{{ __('gudangcabang::permintaanretur.btn_save_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
