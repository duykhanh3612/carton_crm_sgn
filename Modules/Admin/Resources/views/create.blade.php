@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
    <div class="detailBlock">

        @if(!isset($setting['has_tag']))
            @include("admin::element")
        @endif
        <div class="row">
            <form action="{{ route('admin.page.update', [$page, @$record->id ?? '']) }}" class="updateFrm" method="POST" enctype="multipart/form-data" >
                <div class="col-lg-9">
                    <div class="main-form clearfix">
                        <div class="main-form clearfix">
                            @if(isset($setting['has_tag']) && $setting['has_tag'])
                                @include("admin::tags")
                            @endif
                            @stack('content_center')
                        </div>
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
                                            <button type="submit" name="submit" value="save" class="btn btn-info">
                                    <i class="fa fa-save"></i> Save
                                </button>
                                                &nbsp;
                                <button type="submit" name="submit" value="apply" class="btn btn-success">
                                    <i class="fa fa-check-circle"></i> Save &amp; Edit
                                </button>
                                        </div>
                        </div>
                    </div>
                    @stack('content_right')
                </div>
                @csrf
            </form>
            <input type="hidden" id="update-eloquent-link" value="{{route("admin.page.store",[$page])}}" />
        </div>

    </div>
@endsection
