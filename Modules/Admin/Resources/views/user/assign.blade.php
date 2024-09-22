@extends('layout.admin')
@section('title', $title)

@section('class-page-name', 'register-page admin-assign-user-page')

@section('content')
    <div class="container">
        <div class="register-wrapper">
            <div class="page-heading">
                <h4>{{$title}}</h4>
            </div>
            <div class="page-body">
                <form action="{{ route('admin.user.assign') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $record->id }}">
                    @include('components.inputs.select', ['label'=>'Select Add-Ons', 'name'=>'addons[]', 'value'=> $record->addons, 'data'=> $addons, 'colLeft'=>6, 'multiple'=> true])
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-wrapper d-flex align-items-center">
                                <button type="submit" class="btnBody btnGreen">UPDATE</button>
                                <a href="{{ route('admin.user') }}">NERVERMIND, DON'T SAVE</a>
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