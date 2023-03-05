@php
    $route = 'admin/gudang-cabang/permintaan-order';
    if ($viewTrash) {
        $route = 'admin/gudang-cabang/permintaan-order/trashed';
    }
@endphp

{!! Form::open(['url' => $route, 'method' => 'GET']) !!}
<div class="form-row">
    <div class="form-group col-md-10">
        <input type="text" name="q" class="form-control" id="q" placeholder="Ketik kata kunci.."
            value="{{ !empty($filter['q']) ? $filter['q'] : '' }}">
    </div>
    <div class="form-group col-md-2">
        <button class="btn btn-block btn-primary btn-filter"><i class="fas fa-search"></i>
            {{ __('general.btn_search_label') }}</button>
    </div>
</div>
{!! Form::close() !!}
