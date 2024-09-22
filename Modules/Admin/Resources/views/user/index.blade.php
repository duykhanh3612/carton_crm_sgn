@extends('admin::layouts.master')

@section('title', 'Users')

@section('class-page-name', 'admin-users-page')

@section('content')
    <div class="container-fluid main jsAutoLoad">
        <div class="page-heading headTabs">
            <h4 style="    text-transform: uppercase;">
                {{__("user")}}
            </h4>
            <div class="btn-group-action">
                <input type="hidden" id="current_tab" value="{{ request()->current_tab ?? 1 }}" />

                {{-- <ul id="full-size-menu" class="nav nav-tabs opt-tab">
                    <li class="@if(request()->current_tab == '1') active @endif">
                        <a href="javascript:void(0)" data-group="group-1" class="btnBody btnGrey group-1" title="DETAILS">{{__("details")}}</a>
                    </li>
                    <li class="@if(request()->current_tab == '2') active @endif">
                        <a href="javascript:void(0)" data-group="group-2" class="btnBody btnGrey group-2" title="OTHER">{{__("other")}}</a>
                    </li>
                </ul>
                <div id="small-size-menu" class="small-size-menu">
                    <select id="selectTab">
                        <option @if(request()->current_tab == '1') selected @endif value="group-1">{{__("details")}}</option>
                        <option @if(request()->current_tab == '2') selected @endif value="group-2">{{__("other")}}</option>
                    </select>
                </div>
                <a href="{{ route('admin.user') }}" class="btnBody btnGreen refresh">
                    <span class="">{{__("refresh")}}</span>
                    <i class="fas fa-redo-alt"></i></a> --}}
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
                    @include('admin::components.paginate', ['records'=> $records])
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
                                {{-- <th class="headtxt" data-field="client_id">CLIENT ID</th> --}}
                                <th class="headtxt group-1" data-field="user_name">{{__("user_name")}}</th>
                                <th class="headtxt group-2" data-field="company">{{__("company")}}</th>
                                {{-- <th class="headtxt group-1" data-field="addons">ADD-ONS</th> --}}

                                {{-- <th class="headtxt group-2" data-field="first_name">FIRST NAME</th>
                                <th class="headtxt group-2" data-field="last_name">LAST NAME</th> --}}
                                <th class="headtxt group-1" data-field="last_name">{{__("name")}}</th>
                                <th class="headtxt group-1" data-field="email">EMAIL</th>
                                <th class="headtxt group-1" data-field="phone">{{__("phone")}}</th>
                                <th class="headtxt group-1" data-field="approved">{{__("approved")}}</th>
                                <th class="headtxt group-2" data-field="last_login">{{__("last_login")}}</th>
                                <th class="headtxt">{{__("action")}}</th>
                                {{-- <th class="headtxt">LOGIN</th> --}}
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($records as $item)
                            <tr @if(!$item->approved) class="pending-approval" @endif>
                                <td class="checkbox">
                                    <div class="checkInput">
                                        <input
                                            type="checkbox"
                                            name="itemID[]"
                                            value="{{ $item->id }}"
                                            data-id="{{ $item->id }}"
                                            id="listProductID{{$item->id}}"
                                            class="checkBox jsListUserId"
                                            />
                                        <label for="listProductID{{ $item->id }}"></label>
                                    </div>
                                </td>
                                {{-- <td>{{ $item->user_group_id }}</td> --}}
                                <td class="group-1">{{ $item->user_name }}</td>
                                <td class="group-2">{{ $item->company }}</td>
                                {{-- <td class="group-1">
                                @php
                                    if($item->addons):
                                        echo json_encode($item->addons);
                                    endif;
                                @endphp
                                </td> --}}

                                <td class="group-1">{{ $item->name }}</td>
                                {{-- <td class="group-1">{{ $item->last_name }}</td> --}}
                                <td class="group-1">{{ $item->email }}</td>
                                <td class="group-1">{{ $item->phone }}</td>
                                <td class="group-1">{{ $item->approved ? 'Yes' : 'No' }}</td>
                                <td class="group-2">{{ @$item->last_login }}</td>
                                <td>
                                    <div class="btn-actions">
                                        @if(!$item->approved)
                                        <a href="javascript:;" class="js-approve-user" data-user-id="{{$item->id}}">Approve</a>
                                        |
                                        @endif
                                        @if(@$user_group_id==1)
                                        <a href="{{ route('admin.user.update', $item->id)}}">{{__('edit')}}</a>
                                        |
                                        @else
                                        <a href="{{ route('admin.user.update', $item->id)}}">{{__("edit")}}</a>
                                        |
                                        @endif
                                        <a href="javascript:;" data-user-id="{{$item->id}}" class="js-remove-user">{{__("delete")}}</a>
                                    </div>
                                </td>
                                {{-- <td>
                                 @if($item->approved)
                                     <a target="_blank" href="{{ route('admin.user.forceLogin', ['id' => $item->id]) }}"><strong>Login</strong></a>
                                 @endif
                                </td> --}}
                            </tr>
                            @endforeach
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
                                <span>{{__("add_user")}}</span>
                            </a>
                        </li>
                        {{-- <li class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                            <a href="javascript:;" class="btnBody btnBlue js-approve-users">
                                <i class="fas fa-thumbs-up"></i>
                                <span>{{__("approve_user")}}</span>
                            </a>
                        </li> --}}
                        {{-- <li class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                            <a href="javascript:;" class="btnBody btnOrange js-remove-users">
                                <i class="fas fa-trash"></i>
                                <span>{{__("delete_user")}}</span>
                            </a>
                        </li> --}}
                        {{-- <li class="col-xs-4 col-sm-4 col-md-4 col-lg-2">
                            <a href="javascript:;" class="btnBody btnGreen js-assign-add-ons">
                                <i class="fas fa-asterisk"></i>
                                <span>ASSIGN ADD-ONS</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
                {{-- @include('admin::components.paginate') --}}
            </div>
        </div>
    </footer>
@endsection
@push('js')
    <script>
      var routeApprovedUsers = "{{ route('admin.user.approve') }}";
      var routeRemoveUsers = "{{ route('admin.user.delete') }}";
      var routeAssignAddons = "{{ route('admin.user.assign') }}";
    </script>
    <script src="{{ asset('public/themes/admin/js/admin/common.js') }}"></script>
@endpush
