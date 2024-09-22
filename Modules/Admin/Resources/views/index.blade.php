@extends('admin::layouts.master')
@section('header')
    @include('admin::components.header')
@endsection
@section('content')
<div class="container-main jsAutoLoad">
    <div class="page-heading headTabs">
        <h4>USERS</h4>
        <div class="btn-group-action">
            <input type="hidden" id="current_tab" value="{{ request()->current_tab ?? 1 }}" />

            <ul id="full-size-menu" class="nav nav-tabs opt-tab">
                <li class="@if(request()->current_tab == '1') active @endif">
                    <a href="javascript:void(0)" data-group="group-1" class="btnBody btnGrey group-1" title="DETAILS">DETAILS</a>
                </li>
                <li class="@if(request()->current_tab == '2') active @endif">
                    <a href="javascript:void(0)" data-group="group-2" class="btnBody btnGrey group-2" title="OTHER">OTHER</a>
                </li>
            </ul>
            <div id="small-size-menu" class="small-size-menu">
                <select id="selectTab">
                    <option @if(request()->current_tab == '1') selected @endif value="group-1">DETAILS</option>
                    <option @if(request()->current_tab == '2') selected @endif value="group-2">OTHER</option>
                </select>
            </div>
            <a href="{{ route('admin.user') }}" class="btnBody btnGreen refresh">
                <span class="">Refresh</span>
                <i class="fas fa-redo-alt"></i></a>
        </div>
    </div>
    <div class="page-body">
        <div class="tab-content">
            <div class="filters">
                <div class="search-wrapper">
                    <label>Search:</label>
                    <div class="form-group">
                        <input type="text" placeholder="Keywords" name="keywords" value="{{ request()->keywords }}" id="keywords">
                    </div>
                </div>
                {{-- @include('admin::components.paginate', ['records'=> $records]) --}}
            </div>
            <div class="tab-pane active group-{{ request()->current_tab }}" id="main-tab">
                <div class="table-responsive">
                    <table id="dataTablesContent" class="stripe table dataTable table-hover display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="checkbox">
                                <div class="checkInput">
                                    <input type="checkbox" value="None" id="checkAll" name="checkAll" class="checkBox"/>
                                    <label for="checkAll"></label>
                                </div>
                            </th>
                            <th class="headtxt" data-field="client_id">CLIENT ID</th>
                            <th class="headtxt group-1" data-field="user_name">USER NAME</th>
                            <th class="headtxt group-1" data-field="company">COMPANY</th>
                            <th class="headtxt group-1" data-field="addons">ADD-ONS</th>
                            <th class="headtxt group-2" data-field="approved">APPROVED</th>
                            <th class="headtxt group-2" data-field="first_name">FIRST NAME</th>
                            <th class="headtxt group-2" data-field="last_name">LAST NAME</th>
                            <th class="headtxt group-2" data-field="email">EMAIL</th>
                            <th class="headtxt group-2" data-field="phone">PHONE</th>
                            <th class="headtxt">ACTION</th>
                            <th class="headtxt">LOGIN</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="tool jsAutoLoad">
    <div class="container-fluid">
        <div class="footer-wrapper">
            <div class="footer-buttons w-100">
                <ul class="invoiceController no-gutters w-100">
                    <li class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                        <a href="{{ route('admin.user.add') }}" id="sync-from-source" class="btnBody btnBlue">
                            <i class="fas fa-plus"></i>
                            <span>ADD USER</span>
                        </a>
                    </li>
                    <li class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                        <a href="javascript:;" class="btnBody btnBlue js-approve-users">
                            <i class="fas fa-thumbs-up"></i>
                            <span>APPROVE USER</span>
                        </a>
                    </li>
                    <li class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                        <a href="javascript:;" class="btnBody btnOrange js-remove-users">
                            <i class="fas fa-trash"></i>
                            <span>DELETE USER</span>
                        </a>
                    </li>
                    <li class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                        <a href="javascript:;" class="btnBody btnGreen js-assign-add-ons">
                            <i class="fas fa-asterisk"></i>
                            <span>ASSIGN ADD-ONS</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>
@endsection
