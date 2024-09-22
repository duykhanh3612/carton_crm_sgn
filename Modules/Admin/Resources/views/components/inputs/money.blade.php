@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if ($colLeft == 12) {
        $colRight = 12;
    }
    $value = old($field, $record->{$field} ?? '');
    if ($value && is_array($value)) {
        $value = implode(', ', $value);
    }
@endphp
<div class="{{ $rowClass ?? 'form-group col-md-12' }}" @if (!empty($rowData)) @foreach ($rowData as $dataKey => $dataVal)
        data-{{ $dataKey }}="{{ $dataVal }}"
    @endforeach @endif>
    <div class="col-md-{{ $colLeft }}">
        <div class="form-group">
            @if (!empty($text))
                <label for="{{ $field }}">{{ $text }} @if (!empty($required))
                        <span class="text-danger">*</span>
                    @endif
                </label>
            @endif
            <div class="input-group mb-3 d-flex money_widget" style="justify-content: space-between !important;flex-wrap: nowrap;">
                <div class="input-group-append" style="width: 40px;margin-left:5px;">
                    <select class="currency" name="currency" style="width: 40px;text-align:center;">
                        @foreach (Currencies::getOption() as $key => $opt)
                            <option value="{{ $key }}" {{@$record->currency==$key?"selected":""}}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="number" min=0 class="form-control input_money" value="{{ $value }}" id="<?= @$field ?>" style="width:40%;max-width:70%;">
                <input type="hidden" id="<?= @$field ?>_hide" name="{{ $field }}" value="{{ $value }}" autocomplete="off" />

                <div class="input-group-append" style="width:30%;" >
                    <input type="text" class="form-control" value="{{ @$record->unit }}" name="unit" style="width:100%;text-align:right;" placeholder="/ Đơn vị">
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <style type="text/css">
        .money_widget {
            border: 1px solid #ccc;
        }

        .input_money {
            text-align: right;
        }

        .money_widget input,
        .money_widget select,
        .money_widget .input-group-text {
            border: 0;
        }
        .money_widget select:hover,.money_widget select:focus-visible{
            outline: none;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $('.input_money').mask('#,##0', {
            reverse: true
        });
        $('.input_money').on('change', function() {
            var id = $(this).attr('id');
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#' + id + '_hide').val(value);
        })
    </script>
@endpush
