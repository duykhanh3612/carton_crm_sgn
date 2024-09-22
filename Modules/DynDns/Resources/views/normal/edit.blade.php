<div class="page-content-wrapper animated fadeInRight">
    <div class="page-content">
        <div class="row wrapper border-bottom page-heading">
            <div class="col-lg-12">
                <h2>{{ @$conf->cp_vn }}</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{h::site_url()}}">Home</a>
                    </li>
                    <li>

                        <a href="{{h::site_url(h::area_admin.'/'.request()->segment(2))}}">{{$title}}</a>
                    </li>
                    <li class="active">
                        <strong style="text-transform:uppercase">{{request()->segment(3)}}</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-12"></div>
        </div>

        <div class="wrapper-content ">
            <form id="frm-post" name="form_admin" action="" method="post" enctype="multipart/form-data">   
                  @if($func->page=='')
                    @include(_alias_admin.'::sys.template.normal.widge.edit_list')
                  @else
                    @include(_alias_admin.'::sys.template.normal.widge.edit_tab')
                  @endif
                {!! h::token() !!}
                <input type="hidden" name="id" id="id" value="{{ @$row->{$func->field_id==''?'id':$func->field_id} }}" />
            </form>
            <div class="row">
                {!! @$button !!}
            </div>
        </div>
        {!!View($template.'layout.footer') !!}
    </div>
</div>

@extends($template.'layout.icon')
@extends($template.'sys.template.script')

