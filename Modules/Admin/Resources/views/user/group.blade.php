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
                $headingTitle = $record->id ? 'EDIT USER' : 'ADD NEW USER';
            @endphp
            <div class="page-heading">
                <h4>{{ $headingTitle }}</h4>
            </div>
            <div class="page-body">
                @php
                    $approves = ['1'=>'Yes', '0'=>'No'];
                @endphp

                <form action="{{ route("admin.group.update") }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    @include('admin::components.inputs.text', ['label'=>'Name', 'name'=>'name', 'value'=> $record->name, 'required'=>true, 'colLeft'=>12])
                    @include('admin::components.inputs.role.role_group', ['name'=>'permissions','value'=> $record->permissions, 'colLeft'=>12])

                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-wrapper d-flex align-items-center">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
