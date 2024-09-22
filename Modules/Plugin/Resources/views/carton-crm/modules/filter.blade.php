 <!-- Main content -->
 <section class="content">
    <form id="filterForm" class="form-filter">
     <div class="container-fluid">
         <!-- Search & Create Field -->
         <div class="d-flex justify-content-between flex-wrap" style="margin: 30px 6.5px; gap: 4px;">
             <!-- form tìm kiếm -->
            <div class="input-search d-flex">

                 <div class="input-group">

                    <div  class="search-box input-group-append">
                        @if(check_rights($module->file,"delete"))
                        <div class="dropdown bar-actions">
                            <button class="btn btn-actions dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item {{@$action['class']}} action-delete" data-href="{{url("admin/".request()->segment(2)."/delete")}}">
                                    @if(@$action['icon']!="")
                                    <i class="{{@$action['icon']}}"></i>
                                    @endif
                                    <small> Xóa</small>
                                </a>


                            </div>
                        </div>
                        @endif
                        <input type="search" name="keywords" value="{{@request('keywords')}}" class="form-control  form-control-lg" placeholder="{{$module->filter_keyword_placeholder??__("input_keyword")}}" />
                    </div>

                     <div class="input-group-append">
                         <button type="submit" class="btn btn-lg btn-default btn-sm-150"
                             style="border-radius: 4px; background: var(--secondary_bg_color); color: var(--secondary_color); font-size: unset; height: max-content;">
                             <img src="{{ assets }}dist/img/icon/search.png" alt="icon search"
                                 style="width: 14px;" />
                             <p class="fw-500">Tìm kiếm</p>
                         </button>
                     </div>
                 </div>
            </div>
             <!-- Thêm khách hàng, tạo đơn hàng -->
             <div class="d-flex align-items-center" style="gap: 16px;">
                 <!-- Thêm khách hàng -->
                 @if(check_rights($module->file,"create"))
                 <div>
                     <button type="button" class="btn btn-danger btn-sm-150 text-nowrap" data-href="{{url("admin/".$module->file."/update")}}" data-toggle="{{$module->action_page_detail}}" data-target="#modalFormUpdate">
                         <div class="d-flex align-items-center">
                             <img src="{{ assets }}dist/img/icon/plus.png" alt="" style="width: 14px;" />
                         </div>
                         <p class="fw-500">Thêm {{$module->name_vn}}</p>
                     </button>
                 </div>
                 @endif
                 @if(!empty($module->page_tab_group))
                 <div>
                    <input type="hidden" id="current_tab" value="{{ request()->current_tab ?? 0 }}"/>
                    <ul id="full-size-menu" class="nav nav-tabs opt-tab">
                        <li class="@if(request()->current_tab == '0') active @endif">
                            <a href="javascript:void(0)" data-group="group-0" class="btnBody btnGrey group-1"
                            title="DETAILS">Main</a>
                        </li>
                        <li class="@if(request()->current_tab == '1') active @endif">
                            <a href="javascript:void(0)" data-group="group-1" class="btnBody btnGrey group-1"
                            title="DETAILS">DETAILS</a>
                        </li>
                    </ul>
                </div>
                @endif
                 <!-- Tạo đơn hàng -->
                 {{-- <div>
                     <button type="button" class="btn bg-main-yl" data-toggle="modal" data-target="#addOrder">
                         <div class="d-flex align-items-center">
                             <img src="{{ assets }}dist/img/icon/plus.png" alt="" style="width: 14px;" />
                         </div>
                         <p class="fw-500">Tạo đơn</p>
                     </button>
                 </div> --}}
             </div>
         </div>
         @php
            $cols = json_decode($column_options);
            $filters=  collect($cols)->whereNotNull("filter")->toArray();
         @endphp
         @if (!empty($filters))

             <div class="d-flex" style="gap: 42px; margin: 30px 6.5px;">
                 <!-- Bộ lọc -->
                 <div class="chooseFilter d-flex align-items-center" style="gap: 10px;">
                        @foreach ($cols as $key => $col)
                        @if(!empty($col->filter))
                        <div class="filter-head form-group">

                                {!! col_filter($col, $key, request('filter'), ['class'=>'custom-select btn btn-filter','placeholder'=>@$col->name]) !!}

                            {{-- <th>&nbsp;</th> --}}
                        </div>
                        @endif
                        @endforeach
                     <!-- Xếp hạng -->
                     {{-- <div class="form-group">
                         <select class="custom-select btn btn-filter" id="rank">
                             <option selected>Xếp hạng</option>
                             <option value="1">VIP</option>
                             <option value="2">Diamond</option>
                             <option value="3">Tiêu chuẩn</option>
                         </select>
                     </div> --}}
                     <!-- Giới tính -->
                     {{-- <div class="form-group">
                         <select class="custom-select btn btn-filter" id="gender">
                             <option selected>Giới tính</option>
                             <option value="1">Nam</option>
                             <option value="2">Nữ</option>
                         </select>
                     </div> --}}
                     <!-- Tuổi -->
                     {{-- <div class="form-group">
                         <select class="custom-select btn btn-filter" id="gender">
                             <option selected>Tuổi</option>
                             <option value="1">Dưới 18t</option>
                             <option value="2">Từ 18t đến 22t</option>
                             <option value="2">Từ 23t đến 32t</option>
                             <option value="2">Trên 32t</option>
                         </select>
                     </div> --}}
                     <!-- Nguồn -->
                     {{-- <div class="form-group">
                         <select class="custom-select btn btn-filter" id="gender">
                             <option selected>Nguồn</option>
                             <option value="1">Từ Facebook</option>
                             <option value="2">Khách giới thiệu</option>
                             <option value="2">Tự đến</option>
                         </select>
                     </div> --}}
                 </div>
                 <!-- Xác nhận lọc và reset bộ lọc -->
                 <div class="d-flex align-items-center" style="gap: 14px;">
                     <!-- Lọc -->
                     <button type="submit" class="btn bg-main-yl d-flex align-items-center justify-content-center">
                         <div class="d-flex align-items-center">
                             <img src="{{ assets }}dist/img/icon/fill.png" alt="" style="width: 14px;" />
                         </div>
                         <p>Lọc</p>
                     </button>
                     <!-- Reset bộ lọc -->
                     <button type="button" id="filter_restore" class="btn d-flex align-items-center justify-content-center showDate bg-yl-2">
                         <div class="d-flex align-items-center">
                             <img src="{{ assets }}dist/img/icon/reset.png" alt=""
                                 style="width: 14px;" />
                         </div>
                         <p>Khôi phục</p>
                     </button>
                 </div>
             </div>

         @endif
     </div>
    </form>
     @push("js")
     <script>
        $(document).on("click","#filter_restore",function(){
            $('#filterForm').trigger("reset");
            $('#filterForm').find(".select2").val("").select2();
            $('#filterForm').submit();
        });
    </script>
     @endpush

     <!-- /.container-fluid -->
 </section>
