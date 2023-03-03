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
        @if (isset($cabang))
            {!! Form::model($cabang, [
                'url' => ['admin/gudang-pusat/cabang', $cabang->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/gudang-pusat/cabang', 'files' => true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($cabang) ? __('gudangpusat::cabang.cabang_add_new') : __('gudangpusat::cabang.cabang_update') }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($cabang) ? __('gudangpusat::cabang.add_card_title') : __('gudangpusat::cabang.update_card_title') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('admin.shared.flash')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('nama', __('gudangpusat::cabang.name_label')) !!}
                                        {!! Form::text('nama', null, [
                                            'class' =>
                                                'form-control' .
                                                ($errors->has('nama') ? ' is-invalid' : '') .
                                                (!$errors->has('nama') && old('nama') ? ' is-valid' : ''),
                                            'placeholder' => __('gudangpusat::cabang.name_label'),
                                        ]) !!}
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('id_manajer', __('gudangpusat::cabang.manajer_cabang')) !!}
                                        {!! Form::select('id_manajer', $listManajerCabang, !empty($cabang->id_manajer) ? $cabang->id_manajer : old('cabang_id'), [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Pilih Manajer Cabang --',
                                        ]) !!}
                                        @error('id_manajer')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('id_admin', __('gudangpusat::cabang.admin_cabang')) !!}
                                        {!! Form::select('id_admin', $listAdminCabang, !empty($cabang->id_admin) ? $cabang->id_admin : old('cabang_id'), [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Pilih Admin Cabang --',
                                        ]) !!}
                                        @error('id_admin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('lokasi', __('gudangpusat::cabang.lokasi_label')) !!}
                                        {!! Form::textarea('lokasi', null, [
                                            'class' =>
                                                'form-control' .
                                                ($errors->has('lokasi') ? ' is-invalid' : '') .
                                                (!$errors->has('lokasi') && old('lokasi') ? ' is-valid' : ''),
                                            'placeholder' => __('gudangpusat::cabang.lokasi_label'),
                                            'style' => 'height:300px',
                                        ]) !!}
                                        @error('lokasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('gudangpusat::cabang.btn_save_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
