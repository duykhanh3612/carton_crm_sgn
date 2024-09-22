@extends('admin::layouts.master')
@push('plugin_css')
    <link rel="stylesheet" href="{{ asset('public/themes/admin/css/treeview.css') }}">
@endpush
@push('nav-header')
    <div class="group-process">
        <?php if (isset($export)) : ?>
        <?php if (count($export) > 0) : ?>
        <div class="dropdown">
            <button type="button" class="btn btn-border btn-alt border-black font-black waves-effect dropdown-toggle"
                title="Export to Excel" data-toggle="dropdown"><i class="glyph-icon icon-download"></i></button>
            <ul class="dropdown-menu dropdown-menu-right">
                <?php foreach ($export as $key => $val) : ?>
                <?php if ($key === 'EXCEL' && (empty($val) || $val == '#')) : ?>
                <li class="dropdown-item"><a class="exports-part-file" href="javascript:;" data-placement="bottom"
                        title="Exports">
                        <?= $key ?>
                    </a></li>
                <?php else : ?>
                <li class="dropdown-item"><a target="_blank" href="<?= $val ?>">
                        <?= $key ?>
                    </a></li>
                <?php endif ?>
                <?php endforeach ?>
            </ul>
        </div>
        <?php else : ?>
        <a class="btn btn-border btn-alt border-blue font-blue tooltip-link exports-part-file" href="javascript:;"
            data-href="modules/export/<?= $modulePart ?>" data-placement="bottom" title="Exports"><i
                class="glyph-icon icon-download"></i></a>
        <?php endif ?>
        <?php endif ?>
        <a class="btn btn-border btn-alt border-purple font-purple tooltip-link part-show-hide" href="javascript:;"
            data-placement="bottom" title="Display">
            <i class="fa fa-th-list" aria-hidden="true"></i>
        </a>
    </div>
@endpush
@section('content')
    <input id="act" type="hidden" value="{{ $GLOBALS['var']['act'] }}">
    <div id="page-content">
        <form action="{{ url('admin/' . $GLOBALS['var']['act'] . '/process') }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8" id="updateFrm" class="updateFrm form-horizontal bordered-row">
            <div class="panel-heading">
                <a href="#info-order" data-toggle="collapse">
                    <h3 class="panel-title">
                        <i class="fa fa-plus"></i>
                        <span class="title-info animated fadeIn">Page Information</span>
                        <span class="title-info-details animated fadeIn">

                        </span>
                    </h3>
                </a>
            </div>
            <div class="info-header">
                <a href="#information" data-toggle="collapse">
                    <h1><i class="fa fa-chevron-down"></i>Information</h1>
                </a>
            </div>
            <div id="information" class="collapse in">
                <div class="form-group">
                    @foreach ($cols as $key => $col)
                        @push('col_' . $col->align)
                            <div class="col-sm-{{ @$col->width ?? 12 }} col__item">
                                <div class="col-sm-3 control-label"> {{ @$col->name }}</div>
                                <div class="col-sm-9">
                                    @php
                                        $mask = isset($col->mask) ? '.' . $col->mask : '';
                                        $col->name = $key;
                                        $col->value = @$row->{$key};
                                        $col->id = @$row->id;
                                        $col->row = @$row;
                                        if (!view()->exists("admin::components.input.$col->type.$mask")) {
                                            $mask = '';
                                        }
                                    @endphp
                                    @if (view()->exists("admin::components.input.$col->type" . $mask))
                                        {!! load_view("components.input.$col->type" . $mask, (array) $col) !!}
                                    @endif
                                </div>
                            </div>
                        @endpush
                    @endforeach
                    <div class="col-sm-9">@stack('col_left')</div>
                    <div class="col-sm-3">@stack('col_right')</div>
                </div>
            </div>
            @csrf
            <input type="hidden" name="id" value="{{ @$row->id }}" />
            <input id="language_code" name="language_code" type="hidden" value="{{ request()->language_code ?? config('app.locale') }}">
            <input id="language_meta" name="language_meta" type="hidden" value="{{ !empty(request()->language_meta) ? request()->language_meta : (!empty($id) ? $id : randomKey()) }}">
            {{-- @include('admin::layouts.form_action') --}}
        </form>
    </div>
    @push('js')
        <script>
            $("#submitBtn").click(function() {

                $("#updateFrm").submit();
            });
        </script>
    @endpush
@endsection
@push('plugin_js')
    <script src="{{ asset('public/themes/admin/js/jquery.treeview.js') }}"></script>
@endpush
<style type="text/css">

.panel-heading {
    background: #989b9c;
    border-color: #989b9c;
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
}
.panel-title {
    font-size: 14px;
    color: #FFF;
    margin-bottom: 0;
}
.info-header h1 {
    color: #0f79dd;
    font-size: 13px;
    font-weight: bold;
    padding: 0;
    margin: 2px 0;
}
</style>
