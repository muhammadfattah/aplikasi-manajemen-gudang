@extends('layouts.dashboard')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>@lang('gudangpusat::outlet.manage_outlets')</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/gudang-pusat/outlet') }}">@lang('gudangpusat::outlet.manage_outlets')</a>
                </div>
            </div>
        </div>
        @if (isset($outlet))
            {!! Form::model($outlet, [
                'url' => ['admin/gudang-pusat/outlet', $outlet->id],
                'method' => 'PUT',
                'files' => true,
            ]) !!}
            {!! Form::hidden('id') !!}
        @else
            {!! Form::open(['url' => 'admin/gudang-pusat/outlet', 'files' => true]) !!}
        @endif
        @csrf
        <div class="section-body">
            <h2 class="section-title">
                {{ empty($outlet) ? __('gudangpusat::outlet.outlet_add_new') : __('gudangpusat::outlet.outlet_update') }}
            </h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ empty($outlet) ? __('gudangpusat::outlet.add_card_title') : __('gudangpusat::outlet.update_card_title') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('admin.shared.flash')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('nama', __('gudangpusat::outlet.name_label')) !!}
                                        {!! Form::text('nama', null, [
                                            'class' =>
                                                'form-control' .
                                                ($errors->has('nama') ? ' is-invalid' : '') .
                                                (!$errors->has('nama') && old('nama') ? ' is-valid' : ''),
                                            'placeholder' => __('gudangpusat::outlet.name_label'),
                                        ]) !!}
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('id_supervisor', __('gudangpusat::outlet.supervisor_outlet')) !!}
                                        {!! Form::select(
                                            'id_supervisor',
                                            $listSupervisorOutlet,
                                            !empty($outlet->id_supervisor) ? $outlet->id_supervisor : old('outlet_id'),
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => '-- Pilih Supervisor Outlet --',
                                            ],
                                        ) !!}
                                        @error('id_supervisor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('id_cabang', __('gudangpusat::outlet.cabang_outlet')) !!}
                                        {!! Form::select('id_cabang', $listCabang, !empty($outlet->id_cabang) ? $outlet->id_cabang : old('outlet_id'), [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Pilih Cabang Outlet --',
                                        ]) !!}
                                        @error('id_cabang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('lokasi', __('gudangpusat::outlet.lokasi_label')) !!}
                                        {!! Form::textarea('lokasi', null, [
                                            'class' =>
                                                'form-control' .
                                                ($errors->has('lokasi') ? ' is-invalid' : '') .
                                                (!$errors->has('lokasi') && old('lokasi') ? ' is-valid' : ''),
                                            'placeholder' => __('gudangpusat::outlet.lokasi_label'),
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
                            <button class="btn btn-primary">{{ __('gudangpusat::outlet.btn_save_label') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
