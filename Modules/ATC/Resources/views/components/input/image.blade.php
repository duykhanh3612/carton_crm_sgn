@php
    $colLeft = empty($colLeft) ? 12 : $colLeft;
    if ($colLeft == 12) {
        $colRight = 12;
    }
    $type = isset($type) && in_array($type, ['text', 'number', 'date', 'password', 'file', 'hidden', 'email']) ? $type : 'text';
    $value = old($name, $value ?? '');
    if ($value && is_array($value)) {
        $value = implode(', ', $value);
    }
    $isImage = false;
    if (\File::exists($value)) {
        $mimeType = \File::mimeType($value);
        if (str_starts_with($mimeType, 'image/')) {
            $isImage = true;
        }
    }
@endphp
<div
    @if (!empty($rowData)) @foreach ($rowData as $dataKey => $dataVal)
        data-{{ $dataKey }}="{{ $dataVal }}"
    @endforeach @endif>
    <div class="col-md-{{ $colLeft }}">
        <div class="form-group">
            <div class="thumb-img">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    @if ($isImage || true)
                        <div class="fileinput-new thumbnail" id="thumbnail_{{ $name }}">
                            @php
                                if (@$value != '' && file_exists(base_path('public/' . $value))) {
                                    $imagePath = asset($value);
                                } else {
                                    $imagePath = asset('themes/admin/images/frame/default-150x150.png');
                                }
                            @endphp
                            <div class="preview-item">
                                <img src="{{ @$imagePath }}" />

                            </div>
                        </div>
                    @else
                        <a href="{{ asset( $value) }}" class="path-file" target="_blank">{{ $value }}</a>
                    @endif
                    <div style="clear:both;"></div>
                    <div id="button_{{ $name }}" style="display:flex;justify-content: center;">
                        @if ($value == '')
                            <span class="btn dark btn-file" style="width:100%">
                                <span class="fileinput-new" style="    font-size: 24px;">Tải lên</span>
                                <span class="fileinput-exists">Tải lên</span>
                                <input type="file" name="{{ $name }}" />
                            </span>
                        @else
                            <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
                            <a class="btn dark btn-clear-image{{ $name }}" data-field="{{ $name }}" data-dismiss="fileinput">
                                {{ trans("remove") }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <link rel="stylesheet" href="{{ asset('plugin/jasny/jasny-bootstrap.min.css') }}" />
        <script type="text/javascript" src="{{ asset('plugin/jasny/jasny-bootstrap.min.js') }}" charset="UTF-8">
        </script>
        <script>
            $('.btn-clear-image{{ $name }}').on('click', function() {
                var tag = $(this).attr('data-field');
                $('#thumbnail_' + tag).find('.preview-item > img').attr("src",'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+');
                $('#button_' + tag).html(
                    '<span class="btn btn-default btn-file"><span class="fileinput-new">Tải lên</span><span class="fileinput-exists">Tải lên</span><input type="file" name="{{ $name }}" /> </span>'
                );
            });
        </script>
    @endpush
</div>
<style type="text/css">
    .thumbnail {
        width: 100%;
        height: 300px;
        max-width: 500px;
        border: 0;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
    }

    .thumbnail img.wide {
        max-width: 100%;
        max-height: 100%;
        height: auto;
    }

    .thumbnail img.tall {
        max-height: 100%;
        max-width: 100%;
        width: auto;
    }

    .preview-list {
        overflow: hidden;
        display: inline-block;
        padding: 0px;
    }

    .preview-item {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .preview-item .mac-frame {
        /* background: url('http://cdn.dyndns.top/public/dashboard/assets/img/mac_frame.png') 0 0 no-repeat; */
        background: #ccc;
        width: 100%;
        height: 234px;
        background-size: 100%;
    }

    .preview-item .mac-frame a span.image-wrap {
        display: block;
        height: calc(100% - 65px);
        /* 197px;*/
        background-size: 100%;
        background-position: center 0%;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    .preview-item .mac-frame a {
        display: block;
        padding: 10px 50px;
        height: 100%;
    }

    .preview-item .mac-frame a:hover span.image-wrap {
        background-position: center 100%;
    }

    .move-long {
        -webkit-transition: all 3.5s ease-out;
        -moz-transition: all 3.5s ease-out;
        -ms-transition: all 3.5s ease-out;
        -o-transition: all 3.5s ease-out;
        transition: all 3.5s ease-out;
    }

    .preview-item .iphone-frame {
        background: url('http://cdn.dyndns.top/public/dashboard/assets/img/iphone_frame.png') 0 0 no-repeat;
        width: 90px;
        height: 181px;
        background-size: 100%;
        position: absolute;
        top: 0;
        right: 0;
        margin-top: 60px;
    }

    .preview-item .iphone-frame a {
        display: block;
        padding: 18px 5px;
    }

    .preview-item .iphone-frame a span.image-wrap {
        display: block;
        height: 144px;
        width: 100%;
        background-size: 100% !important;
        background-position: center 0% !important;
        background-repeat: no-repeat;
        background-color: #fff;
    }
    .btn.dark:not(.btn-outline) {
        color: #fff !important;
        background-color: #2f353b;
        border-color: #2f353b;
    }
</style>
