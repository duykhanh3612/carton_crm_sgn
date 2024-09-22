@php
    $jsonValue = !empty($row->value) ? json_encode($row->value) : '';
@endphp
<div class="row mb-2">
    <div class="col-sm-12">
        <select name="type" id="type_input" class="form-control" data-type="{{ @$row->type }}" data-value="{{ $jsonValue }}">
            <option value="-1">Kiểu nhập liệu</option>
            <option {{ @$row->type == 'text' ? 'selected' : '' }} value="text">Đoạn text</option>
            <option {{ @$row->type == 'text.textarea' ? 'selected' : '' }} value="text.textarea" data-mask="textarea">Văn
                bản dài</option>
            <option {{ @$row->type == 'yes_no' ? 'selected' : '' }} value="yes_no">Yes / no</option>
            <option {{ @$row->type == 'fck' ? 'selected' : '' }} value="fck">Văn bản HTML</option>
            <option {{ @$row->type == 'datetime' ? 'selected' : '' }} value="datetime">Thời gian</option>
            <option {{ @$row->type == 'list' ? 'selected' : '' }} value="list">List</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 box-field-type" data-name="{{ $name }}">
        @if (!empty(@$row->type))
            @php
                $type = @$row->type ?? 'text';
                $arr = explode('.', $type);
                if (is_array($arr) && count($arr) > 1) {
                    $type = $arr[0];
                    $mask = $arr[1] ?? '';
                }
            @endphp
            @if (view()->exists("admin::components.input.$type"))
                {!! load_view("components.input.$type", ['name' => $name, 'value' => $value, 'id' => $id, 'mask' => @$mask]) !!}
            @else
                {!! load_view('components.input.text', ['name' => $name, 'value' => $value, 'id' => $id, 'mask' => @$mask]) !!}
            @endif
        @endif
    </div>
</div>
@push('js')
    <script>
        var site_url = window.location.protocol + "//" + window.location.host + "/admin/";
        $(document).ready(function() {
            dragItemOrder();
        }).on("change", "#type_input", function() {
            var type = $(this).val(),
                mask = '',
                ele = $(this).closest('.col__item').find('.box-field-type'),
                typeOld = $(this).attr('data-type'),
                valueOld = $(this).attr('data-value'),
                Name = ele.attr('data-name'),
                data = '',
                arrType = type.split('.');

            if (arrType.length) {
                type = arrType[0];
                mask = arrType[1];
            }
            if (typeOld == type) data = valueOld;
            getViewByType(type, Name, ele, data, mask);
        }).on('click', '.add-option', function() {
            var key = 0,
                displayFieldType = JSON.parse($('#mainTable-options').attr('data-options')),
                name = $('.box-field-type').attr('data-name');
            if ($('#mainTable-options .highlight').length) {
                key = parseInt($('#mainTable-options .highlight').last().attr('id')) + 1;
            }
            var html = `<tr class="highlight" id="${ key }">
                        <td>${ bindDisplayType(name, key, displayFieldType) }</td>
                        <td class="field-value"><input type="text" name="value" value="" class="form-control"></td>
                        <td><input type="text" name="name" value="" class="form-control"></td>
                        <td class="center">
                            <a href="javascript:;" class="move-option"><i class="glyph-icon fa fa-arrows"></i></a>
                        </td>
                        <td class="center">
                            <a href="javascript:;" class="remove-option"><i class="glyph-icon fa fa-remove"></i></a>
                        </td>
                    </tr>`;
            $(this).closest('tbody').append(html);
            $('tr[data-id="' + key + '"]').find('[type="text"]').first().focus();
            dragItemOrder();
        }).on('click', '.remove-option', function() {
            var tr = $(this).parent().parent();
            $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('[type="text"]').val() + '</b>',
                'Confirm delete',
                function(r) {
                    if (r == true) {
                        if ($('.remove-option').length == 1) {
                            showNoti('You can not delete the last item!', 'Delete item', 'War');
                        } else {
                            tr.remove();
                            // replaceNo();
                        }
                    }
                });
        }).on('change', '.field-type', function() {
            var type = 'text',
                ele = $(this).closest('tr'),
                name = ele.find('.field-value .form-control').attr('name'),
                mask = $(this).val();
            getViewByType(type, name, ele.find('.field-value'), '', mask)
        }).on('change', '.field-value input', function() {
            if ($(this).attr('type') == 'file') {
                var ele = $(this),
                    files = ele.prop('files')[0],
                    formData = new FormData();
                formData.append('files', files);

                $.ajax({
                    url: site_url + "ajax/upload_file",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        ele.attr('data-file', response.image);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        console.log(error);
                    }
                });
            }
        }).on('submit', '#updateFrm', function(e) {
            if (typeof process_before_submit === 'function') {
                return process_before_submit();
            }
            $('#updateFrm').submit();
        });

        function bindDisplayType(name, key, data) {
            var html = `<select name="type" class="form-control field-type">`;
            $.each(data, function(key, value) {
                html += `<option value="${ key }">${ value }</option>`;
            });
            html += `</select>`;
            return html;
        }

        function process_before_submit() {
            if ($('#type_input').val() == 'list') {
                var data = {};
                $('.box-field-type .nodrop').remove();
                $(".box-field-type .form-control").each(function() {
                    var index = parseInt($(this).closest('tr').index('.highlight'));
                    var name = $(this).attr('name'),
                        value = $(this).attr('type') == 'file' ? $(this).attr('data-file') : $(this).val();
                    if (!data[index]) {
                        data[index] = {};
                    }
                    data[index][name] = value;
                });
                $(".box-field-type .form-control").attr('name', '');
                var name = $('.box-field-type').attr('data-name');
                $('#updateFrm').append(
                    `<textarea class="hidden" name = "${ name }">${ JSON.stringify(Object.values(data)) }</textarea>`);
            }
        }

        function dragItemOrder() {
            $('#mainTable-options tbody').tableDnD({
                onDragClass: 'myDragClass',
                onDrop: function(table, row) {
                    // replaceNo();
                },
                dragHandle: '.move-option'
            });
        }

        function replaceNo() {
            var count_tr = $('#mainTable-options .highlight').length;
            for (var i = 0; i < count_tr; i++) {
                var tr = $('#mainTable-options .highlight:eq(' + i + ')');
                tr.attr('id', i);
                tr.find('input[name*=name]').attr('name', 'name');
                tr.find('input[name*=key"]').attr('name', 'key');
            }
        }

        async function getViewByType(type, name, ele, data = '', mask = '') {
            await $.ajax({
                url: site_url + "ajax/getViewByType/" + type,
                type: "POST",
                data: {
                    name: name,
                    mask: mask,
                    value: data ? JSON.parse(data) : ''
                },
                dataType: "html",
                success: function(result) {
                    ele.html(result);
                },
            });
        }
    </script>
@endpush
