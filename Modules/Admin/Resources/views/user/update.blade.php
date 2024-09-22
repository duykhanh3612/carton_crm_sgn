@extends('admin::layouts.master')
@php
    $title = $record->id ? 'Edit User' : 'Add User';
@endphp
@section('title', $title)

@section('class-page-name', 'register-page admin-add-user-page')

@section('content')
    <div class="container">
        <div class="register-wrapper">
            @php
                $headingTitle = $record->id ? __("edit_user") : __("add_new_user");
            @endphp
            <div class="page-heading">
                <h4 style="text-transform: uppercase">{{ $headingTitle }}</h4>
            </div>
            <div class="page-body">
                @php
                    $approves = ['1'=>'Yes', '0'=>'No'];
                @endphp

                <form action="{{ $action }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    @if(!empty($method))
                    <input type="hidden" name="_method" value="{{ $method }}">
                    @endif

                    @if(empty($defaultApproved))
                        @include('admin::components.inputs.select', ['label'=>__("approved"), 'name'=>'approved', 'value'=> !empty($record->id) ? $record->approved : 1, 'data'=> $approves, 'colLeft'=>6])
                    @else
                        <input type="hidden" name="default-approved" value="1">
                    @endif
                    {{-- @include('admin::components.inputs.text', ['label'=>'Company', 'name'=>'company', 'value'=> $record->company, 'required'=>true, 'colLeft'=>6]) --}}
                    {{-- @include('admin::components.inputs.country', ['value'=> $record->country]) --}}
                    {{-- @include('admin::components.inputs.text', ['label'=>'First name', 'name'=>'first_name', 'value'=> $record->first_name, 'required'=>true, 'colLeft'=>6])
                    @include('admin::components.inputs.text', ['label'=>'Last name', 'name'=>'last_name', 'value'=> $record->last_name, 'required'=>true, 'colLeft'=>6]) --}}
                    @include('admin::components.inputs.text', ['label'=>__("name"), 'name'=>'name', 'value'=> $record->name, 'required'=>false, 'colLeft'=>6])
                    @include('admin::components.inputs.text', ['label'=>'Email', 'name'=>'email', 'value'=> $record->email, 'required'=>false, 'colLeft'=>6])
                    @include('admin::components.inputs.text', ['label'=>__("phone"), 'name'=>'phone', 'value'=> $record->phone, 'required'=>false, 'colLeft'=>6])

                    @include('admin::components.inputs.text', ['label'=>__("user_name"), 'name'=>'user_name', 'value'=> $record->user_name, 'required'=>true, 'colLeft'=>6])

                    @php
                        $required = !empty($record->id) ? false : true;
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            @include('admin::components.inputs.text', ['type'=>'password', 'label'=>__("password"), 'name'=>'password', 'value'=> $record->password==""?'123456':"", 'required'=> $required])
                        </div>
                        <div class="col-md-6">
                            @include('admin::components.inputs.text', ['type'=>'password', 'label'=>__('password_confirm'),'value'=>$record->password==""?'123456':"", 'name'=>'confirm_password', 'required'=> $required])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-wrapper d-flex align-items-center">
                                <button type="submit" class="btnBody btnGreen">{{ $record->id ? 'UPDATE' : 'ADD USER'}}</button>
                                <input type="hidden" name="back_url" value="{{ redirect()->back()->getTargetUrl() }}" />
                                <input type="hidden" name="user_group_id" value="{{ request()->session()->get('user_group_id', '2') }}" />
                                <a href="{{ !empty($backUrl) ? $backUrl : route('admin.user') }}">NERVERMIND, DON'T SAVE</a>
                                {{ request()->session()->get('user_group_id', '2') }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
