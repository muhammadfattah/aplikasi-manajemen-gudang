@php
    $route = 'admin/gudang-pusat/kategori-barang';
    if ($viewTrash) {
        $route = 'admin/gudang-pusat/kategori-barang/trashed';
    }
@endphp

{!! Form::open(['url' => $route, 'method' => 'GET']) !!}
<div class="form-row">
    <div class="form-group col-md-6">
        <input type="text" name="q" class="form-control" id="q" placeholder="Ketik kata kunci.."
            value="{{ !empty($filter['q']) ? $filter['q'] : '' }}">
    </div>
    <div class="form-group col-md-2">
        <button class="btn btn-block btn-primary btn-filter"><i class="fas fa-search"></i>
            {{ __('general.btn_search_label') }}</button>
    </div>
    <div class="form-group col-md-2">
        @can('add_gudang_pusat-kategori_barang')
            <a href="{{ url('admin/gudang-pusat/kategori-barang/create') }}"
                class="btn btn-icon btn-block icon-left btn-success btn-filter"><i class="fas fa-plus-circle"></i>
                @lang('gudangpusat::kategori.btn_create_label')</a>
        @endcan
    </div>
    <div class="form-group col-md-2">
        @can('delete_gudang_pusat-kategori_barang')
            @if (!$viewTrash)
                <a href="{{ url('admin/gudang-pusat/kategori-barang/trashed') }}"
                    class="btn btn-icon btn-block icon-left btn-light btn-filter"><i class="fas fa-trash"></i>
                    @lang('gudangpusat::kategori.btn_show_trashed_label')</a>
            @endif
        @endcan
    </div>
</div>
{!! Form::close() !!}
