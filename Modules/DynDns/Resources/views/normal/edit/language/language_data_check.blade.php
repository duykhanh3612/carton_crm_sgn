@php
    
    $rows = md::find_all($func->table,$ctrl->att_table."='".@$row->{$ctrl->att_table}."'");
    $rows = \h::array_group_alone($rows->toArray(),"lang_code",true);
    $let_lang = str_replace("_","",_lang);
@endphp

<div id="top-sortables" class="meta-box-sortables">
    <div id="language_wrap" class="widget meta-boxes">
        <div class="widget-title">
            <h4><span>Ngôn ngữ</span></h4>
        </div>
        <div class="widget-body">
            <div id="select-post-language">
                <table class="select-language-table">
                    <tbody>
                        <tr>
                            <td class="active-language">
                                @if(@$row->{$ctrl->value}!='')
                                <img id="lang_flag" src="{{env_host}}/public/plugin/flag-icon-css-master/flags/1x1/{{$let_lang}}.svg" title="English" width="16" />
                                @else
                                Chọn ngôn ngữ
                                @endif
                            </td>
                            <td class="translation-column">
                                <div class="ui-select-wrapper">
                                    <select name="lang_code" id="post_lang_choice" class="ui-select">
                                        @foreach($language as $lang)
                                        <option value="{{$lang->languagecode}}" {{$lang->languagecode==$let_lang?'selected':''}} data-flag="{{$lang->languagecode}}">{{__('cms.lang_'.$lang->languagecode)}}</option>
                                        @endforeach         
                                    </select>

                                    <script>
                                        $('#post_lang_choice').val('{{@$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:request('ref_lang')}}');
                                        $('#lang_flag').attr('src', "{{env_host}}/public/plugin/flag-icon-css-master/flags/1x1/{{@$row->{$ctrl->value}!=''?@$row->{$ctrl->value}:request('ref_lang')}}.svg");
                                    </script>
                                    <svg class="svg-next-icon svg-next-icon-size-16">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                    </svg>
                                </div>
                                <input type="hidden" name="{{$ctrl->att_table}}" value="{{@$row->{$ctrl->att_table}!=''?@$row->{$ctrl->att_table}:(request($ctrl->att_table)!=''?request($ctrl->att_table):\h::ApiToken(32))}}" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <strong>Dịch</strong>
                <div id="list-others-language">
                    
                    @foreach($language as $lang)
                     
                        @if(@$rows[$lang->languagecode] && @$row->{$ctrl->value}!=$lang->languagecode)
                             
                            <img src="{{env_host}}/public/plugin/flag-icon-css-master/flags/1x1/{{$lang->languagecode}}.svg" title="Tiếng Việt" width="16" alt="{{__('cms.lang_'.$lang->languagecode)}}" />
                            <a href="{{url('admin/'.request()->segment(2))}}/edit/{{$rows[$lang->languagecode][$func->field_id] }}"> {{__('cms.lang_'.$lang->languagecode)}} <i class="fa fa-edit"></i></a>
                           
                        @endif
 
                    @endforeach
                     @if(count($rows)<=1)
                            <a href="{{url('admin/'.request()->segment(2))}}/new?ref_from={{@$row->{$func->field_id} }}&ref_lang={{$lang->languagecode}}&lang_token={{@$row->{$ctrl->att_table} }}" class="tip" title="Add other language version for this record">
                                <i class="fa fa-plus"></i>
                            </a>
                     @endif
                </div>
            </div>
            <input type="hidden" id="lang_meta_created_from" name="ref_from" value="" />
            <input type="hidden" id="reference_id" value="11" />
            <input type="hidden" id="reference_type" value="Botble\Blog\Models\Category" />
            <input type="hidden" id="route_create" value="https://cms.botble.com/admin/categories/create" />
            <input type="hidden" id="route_edit" value="https://cms.botble.com/admin/categories/edit/11" />
            <input type="hidden" id="language_flag_path" value="/vendor/core/images/flags/" />
            <div data-change-language-route="https://cms.botble.com/languages/change-item-language"></div>
            <div id="confirm-change-language-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title"><i class="til_img"></i><strong>Xác nhận thay đổi ngôn ngữ</strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body with-padding">
                            Bạn có chắc chắn muốn thay đổi ngôn ngữ sang tiếng "<strong class="change_to_language_text"></strong>" ? Điều này sẽ ghi đè bản ghi tiếng "
                            <strong class="change_to_language_text"></strong>" nếu nó đã tồn tại!
                        </div>
                        <div class="modal-footer">
                            <button class="float-left btn btn-warning" data-dismiss="modal">Hủy bỏ</button>
                            <a class="float-right btn btn-warning" id="confirm-change-language-button" href="#">Xác nhận thay đổi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
