@php
    $displayFieldType = get_data('option_items_keynum', 'Field = "DisplayFieldType"', 'Options');
    $array = json_decode($displayFieldType);
    $data = [];
    foreach ($array as $key => $v) {
        $data[$v->key] = $v->name;
    }
    $value = json_decode($value);
@endphp
<table id="mainTable-options" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0"
    data-options="{{ json_encode($data) }}">
    <tbody>
        <tr class="nodrop">
            <th width="10%">Field type</th>
            <th width="58%">Value</th>
            <th width="30%">Name</th>
            <th width="1%" nowrap="nowrap">&nbsp;</th>
            <th width="1%" nowrap="nowrap">
                <a href="javascript:;" class="add-option"><i class="glyph-icon fa fa-plus-circle"></i></a>
            </th>
        </tr>
        @if (!empty($value))
            @foreach ($value as $key => &$item)
            @php
            $item->id = @$id;
            @endphp
                <tr class="highlight" id="{{ $key }}">
                    <td class="field-type">
                        {!! form_dropdown('type', $data, $item->type, 'class="form-control field-type"') !!}
                    </td>
                    <td class="field-value">
                        @php
                            $dataView = $item;
                            $dataView->name = "value";
                        @endphp
                        @if (view()->exists("admin::components.input.$item->type" . @$mask))
                            {!! load_view("components.input.$item->type" . @$mask, (array)$dataView) !!}
                        @else
                            {!! load_view('components.input.text' . @$mask, (array)$dataView) !!}
                        @endif
                    </td>
                    <td>
                        <input type="text" name="name" value="{{ $item->name }}" class="form-control">
                    </td>
                    <td class="center pe-5">
                        <a href="javascript:;" class="move-option"><i class="glyph-icon fa fa-arrows"></i></a>
                    </td>
                    <td class="center pe-5">
                        <a href="javascript:;" class="remove-option"><i class="glyph-icon fa fa-remove"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
