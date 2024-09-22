@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
    <div class="container-fluid main">
        @if(!isset($setting['has_tag']))
            @include("admin::element")
        @endif
        <h2 class="mt-4 mb-3">{{__('Action_'.request()->segment(3))}} <span style="text-transform: lowercase"> {{@$title}} </span></h2>
        <div class="">
            <form action="{{ $link_update??route('admin.page.update', [@$page, @$record->id ?? '']) }}" class="updateFrm" method="POST" enctype="multipart/form-data" >
           <div class="row">
                <div class="col-lg-9">
                    <div class="main-form clearfix p-0">
                        @if(isset($setting['has_tag']) && $setting['has_tag'])
                            @include("admin::tags")
                        @endif
                        @stack('content_center')
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget meta-boxes form-actions form-actions-default action-horizontal">
                        <div class="widget-title">
                            <h4>
                                <span>Publish</span>
                            </h4>
                        </div>
                        <div class="widget-body">
                            <div class="btn-set">
                                <button type="button" onclick="createandcontinue('save')" class="btn btn-info">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                &nbsp;
                                <button type="button" onclick="createandcontinue('apply')"  value="apply" class="btn btn-success">
                                    <i class="fa fa-check-circle"></i> Save &amp; Edit
                                </button>
                            </div>
                        </div>
                    </div>
                    @stack('content_right')
                </div>
           </div>
            @csrf
            </form>
            <input type="hidden" id="update-eloquent-link" value="{{  $link_update??route('admin.page.update', [$page, @$record->id ?? '']) }}" />
        </div>
    </div>
    <script>


        function createandcontinue($value)
        {
            $("form.updateFrm").append("<input name='action' value='"+$value+"' />");
            if(!checkUpdateFrm())
            {
                $("form.updateFrm").submit();
            }

        }
    </script>
@endsection
