@php
$rules = json_decode(@$row->rules) ?? [];
$func_parent = h::getData(functions, 'parent', 0);
@endphp
<div class="widget meta-boxes">
    <div class="widget-title">
        <h4>
            <span> Display rules</span>
        </h4>
    </div>
    <div class="widget-body">
        <div class="custom-fields-rules">
            <textarea name="rules" id="rules" style="display:none;width:100%">{{ @$row->rules }}</textarea>
            <div class="line-group-container">
            @if(!empty($rules))
            @php
                $css = "none";
            @endphp
            @foreach ($rules as $rule_functions)
                @foreach ($rule_functions as $rule)
                    <div class="line-group display_rules_type" data-text="Or">
                        <div class="line rule-line mb10 display_rules_item">
                            <select class="form-control float-left rule-a is-valid display_rules" name="page">
                                @foreach ($func_parent as $func)
                                    @php
                                        $para_page = Request::segment(2);
                                        $page = @h::getData(functions, 'phpfile', $para_page)[0]->parent;
                                        $subfuns = h::getData(functions, 'parent', $func->id);
                                    @endphp

                                    @if (count(@$subfuns) > 0 && @$function[$func->id]['pread'] == 1)
                                        @if (@$function[$func->id]['pread'] == 1)
                                            @if (count($subfuns) > 0)
                                                <optgroup label="{{ $func->title_vn }}">
                                                    @foreach ($subfuns as $sub2)
                                                        @if (@$function[$sub2->id]['pread'] == 1)
                                                            <option value="{{ $sub2->phpfile }} "
                                                                {{ $func->phpfile == @$rule->name ? 'selected' : '' }}>
                                                                {{ $sub2->title_vn }} </option>
                                                        @endif
                                                    @endforeach
                                            @endif
                                            </optgroup>
                                        @endif

                                    @else
                                        @if (@$func->phpfile != '' && @$function[$func->id]['pread'] == 1)
                                            <option value="{{ $func->phpfile }}" class="{{$func->phpfile.','.@$rule->name}}"
                                                {{ $func->phpfile == @$rule->name ? 'selected' : '' }}>
                                                {{ $func->title_vn }} </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            <select class="form-control float-left rule-type display_rules" name="type">
                                <option value="==" {{ '==' == @$rule->type ? 'selected' : '' }}>Equal to</option>
                                <option value="!=" {{ '!=' == @$rule->type ? 'selected' : '' }}>Not equal to</option>
                            </select>
                            <div class="rules-b-group float-left">
                                <select class="form-control rule-b display_rules" name="value" display_rules>
                                    <optgroup label="Pages">
                                        @foreach (md::find_all('sys_pages') as $b)
                                            <option value="{{ $b->id }}"
                                                {{ $b->id == @$rule->value ? 'selected' : '' }}>{{ $b->name }}
                                            </option>
                                        @endforeach

                                    </optgroup>
                                    <optgroup label="Blocks">
                                        @foreach (md::find_all('sys_blocks') as $b)
                                            <option value="{{ $b->id }}"
                                                {{ $b->id == @$rule->value ? 'selected' : '' }}>{{ $b->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <a class="location-add-rule-and location-add-rule btn yellow-lemon float-left">
                                And
                            </a>
                            <a href="#" title="" class="remove-rule-line"><span>&nbsp;</span></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            @endforeach
            @endif

            </div>
            <div class="line-template {{@$css}}">
                <div class="line-group display_rules_type" data-text="Or">
                    <div class="line rule-line mb10 display_rules_item">
                        <select class="form-control float-left rule-a is-valid display_rules" name="page">
                            @foreach ($func_parent as $func)
                                @php
                                    $para_page = Request::segment(2);
                                    $page = @h::getData(functions, 'phpfile', $para_page)[0]->parent;
                                    $subfuns = h::getData(functions, 'parent', $func->id);
                                @endphp

                                @if (count(@$subfuns) > 0 && @$function[$func->id]['pread'] == 1)
                                    @if (@$function[$func->id]['pread'] == 1)
                                        @if (count($subfuns) > 0)
                                            <optgroup label="{{ $func->title_vn }}">
                                                @foreach ($subfuns as $sub2)
                                                    @if (@$function[$sub2->id]['pread'] == 1)
                                                        <option value="{{ $sub2->phpfile }} "
                                                            {{ $func->phpfile == @$rule->name ? 'selected' : '' }}>
                                                            {{ $sub2->title_vn }} </option>
                                                    @endif
                                                @endforeach
                                        @endif
                                        </optgroup>
                                    @endif

                                @else
                                    @if (@$func->phpfile != '' && @$function[$func->id]['pread'] == 1)
                                        <option value="{{ $func->phpfile }} "
                                            {{ $func->phpfile == @$rule->name ? 'selected' : '' }}>
                                            {{ $func->title_vn }} </option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                        <select class="form-control float-left rule-type display_rules" name="type">
                            <option value="==" {{ '==' == @$rule->type ? 'selected' : '' }}>Equal to</option>
                            <option value="!=" {{ '!=' == @$rule->type ? 'selected' : '' }}>Not equal to</option>
                        </select>
                        <div class="rules-b-group float-left">
                            <select class="form-control rule-b display_rules" name="value" display_rules>
                                <optgroup label="Pages">
                                    @foreach (md::find_all('sys_pages') as $b)
                                        <option value="{{ $b->id }}"
                                            {{ $b->id == @$rule->value ? 'selected' : '' }}>{{ $b->name }}
                                        </option>
                                    @endforeach

                                </optgroup>
                                <optgroup label="Blocks">
                                    @foreach (md::find_all('sys_blocks') as $b)
                                        <option value="{{ $b->id }}"
                                            {{ $b->id == @$rule->value ? 'selected' : '' }}>{{ $b->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <a class="location-add-rule-and location-add-rule btn yellow-lemon float-left">
                            And
                        </a>
                        <a href="#" title="" class="remove-rule-line"><span>&nbsp;</span></a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="line">
                <p class="mt20"><b>Or</b></p>
                <a class="location-add-rule-or location-add-rule btn btn-info" href="javascript:;">
                    Add rule group
                </a>
            </div>
        </div>
    </div>
    <style type="text/css">
        .widget {
            background: #ffffff;
            clear: both;
            margin-bottom: 20px;
            width: 100%;
        }
        .none{
            display: none;
        }

    </style>
    <script>
        $('.display_rules').change(function() {
            var rules = [];
            $('.line-group-container').find('.display_rules_type').each(function() {
                var where = $(this).parent().parent().data('text');
                var rules_item = [];
                $(this).find('.display_rules_item').each(function() {
                    var name = $(this).find('.rule-a').val();
                    var type = $(this).find('.rule-type').val();
                    var value = $(this).find('.rule-b').val();
                    var obj_detail = {
                        name: name,
                        type: type,
                        value: value,
                    };
                    console.log(obj_detail);
                    rules_item.push(obj_detail);
                });
                rules.push(rules_item);
            });

            console.log(rules);
            $("#rules").val(JSON.stringify(rules));
        });
        var handleClick = false;
        $(document).on('click', '.location-add-rule-or', function() {
            setTimeout(function(){
                let html = $('.line-template').html();
                $(".line-group-container").append( html);
                handleClick = false;
                console.log(handleClick);
            },500);
        });
        $(document).on('click', '.location-add-rule-and', function() {
            let html = $(this).parent().html();
            $(this).parent().parent().append(`<div class="line rule-line mb10 display_rules_item">` + html +
                `</div>`)
        });
    </script>
</div>
