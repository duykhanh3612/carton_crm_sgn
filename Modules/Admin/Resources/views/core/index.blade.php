@extends('admin::layouts.master')

@section('content')
@if(!isset($setting['has_tag']))
@include("admin::element")
@endif
    <div class="headTabs clearfix">
        <h4 class="float-left">
            Tin tức
        </h4>
        <div class="rightSide">
            @include("admin::core.header")
        </div>
    </div>

    <input type="hidden" id="act" value="{{ $GLOBALS['var']['act'] }}">
    <div class="table-responsive">
     
        <table class="table" id="mainTable-supplier-register-part" cellpadding="0" cellspacing="0" width="100%" border="0"
            style="padding: 0px;">

            <thead class="tableFloatingHeaderOriginal" style="padding: 0px;width: 80%;">
                <form method="get" action="<?php echo current_url($GLOBALS['var']['act']); ?>" id="filter<?php echo $GLOBALS['var']['act']; ?>">
                    
                    @if (!empty($filters))
                        <tr class="filter-head">
                            <th <?= $GLOBALS['per']['del'] ? 'colspan="2" ' : '' ?>nowrap="nowrap"><button type="submit"
                                    class="btn btn-danger">Tìm kiếm</button></th>
                            @foreach ($cols as $key => $col)
                                {!! col_filter($col, $key, $filter, $option ?? []) !!}
                            @endforeach
                            <th>&nbsp;</th>
                        </tr>
                    @endif
                    <tr>
                        <?php if ($GLOBALS['per']['del']) {
                            echo '<th class="center th-sel text-center" width="1%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>';
                        } ?>
                        <th width="1%">#</th>
                        @php
                            $colspan = 3;
                            foreach ($cols as $col) {
                                echo col_name($col);
                                if (isset($col->show) && $col->show == 1) {
                                    $colspan++;
                                }
                            }
                        @endphp
                        <th class="center" width="1%">&nbsp;</th>
                    </tr>
                </form>
            </thead>
            <tbody>
                @if (!empty($rows))
                    @foreach ($rows as $key => $row)
                        <tr class="highlight" id="{{ $row->id }}">
                            <td>{!! sel_item($row->id) !!}</td>
                            <td>{{ $rows->firstItem() + $key++ }}</td>
                            {!! component('display_view', ['cols' => $cols, 'row' => $row]) !!}
                            <td width="100">
                                <div class="d-flex align-items-sm-center">
                                    @if ($GLOBALS['per']['edit'])
                                        {!! edit_alink('', getLinkEdit($row), 'btn btn-custom btn-primary text-white') !!}
                                    @endif
                                    @if ($GLOBALS['per']['del'])
                                        {!! del_restore_link(
                                            @$row->id,
                                            @$row->deleted,
                                            false,
                                            false,
                                            $GLOBALS['var']['act'],
                                            'btn btn-custom btn-danger text-white btn-delete delete-restore reload'
                                        ) !!}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    {!! no_data_mes(count((array) $cols) + 3) !!}
                @endif

            </tbody>
        </table>
    </div>
@endsection
