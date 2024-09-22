@extends('layouts.admin.master')
@php
    $title = $record->id ? 'Edit User' : 'Add User';
@endphp
@section('title', $title)

@section('class-page-name', 'register-page admin-add-user-page')

@section('content')
    <div class="container">
        <div class="register-wrapper">
            @php
                $headingTitle = $record->id ? 'EDIT USER' : 'ADD NEW USER';
            @endphp
            <div class="page-heading">
                <h4>{{ $headingTitle }}</h4>
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

                    @include('components.inputs.select', ['label'=>'Approved', 'name'=>'approved', 'value'=> !empty($record->id) ? $record->approved : 1, 'data'=> $approves, 'colLeft'=>6])
                    @include('components.inputs.text', ['label'=>'Company', 'name'=>'company', 'value'=> $record->company, 'required'=>true, 'colLeft'=>6])
                    @include('components.inputs.country', ['value'=> $record->country])
                    @include('components.inputs.text', ['label'=>'First name', 'name'=>'first_name', 'value'=> $record->first_name, 'required'=>true, 'colLeft'=>6])
                    @include('components.inputs.text', ['label'=>'Last name', 'name'=>'last_name', 'value'=> $record->last_name, 'required'=>true, 'colLeft'=>6])
                    @include('components.inputs.text', ['label'=>'Email', 'name'=>'email', 'value'=> $record->email, 'required'=>true, 'colLeft'=>6])
                    @include('components.inputs.text', ['label'=>'Phone', 'name'=>'phone', 'value'=> $record->phone, 'required'=>true, 'colLeft'=>6])
                    @include('components.inputs.text', ['label'=>'Account Code', 'name'=>'account_code', 'required'=>true, 'colLeft'=>6])
                    @include('components.inputs.text', ['label'=>'User name', 'name'=>'user_name', 'value'=> $record->user_name, 'required'=>true, 'colLeft'=>6])

                    @php
                        $required = !empty($record->id) ? false : true;
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            @include('components.inputs.text', ['type'=>'password', 'label'=>'Password', 'name'=>'password_1', 'required'=> $required])
                        </div>
                        <div class="col-md-6">
                            @include('components.inputs.text', ['type'=>'password', 'label'=>'Password Confirm', 'name'=>'confirm_password', 'required'=> $required])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-wrapper d-flex align-items-center">
                                <button type="submit" class="btnBody btnGreen">{{ $record->id ? 'UPDATE' : 'ADD USER'}}</button>
                                <a href="">NERVERMIND, DON'T SAVE</a>
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