@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('outlet::transaksi.manage_transaksis')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/outlet/transaksi') }}">@lang('outlet::transaksi.manage_transaksis')</a>
                </div>
            </div>
        </div>
        @if (isset($transaksi))
            {!! Form::model($transaksi, [
                'url' => ['admin/outlet/transaksi', $transaksi->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/outlet/transaksi', 'files' => true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($transaksi) ? __('outlet::transaksi.transaksi_add_new') : __('outlet::transaksi.transaksi_update') }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($transaksi) ? __('outlet::transaksi.add_card_title') : __('outlet::transaksi.update_card_title') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('admin.shared.flash')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('id_barang', __('outlet::transaksi.nama_barang_label')) !!}
                                        {!! Form::select(
                                            'id_barang',
                                            $listBarang,
                                            !empty($transaksi->id_barang) ? $transaksi->id_barang : old('transaksi_id'),
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => '-- Pilih Barang --',
                                            ],
                                        ) !!}
                                        @error('id_barang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('jumlah', __('outlet::transaksi.jumlah_barang_label')) !!}
                                        {!! Form::number('jumlah', null, [
                                            'class' =>
                                                'form-control' .
                                                ($errors->has('jumlah') ? ' is-invalid' : '') .
                                                (!$errors->has('jumlah') && old('jumlah') ? ' is-valid' : ''),
                                            'placeholder' => __('outlet::transaksi.jumlah_barang_label'),
                                        ]) !!}
                                        @error('jumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('outlet::transaksi.btn_save_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
