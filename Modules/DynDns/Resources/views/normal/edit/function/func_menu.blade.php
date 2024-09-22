<link media="all" type="text/css" rel="stylesheet" href="{{env_host}}public/dashboard/botble/libraries/jquery-nestable/jquery.nestable.css">
<link media="all" type="text/css" rel="stylesheet" href="{{env_host}}public/dashboard/botble/css/menu.css">
@php
   if(Arr::get((array)$row,$func->field_id) !="")
   {
      $menu_id = $row->{$func->field_id};
      $menu_nodes = md::find_all("sys_menu_nodes","menu_id='$menu_id' and parent_id=0","position");
   }
@endphp
<div class="col-md-12">
   <div class="row widget-menu">
      <input type="text" name="deleted_nodes" value="" class="hidden">
      <textarea name="menu_nodes" id="nestable-output" class="form-control hidden"></textarea>
      <div class="col-md-4">
         <div class="panel-group" id="accordion">
            <div class="widget meta-boxes">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapsePages">
                  <h4 class="widget-title" style="margin-top: 0">
                     <span>Pages</span>
                     <i class="fa fa-angle-up narrow-icon"></i>
                  </h4>
               </a>
               <div id="collapsePages" class="panel-collapse collapse in">
                  <div class="widget-body">
                     <div class="box-links-for-menu">
                        <div class="the-box">
                           <ul  class="list-item">
                              @foreach(md::find_all_slug("sys_pages","pages") as $page)
                              <li>
                                 <label for="menu_id_botblepagemodelspage_{{ $page->id}}" data-title="{{ $page->name}}" data-reference-id="{{ $page->id}}" data-reference-type="pages">
                                 <input id="menu_id_pages_{{ $page->id}}" name="menu_id" type="checkbox" value="{{ $page->id}}">
                                 {{ $page->name}}
                                 </label>
                              </li>
                              @endforeach
                           </ul>
                           <div class="text-right">
                              <div class="btn-group btn-group-devided">
                                 <a href="javascript:;" class="btn-add-to-menu btn btn-primary">
                                 <span class="text"><i class="fa fa-plus"></i> Add to menu</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!--
            <div class="widget meta-boxes">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseTags">
                  <h4 class="widget-title">
                     <span>Tags</span>
                     <i class="fa fa-angle-down narrow-icon"></i>
                  </h4>
               </a>
               <div id="collapseTags" class="panel-collapse collapse">
                  <div class="widget-body">
                     <div class="box-links-for-menu">
                        <div class="the-box">
                           <ul class="list-item mCustomScrollbar _mCS_2 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible; padding: 0px;">
                              <div id="mCSB_2" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical_horizontal mCSB_outside" style="max-height: 168px;" tabindex="0">
                                 <div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y mCS_x_hidden mCS_no_scrollbar_x" style="position: relative; top: 0px; left: 0px; width: 0px;" dir="ltr">
                                    <li>
                                       <label for="menu_id_botbletuyendungmodelstagtd_1" data-title="lập trình" data-reference-id="1" data-reference-type="Botble\Tuyendung\Models\TagTd">
                                       <input id="menu_id_Botble\Tuyendung\Models\TagTd_1" name="menu_id" type="checkbox" value="1">
                                       lập trình
                                       </label>
                                    </li>
                                    <li>
                                       <label for="menu_id_botbletuyendungmodelstagtd_2" data-title="nhân viên văn phòng" data-reference-id="2" data-reference-type="Botble\Tuyendung\Models\TagTd">
                                       <input id="menu_id_Botble\Tuyendung\Models\TagTd_2" name="menu_id" type="checkbox" value="2">
                                       nhân viên văn phòng
                                       </label>
                                    </li>
                                 </div>
                              </div>
                              <div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: none;">
                                 <div class="mCSB_draggerContainer">
                                    <div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; top: 0px;" oncontextmenu="return false;">
                                       <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                                       <div class="mCSB_draggerRail"></div>
                                    </div>
                                    <div id="mCSB_2_scrollbar_horizontal" class="mCSB_scrollTools mCSB_2_scrollbar mCS-minimal-dark mCSB_scrollTools_horizontal" style="display: none;">
                                       <div class="mCSB_draggerContainer">
                                          <div id="mCSB_2_dragger_horizontal" class="mCSB_dragger" style="position: absolute; min-width: 50px; left: 0px;" oncontextmenu="return false;">
                                             <div class="mCSB_dragger_bar"></div>
                                             <div class="mCSB_draggerRail"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </ul>
                           <div class="text-right">
                              <div class="btn-group btn-group-devided">
                                 <a href="#" class="btn-add-to-menu btn btn-primary">
                                 <span class="text"><i class="fa fa-plus"></i> Add to menu</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="widget meta-boxes">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseCategories">
                  <h4 class="widget-title">
                     <span>Categories</span>
                     <i class="fa fa-angle-down narrow-icon"></i>
                  </h4>
               </a>
               <div id="collapseCategories" class="panel-collapse collapse">
                  <div class="widget-body">
                     <div class="box-links-for-menu">
                        <div class="the-box">
                           <ul class="list-item mCustomScrollbar _mCS_3 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible; padding: 0px;">
                              <div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical_horizontal mCSB_outside" style="max-height: 168px;" tabindex="0">
                                 <div id="mCSB_3_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y mCS_x_hidden mCS_no_scrollbar_x" style="position: relative; top: 0px; left: 0px; width: 0px;" dir="ltr">
                                    <li>
                                       <label for="menu_id_botbleblogmodelscategory_19" data-title="Tin BRG" data-reference-id="19" data-reference-type="Botble\Blog\Models\Category">
                                       <input id="menu_id_Botble\Blog\Models\Category_19" name="menu_id" type="checkbox" value="19">
                                       Tin BRG
                                       </label>
                                    </li>
                                    <li>
                                       <label for="menu_id_botbleblogmodelscategory_12" data-title="Tin PTF" data-reference-id="12" data-reference-type="Botble\Blog\Models\Category">
                                       <input id="menu_id_Botble\Blog\Models\Category_12" name="menu_id" type="checkbox" value="12">
                                       Tin PTF
                                       </label>
                                    </li>
                                    <li>
                                       <label for="menu_id_botbleblogmodelscategory_14" data-title="Tin thị trường" data-reference-id="14" data-reference-type="Botble\Blog\Models\Category">
                                       <input id="menu_id_Botble\Blog\Models\Category_14" name="menu_id" type="checkbox" value="14">
                                       Tin thị trường
                                       </label>
                                    </li>
                                 </div>
                              </div>
                              <div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: none;">
                                 <div class="mCSB_draggerContainer">
                                    <div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; top: 0px;" oncontextmenu="return false;">
                                       <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                                       <div class="mCSB_draggerRail"></div>
                                    </div>
                                    <div id="mCSB_3_scrollbar_horizontal" class="mCSB_scrollTools mCSB_3_scrollbar mCS-minimal-dark mCSB_scrollTools_horizontal" style="display: none;">
                                       <div class="mCSB_draggerContainer">
                                          <div id="mCSB_3_dragger_horizontal" class="mCSB_dragger" style="position: absolute; min-width: 50px; left: 0px;" oncontextmenu="return false;">
                                             <div class="mCSB_dragger_bar"></div>
                                             <div class="mCSB_draggerRail"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </ul>
                           <div class="text-right">
                              <div class="btn-group btn-group-devided">
                                 <a href="#" class="btn-add-to-menu btn btn-primary">
                                 <span class="text"><i class="fa fa-plus"></i> Add to menu</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="widget meta-boxes">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseTags">
                  <h4 class="widget-title">
                     <span>Tags</span>
                     <i class="fa fa-angle-down narrow-icon"></i>
                  </h4>
               </a>
               <div id="collapseTags" class="panel-collapse collapse">
                  <div class="widget-body">
                     <div class="box-links-for-menu">
                        <div class="the-box">
                           <ul class="list-item mCustomScrollbar _mCS_4 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible; padding: 0px;">
                              <div id="mCSB_4" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical_horizontal mCSB_outside" style="max-height: 168px;" tabindex="0">
                                 <div id="mCSB_4_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y mCS_x_hidden mCS_no_scrollbar_x" style="position: relative; top: 0px; left: 0px; width: 0px;" dir="ltr">
                                    <li>
                                       <label for="menu_id_botbleblogmodelstag_26" data-title="e3e3" data-reference-id="26" data-reference-type="Botble\Blog\Models\Tag">
                                       <input id="menu_id_Botble\Blog\Models\Tag_26" name="menu_id" type="checkbox" value="26">
                                       e3e3
                                       </label>
                                    </li>
                                    <li>
                                       <label for="menu_id_botbleblogmodelstag_7" data-title="nổi bật" data-reference-id="7" data-reference-type="Botble\Blog\Models\Tag">
                                       <input id="menu_id_Botble\Blog\Models\Tag_7" name="menu_id" type="checkbox" value="7">
                                       nổi bật
                                       </label>
                                    </li>
                                    <li>
                                       <label for="menu_id_botbleblogmodelstag_24" data-title="sự kiện" data-reference-id="24" data-reference-type="Botble\Blog\Models\Tag">
                                       <input id="menu_id_Botble\Blog\Models\Tag_24" name="menu_id" type="checkbox" value="24">
                                       sự kiện
                                       </label>
                                    </li>
                                    <li>
                                       <label for="menu_id_botbleblogmodelstag_11" data-title="tải về" data-reference-id="11" data-reference-type="Botble\Blog\Models\Tag">
                                       <input id="menu_id_Botble\Blog\Models\Tag_11" name="menu_id" type="checkbox" value="11">
                                       tải về
                                       </label>
                                    </li>
                                 </div>
                              </div>
                              <div id="mCSB_4_scrollbar_vertical" class="mCSB_scrollTools mCSB_4_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: none;">
                                 <div class="mCSB_draggerContainer">
                                    <div id="mCSB_4_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; top: 0px;" oncontextmenu="return false;">
                                       <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                                       <div class="mCSB_draggerRail"></div>
                                    </div>
                                    <div id="mCSB_4_scrollbar_horizontal" class="mCSB_scrollTools mCSB_4_scrollbar mCS-minimal-dark mCSB_scrollTools_horizontal" style="display: none;">
                                       <div class="mCSB_draggerContainer">
                                          <div id="mCSB_4_dragger_horizontal" class="mCSB_dragger" style="position: absolute; min-width: 50px; left: 0px;" oncontextmenu="return false;">
                                             <div class="mCSB_dragger_bar"></div>
                                             <div class="mCSB_draggerRail"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </ul>
                           <div class="text-right">
                              <div class="btn-group btn-group-devided">
                                 <a href="#" class="btn-add-to-menu btn btn-primary">
                                 <span class="text"><i class="fa fa-plus"></i> Add to menu</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            -->
            <div class="widget meta-boxes">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseCustomLink">
                  <h4 class="widget-title">
                     <span>Add link</span>
                     <i class="fa fa-angle-down narrow-icon"></i>
                  </h4>
               </a>
               <div id="collapseCustomLink" class="panel-collapse collapse">
                  <div class="widget-body">
                     <div class="box-links-for-menu">
                        <div id="external_link" class="the-box">
                           <div class="node-content">
                              <div class="form-group">
                                 <label for="node-title">Title</label>
                                 <input type="text" class="form-control" id="node-title" autocomplete="false">
                              </div>
                              <div class="form-group">
                                 <label for="node-url">URL</label>
                                 <input type="text" class="form-control" id="node-url" placeholder="http://" autocomplete="false">
                              </div>
                              <div class="form-group">
                                 <label for="node-icon">Icon</label>
                                 <input type="text" class="form-control" id="node-icon" placeholder="fa fa-home" autocomplete="false">
                              </div>
                              <div class="form-group">
                                 <label for="node-css">CSS class</label>
                                 <input type="text" class="form-control" id="node-css" autocomplete="false">
                              </div>
                              <div class="form-group">
                                 <label for="target">Target</label>
                                 <div class="ui-select-wrapper">
                                    <select name="target" class="ui-select" id="target">
                                       <option value="_self">Open link directly</option>
                                       <option value="_blank">Open link in new tab</option>
                                    </select>
                                    <svg class="svg-next-icon svg-next-icon-size-16">
                                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                    </svg>
                                 </div>
                              </div>
                              <div class="text-right form-group node-actions hidden">
                                 <a class="btn red btn-remove" href="#">Remove</a>
                                 <a class="btn blue btn-cancel" href="#">Cancel</a>
                              </div>
                              <div class="form-group">
                                 <div class="text-right add-button">
                                    <div class="btn-group">
                                       <a href="#" class="btn-add-to-menu btn btn-primary"><span class="text"><i class="fa fa-plus"></i> Add to menu</span></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-8">
         <div class="widget meta-boxes">
            <div class="widget-title">
               <h4>
                  <span>Menu structure</span>
               </h4>
            </div>
            <div class="widget-body">
               <div class="dd nestable-menu" id="nestable" data-depth="0">
                  <ol class="dd-list">
                     @if(!empty($menu_nodes))
                     @foreach($menu_nodes as $node)
                     <li class="dd-item dd3-item  post-item " data-reference-type="{{$node->reference_type}}" data-reference-id="{{$node->reference_id}}" data-title="{{$node->title}}" data-class="{{$node->css_class}}"
                        data-id="{{$node->id}}" data-custom-url="{{$node->url}}" data-icon-font="{{$node->icon_font}}" data-target="{{$node->target}}">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">
                           <span class="text float-left" data-update="title">{{$node->title}}</span>
                           <span class="text float-right">{{$node->reference_type}}</span>
                           <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                           <div class="clearfix"></div>
                        </div>
                        <div class="item-details">
                           <label class="pad-bot-5">
                           <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                           <input type="text" name="title" value="{{$node->title}}" data-old="{{$node->title}}">
                           </label>
                           <label class="pad-bot-5 dis-inline-block">
                           <span class="text pad-top-5" data-update="icon-font">Icon</span>
                           <input type="text" name="icon-font" value="{{$node->icon_font}}" data-old="{{$node->icon_font}}">
                           </label>
                           <label class="pad-bot-10">
                           <span class="text pad-top-5 dis-inline-block">CSS class</span>
                           <input type="text" name="class" value="{{$node->css_class}}" data-old="{{$node->css_class}}">
                           </label>
                           <label class="pad-bot-10">
                              <span class="text pad-top-5 dis-inline-block">Target</span>
                              <div style="width: 228px; display: inline-block">
                                 <div class="ui-select-wrapper">
                                    <select name="target" class="ui-select" id="target" data-old="_self">
                                       <option value="_self" selected="selected">Open link directly
                                       </option>
                                       <option value="_blank">Open link in new tab
                                       </option>
                                    </select>
                                    <svg class="svg-next-icon svg-next-icon-size-16">
                                       <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                    </svg>
                                 </div>
                              </div>
                           </label>
                           <div class="clearfix"></div>
                           <div class="text-right" style="margin-top: 5px">
                              <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                              <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        @if(!empty($node->has_child))
                        <ol class="dd-list">
                           <li class="dd-item dd3-item " data-reference-type="" data-reference-id="0" data-title="Sản phẩm" data-class="not-active" data-id="624" data-custom-url="/#" data-icon-font="" data-target="_self">
                              <div class="dd-handle dd3-handle"></div>
                              <div class="dd3-content">
                                 <span class="text float-left" data-update="title">Sản phẩm</span>
                                 <span class="text float-right">Custom link</span>
                                 <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="item-details">
                                 <label class="pad-bot-5">
                                 <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                                 <input type="text" name="title" value="Sản phẩm" data-old="Sản phẩm">
                                 </label>
                                 <label class="pad-bot-5 dis-inline-block">
                                 <span class="text pad-top-5" data-update="custom-url">URL</span>
                                 <input type="text" name="custom-url" value="/#" data-old="/#">
                                 </label>
                                 <label class="pad-bot-5 dis-inline-block">
                                 <span class="text pad-top-5" data-update="icon-font">Icon</span>
                                 <input type="text" name="icon-font" value="" data-old="">
                                 </label>
                                 <label class="pad-bot-10">
                                 <span class="text pad-top-5 dis-inline-block">CSS class</span>
                                 <input type="text" name="class" value="not-active" data-old="not-active">
                                 </label>
                                 <label class="pad-bot-10">
                                    <span class="text pad-top-5 dis-inline-block">Target</span>
                                    <div style="width: 228px; display: inline-block">
                                       <div class="ui-select-wrapper">
                                          <select name="target" class="ui-select" id="target" data-old="_self">
                                             <option value="_self" selected="selected">Open link directly
                                             </option>
                                             <option value="_blank">Open link in new tab
                                             </option>
                                          </select>
                                          <svg class="svg-next-icon svg-next-icon-size-16">
                                             <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                          </svg>
                                       </div>
                                    </div>
                                 </label>
                                 <div class="clearfix"></div>
                                 <div class="text-right" style="margin-top: 5px">
                                    <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                                    <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <ol class="dd-list">
                                 <li class="dd-item dd3-item  post-item " data-reference-type="Botble\Page\Models\Page" data-reference-id="26" data-title="Vay Tiền Mặt" data-class="" data-id="620" data-custom-url="http://ptf.dyndns.top/vay-tien-mat" data-icon-font="" data-target="_self">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                       <span class="text float-left" data-update="title">Vay Tiền Mặt</span>
                                       <span class="text float-right">Botble\Page\Models\Page</span>
                                       <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="item-details">
                                       <label class="pad-bot-5">
                                       <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                                       <input type="text" name="title" value="Vay Tiền Mặt" data-old="Vay Tiền Mặt">
                                       </label>
                                       <label class="pad-bot-5 dis-inline-block">
                                       <span class="text pad-top-5" data-update="icon-font">Icon</span>
                                       <input type="text" name="icon-font" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                       <span class="text pad-top-5 dis-inline-block">CSS class</span>
                                       <input type="text" name="class" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                          <span class="text pad-top-5 dis-inline-block">Target</span>
                                          <div style="width: 228px; display: inline-block">
                                             <div class="ui-select-wrapper">
                                                <select name="target" class="ui-select" id="target" data-old="_self">
                                                   <option value="_self" selected="selected">Open link directly
                                                   </option>
                                                   <option value="_blank">Open link in new tab
                                                   </option>
                                                </select>
                                                <svg class="svg-next-icon svg-next-icon-size-16">
                                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                                </svg>
                                             </div>
                                          </div>
                                       </label>
                                       <div class="clearfix"></div>
                                       <div class="text-right" style="margin-top: 5px">
                                          <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                                          <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </li>
                              </ol>
                           </li>
                           <li class="dd-item dd3-item " data-reference-type="" data-reference-id="0" data-title="Tra cứu" data-class="not-active" data-id="625" data-custom-url="/#" data-icon-font="" data-target="_self">
                              <div class="dd-handle dd3-handle"></div>
                              <div class="dd3-content">
                                 <span class="text float-left" data-update="title">Tra cứu</span>
                                 <span class="text float-right">Custom link</span>
                                 <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="item-details">
                                 <label class="pad-bot-5">
                                 <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                                 <input type="text" name="title" value="Tra cứu" data-old="Tra cứu">
                                 </label>
                                 <label class="pad-bot-5 dis-inline-block">
                                 <span class="text pad-top-5" data-update="custom-url">URL</span>
                                 <input type="text" name="custom-url" value="/#" data-old="/#">
                                 </label>
                                 <label class="pad-bot-5 dis-inline-block">
                                 <span class="text pad-top-5" data-update="icon-font">Icon</span>
                                 <input type="text" name="icon-font" value="" data-old="">
                                 </label>
                                 <label class="pad-bot-10">
                                 <span class="text pad-top-5 dis-inline-block">CSS class</span>
                                 <input type="text" name="class" value="not-active" data-old="not-active">
                                 </label>
                                 <label class="pad-bot-10">
                                    <span class="text pad-top-5 dis-inline-block">Target</span>
                                    <div style="width: 228px; display: inline-block">
                                       <div class="ui-select-wrapper">
                                          <select name="target" class="ui-select" id="target" data-old="_self">
                                             <option value="_self" selected="selected">Open link directly
                                             </option>
                                             <option value="_blank">Open link in new tab
                                             </option>
                                          </select>
                                          <svg class="svg-next-icon svg-next-icon-size-16">
                                             <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                          </svg>
                                       </div>
                                    </div>
                                 </label>
                                 <div class="clearfix"></div>
                                 <div class="text-right" style="margin-top: 5px">
                                    <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                                    <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <ol class="dd-list">
                                 <li class="dd-item dd3-item  post-item " data-reference-type="Botble\Page\Models\Page" data-reference-id="21" data-title="Tra Cứu Điểm Tư Vấn Bán Hàng" data-class="" data-id="614" data-custom-url="http://ptf.dyndns.top/tra-cuu-diem-tu-van" data-icon-font="" data-target="_self">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                       <span class="text float-left" data-update="title">Tra Cứu Điểm Tư Vấn Bán Hàng</span>
                                       <span class="text float-right">Botble\Page\Models\Page</span>
                                       <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="item-details">
                                       <label class="pad-bot-5">
                                       <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                                       <input type="text" name="title" value="Tra Cứu Điểm Tư Vấn Bán Hàng" data-old="Tra Cứu Điểm Tư Vấn Bán Hàng">
                                       </label>
                                       <label class="pad-bot-5 dis-inline-block">
                                       <span class="text pad-top-5" data-update="icon-font">Icon</span>
                                       <input type="text" name="icon-font" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                       <span class="text pad-top-5 dis-inline-block">CSS class</span>
                                       <input type="text" name="class" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                          <span class="text pad-top-5 dis-inline-block">Target</span>
                                          <div style="width: 228px; display: inline-block">
                                             <div class="ui-select-wrapper">
                                                <select name="target" class="ui-select" id="target" data-old="_self">
                                                   <option value="_self" selected="selected">Open link directly
                                                   </option>
                                                   <option value="_blank">Open link in new tab
                                                   </option>
                                                </select>
                                                <svg class="svg-next-icon svg-next-icon-size-16">
                                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                                </svg>
                                             </div>
                                          </div>
                                       </label>
                                       <div class="clearfix"></div>
                                       <div class="text-right" style="margin-top: 5px">
                                          <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                                          <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </li>
                                 <li class="dd-item dd3-item  post-item " data-reference-type="Botble\Page\Models\Page" data-reference-id="25" data-title="Tra Cứu Điều Khoản Và Điều Kiện Vay" data-class="" data-id="615" data-custom-url="http://ptf.dyndns.top/bieu-mau-va-dieu-khoan" data-icon-font="" data-target="_self">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                       <span class="text float-left" data-update="title">Tra Cứu Điều Khoản Và Điều Kiện Vay</span>
                                       <span class="text float-right">Botble\Page\Models\Page</span>
                                       <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="item-details">
                                       <label class="pad-bot-5">
                                       <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                                       <input type="text" name="title" value="Tra Cứu Điều Khoản Và Điều Kiện Vay" data-old="Tra Cứu Điều Khoản Và Điều Kiện Vay">
                                       </label>
                                       <label class="pad-bot-5 dis-inline-block">
                                       <span class="text pad-top-5" data-update="icon-font">Icon</span>
                                       <input type="text" name="icon-font" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                       <span class="text pad-top-5 dis-inline-block">CSS class</span>
                                       <input type="text" name="class" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                          <span class="text pad-top-5 dis-inline-block">Target</span>
                                          <div style="width: 228px; display: inline-block">
                                             <div class="ui-select-wrapper">
                                                <select name="target" class="ui-select" id="target" data-old="_self">
                                                   <option value="_self" selected="selected">Open link directly
                                                   </option>
                                                   <option value="_blank">Open link in new tab
                                                   </option>
                                                </select>
                                                <svg class="svg-next-icon svg-next-icon-size-16">
                                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                                </svg>
                                             </div>
                                          </div>
                                       </label>
                                       <div class="clearfix"></div>
                                       <div class="text-right" style="margin-top: 5px">
                                          <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                                          <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </li>
                                 <li class="dd-item dd3-item  post-item " data-reference-type="Botble\Page\Models\Page" data-reference-id="20" data-title="Hướng Dẫn Nhận Tiền Giải Ngân " data-class="" data-id="616" data-custom-url="http://ptf.dyndns.top/huong-dan-nhan-tien-giai-ngan" data-icon-font="" data-target="_self">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                       <span class="text float-left" data-update="title">Hướng Dẫn Nhận Tiền Giải Ngân </span>
                                       <span class="text float-right">Botble\Page\Models\Page</span>
                                       <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="item-details">
                                       <label class="pad-bot-5">
                                       <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                                       <input type="text" name="title" value="Hướng Dẫn Nhận Tiền Giải Ngân " data-old="Hướng Dẫn Nhận Tiền Giải Ngân ">
                                       </label>
                                       <label class="pad-bot-5 dis-inline-block">
                                       <span class="text pad-top-5" data-update="icon-font">Icon</span>
                                       <input type="text" name="icon-font" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                       <span class="text pad-top-5 dis-inline-block">CSS class</span>
                                       <input type="text" name="class" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                          <span class="text pad-top-5 dis-inline-block">Target</span>
                                          <div style="width: 228px; display: inline-block">
                                             <div class="ui-select-wrapper">
                                                <select name="target" class="ui-select" id="target" data-old="_self">
                                                   <option value="_self" selected="selected">Open link directly
                                                   </option>
                                                   <option value="_blank">Open link in new tab
                                                   </option>
                                                </select>
                                                <svg class="svg-next-icon svg-next-icon-size-16">
                                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                                </svg>
                                             </div>
                                          </div>
                                       </label>
                                       <div class="clearfix"></div>
                                       <div class="text-right" style="margin-top: 5px">
                                          <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                                          <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </li>
                                 <li class="dd-item dd3-item  post-item " data-reference-type="Botble\Page\Models\Page" data-reference-id="24" data-title="Biểu lãi suất cho vay tiêu dùng" data-class="" data-id="617" data-custom-url="http://ptf.dyndns.top/bieu-lai-suat-cho-vay-tieu-dung" data-icon-font="" data-target="_self">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                       <span class="text float-left" data-update="title">Biểu lãi suất cho vay tiêu dùng</span>
                                       <span class="text float-right">Botble\Page\Models\Page</span>
                                       <a href="#" title="" class="show-item-details"><i class="fa fa-angle-down"></i></a>
                                       <div class="clearfix"></div>
                                    </div>
                                    <div class="item-details">
                                       <label class="pad-bot-5">
                                       <span class="text pad-top-5 dis-inline-block" data-update="title">Title</span>
                                       <input type="text" name="title" value="Biểu lãi suất cho vay tiêu dùng" data-old="Biểu lãi suất cho vay tiêu dùng">
                                       </label>
                                       <label class="pad-bot-5 dis-inline-block">
                                       <span class="text pad-top-5" data-update="icon-font">Icon</span>
                                       <input type="text" name="icon-font" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                       <span class="text pad-top-5 dis-inline-block">CSS class</span>
                                       <input type="text" name="class" value="" data-old="">
                                       </label>
                                       <label class="pad-bot-10">
                                          <span class="text pad-top-5 dis-inline-block">Target</span>
                                          <div style="width: 228px; display: inline-block">
                                             <div class="ui-select-wrapper">
                                                <select name="target" class="ui-select" id="target" data-old="_self">
                                                   <option value="_self" selected="selected">Open link directly
                                                   </option>
                                                   <option value="_blank">Open link in new tab
                                                   </option>
                                                </select>
                                                <svg class="svg-next-icon svg-next-icon-size-16">
                                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                                </svg>
                                             </div>
                                          </div>
                                       </label>
                                       <div class="clearfix"></div>
                                       <div class="text-right" style="margin-top: 5px">
                                          <a href="#" class="btn btn-danger btn-remove btn-sm">Remove</a>
                                          <a href="#" class="btn btn-primary btn-cancel btn-sm">Cancel</a>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </li>
                              </ol>
                           </li>
                        </ol>
                        @endif
                     </li>
                     @endforeach
                     @endif
                  </ol>
               </div>
               <hr>
               <h3>Menu settings</h3>
               <div class="row">
                  <div class="col-md-4">
                     <p><i>Display location</i></p>
                  </div>
                  <div class="col-md-8">
                     @php
                        if(@$row->locations != "")
                        {
                           $locations = json_decode($row->locations);
                        }
                        else{
                           $locations = [];
                        }
                        
                     @endphp
                     <div>
                        <input type="checkbox" class="hrv-checkbox" {{in_array("header-menu",$locations)?"checked":""}} name="locations[]" value="header-menu" id="menu_location_header-menu">
                        <label for="menu_location_header-menu">Header Navigation</label>
                     </div>
                     <div>
                        <input type="checkbox" {{in_array("main-menu",$locations)?"checked":""}} class="hrv-checkbox" name="locations[]" value="main-menu" id="menu_location_main-menu">
                        <label for="menu_location_main-menu">Main Navigation</label>
                     </div>
                     <div>
                        <input type="checkbox" class="hrv-checkbox" {{in_array("footer-menu",$locations)?"checked":""}} name="locations[]" value="footer-menu" id="menu_location_footer-menu">
                        <label for="menu_location_footer-menu">Footer Navigation</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="{{env_host}}public/dashboard/botble/libraries/jquery-nestable/jquery.nestable.js"></script>
{{-- <script src="http://ptf.dyndns.top/vendor/core/packages/menu/js/menu.js"></script> --}}

<script src="{{env_host}}public/dashboard/botble/js/menu.js"></script>
<style type="text/css">
   .hidden {
      display: none!important;
   }
</style>
