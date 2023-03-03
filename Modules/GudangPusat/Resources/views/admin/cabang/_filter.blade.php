@php
    $route = 'admin/gudang-pusat/cabang';
    if ($viewTrash) {
        $route = 'admin/gudang-pusat/cabang/trashed';
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
        @can('add_gudang_pusat-cabang')
            <a href="{{ url('admin/gudang-pusat/cabang/create') }}"
                class="btn btn-icon btn-block icon-left btn-success btn-filter"><i class="fas fa-plus-circle"></i>
                @lang('gudangpusat::cabang.btn_create_label')</a>
        @endcan
    </div>
    <div class="form-group col-md-2">
        @can('delete_gudang_pusat-cabang')
            @if (!$viewTrash)
                <a href="{{ url('admin/gudang-pusat/cabang/trashed') }}"
                    class="btn btn-icon btn-block icon-left btn-light btn-filter"><i class="fas fa-trash"></i>
                    @lang('gudangpusat::cabang.btn_show_trashed_label')</a>
            @endif
        @endcan
    </div>
</div>
{!! Form::close() !!}
