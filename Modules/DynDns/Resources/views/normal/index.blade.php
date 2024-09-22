@php
if($func->field_id=='')
$func->field_id='id';
@endphp
<div id="model-box" class="modal fade" role="dialog"></div><!--/.#dangtin-->

<div class="page-content-wrapper animated fadeInRight">
    <div class="page-content">
        <div class="row wrapper border-bottom page-heading">
            <div class="col-lg-12">
                <h2>{{@$conf->cp_vn }} </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="active">
                        <strong>
                            {{@$title }}
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-12"></div>
        </div>
        @if(@$controls_search)
        <div class="wrapper-content  wrapper-filter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{__('lang.locketqua')}}</h5>
                        </div>
                        <div class="ibox-content collapse in">
                            <div class="widgets-container md_line_box">
                                <div>
                                    <form name="form_admin" method="post">
                                        <div class="form-body">
                                            <?php
                                                          foreach($controls_search as $ctrl){
                                                              $pair['src'] = @$tag['src'][$ctrl->name];
                                                              $pair['ctrl'] = $ctrl;
                                                              //$pair['path_base'] = $path_base;
                                                              $pair['lang'] = @$ctrl->language==1?@_lang:'';
                                                              $pair['func'] = $func;
                                                              if($ctrl->search_type!='')
                                                              echo View(\h::area_admin.'::sys.template.normal.search.'.$ctrl->search_type, $pair);
                                                          }
                                            ?>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div class="btn-group" style="padding-left:5px;">
                                            <a href="#">
                                                <button id="sample_editable_1_new" class="btn sbold blue">
                                                    {{__('lang.loc')}}
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </a>
                                            <!--<a href="javascript::">

                                                    <button id="sample_editable_1_new" class="btn sbold cyan" type="reset">
                                                        Reset

                                                        <i class="fa fa-refesh"></i>

                                                    </button>

                                                </a>-->
                                        </div>
                                        {!!\h::token() !!}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        @endif
        <div class="wrapper-content ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Danh sách </h5>
                            <div class="navbar_menu"> 
                                @if($func->action!='none')
                            {!!$button !!}
                            @endif
                            </div>
                        </div>
                        <div class="ibox-content collapse in">
                            <div class="widgets-container">
                                <div>
                                    <form name="form_admin" method="post">
                                        <table id="example2" class="table   nowrap table-bordegreen dataTable" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    @if($func->action!='none')
                                                    <th width="5" style="border-right:1px dashed">
                                                        &nbsp; &nbsp;&nbsp;
                                                        <input id="chkHeader" name="chkHeader" class="check_all" type="checkbox" />
                                                    </th>
                                                    <th width="20" style="border-right:1px dashed">
                                                        &nbsp; &nbsp;
                                                        <span class="icon fa fa-ellipsis-h" style="color:red;font-size:18px;"></span>
                                                    </th>
                                                    @endif
                                                    <?php if(@$controls_index) foreach(@$controls_index as $ctrl):?>
                                                    <th {{$ctrl->type=='published'?"style='width:50px;'":""}}>
                                                        <?php
                                                              switch(@$ctrl->mask){
                                                                  //Phone
                                                                  case 'input_age_birthday':
                                                                      echo @$ctrl->note;
                                                                      break;
                                                                  default:
                                                                      echo @$ctrl->title;
                                                                      break;
                                                              }
                                                        ?>

                                                        ?>
                                                    </th>
                                                    <?php endforeach?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(@$rows)
                                                @foreach($rows as $row)
                                                <tr>
                                                    @if($func->action!='none')
                                                    <td align="center" style="border-right:1px dashed">
                                                        <input type="checkbox" name="chkid[]" value="<?=@$row->id?>" onclick="checkidChecked();" />
                                                    </td>
                                                    <td align="center" style="border-right:1px dashed">
                                                        <input alt="" data-delete-confirm="" data-href="{{h::site_url(\h::_area.'/'.request()->segment(2).'/del/'.@$row->{$func->field_id})}}" class="tooltip btgrid delete" type="button" />
                                                        <a href="">
                                                            <span class="icon fa fa-remove" style="color:red;font-size:18px;"></span>
                                                        </a>

                                                        <!--<a href="{{    h::site_url(\h::_area.'/'.request()->segment(2).'/del/'.@$row->{$func->field_id})}}">
                                                            <span class="icon fa fa-remove" style="color:red;font-size:18px;"></span>
                                                        </a>-->
                                                        <a href="{{    h::site_url(\h::_area.'/'.request()->segment(2).'/edit/'.@$row->{$func->field_id})}}">
                                                            <span class="icon fa fa-edit" style="color:orangered;font-size:18px;"></span>
                                                        </a>
                                                    </td>
                                                    @endif
                                                    <?php if(@$controls_index)
                                                              foreach($controls_index as $ctrl){
                                                                  $pair['row'] = @$row;
                                                                  $pair['ctrl'] = $ctrl;
                                                                  $pair['path_base'] = $path_base;
                                                                  $pair['lang'] = @$ctrl->language==1?_lang:'';
                                                                  $pair['func'] = $func;
                                                                  if($ctrl->type!='' && view()->exists(\h::area_admin.'::sys.template.normal.index.'.$ctrl->type))
                                                                      echo View(\h::area_admin.'::sys.template.normal.index.'.$ctrl->type, $pair);
                                                                  else
                                                                  {
                                                                      if(view()->exists("admin::sys.template.normal.index.".$ctrl->type.".".@$ctrl->mask))
                                                                          include("admin::sys.template.normal.index.input.".@$ctrl->mask);
                                                                      else if($ctrl->type!='' && view()->exists(\h::area_admin."::sys.template.normal.".$ctrl->type.".".$ctrl->type))
                                                                          include("admin::sys.template.normal.index.".$ctrl->type.".".$ctrl->type);
                                                                     else echo '<td></td>';
                                                                  }
                                                              }
                                                    ?>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        @if(@$rows)
                                        {!! $rows->links() !!}
                                        @endif
                                       {!!\h::token() !!}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
       
        <!-- start footer -->
        <!--<div class="footer">
            <div class="pull-right">
                <ul class="list-inline">
                    <li>
                        <a title="" href="index.html">Dashboard</a>
                    </li>
                    <li>
                        <a title="" href="mailbox.html">Inbox </a>
                    </li>
                    <li>
                        <a title="" href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a title="" href="contacts.html">Contacts</a>
                    </li>
                </ul>
            </div>
            <div>
                <strong>Copyright</strong>AdminUI Company &copy; 2017
            </div>
        </div>-->
    </div>
</div>
<style type="text/css">   
    @media only screen and (max-width: 600px) {
      .wrapper-filter{
        margin-bottom:5px;
      }
    }
</style>
<script>
    var timeOut;
    $(".modal_poup").on('click', function () {
        var _id = $(this);
       var url = $(this).attr('data-url');
        if (timeOut != null) {
            clearTimeout(timeOut);
        }
        timeOut = setTimeout(function () {
            var id = _id.attr('data-id');           
            $.get(url, { id: id }, function (data) {
                $("#model-box").html(data);
                $("#model-box").modal("show");
               // $("#btn-save").on('click', function () {
                    //$(".from_modal").submit();
                   //$("#hoanthanh").modal("show");
                //})
            });

        }, 600);
    });
</script>

<link href="../plugin/lightbox2/dist/css/lightbox.css" rel="stylesheet" />
<script src="../plugin/lightbox2/dist/js/lightbox.js"></script>

@extends(h::area_admin.'::layout.icon')
@extends(h::area_admin.'::sys.template.script')