
    <input type="hidden" id="request_data" value="{{ json_encode(request()) }}" />
    <input type="hidden" id="current_tab" value="{{ request()->current_tab ?? 0 }}" />
    <input type="hidden" id="sort_column" value="{{ request()->sort_column ?? 1 }}" />
    <input type="hidden" id="sort_field" value="{{ request()->sort_field ?? 'id' }}" />
    <input type="hidden" id="sort_order" value="{{ request()->sort_order ?? 'desc' }}" />
    <input type="hidden" id="current_limit" value="{{ request()->current_limit ?? 25 }}" />
    <input type="hidden" id="categoryID" value="{{ request()->categoryID ?? 1 }}" />
    <input type="hidden" id="act" value="{{ request()->segment(2) }}" />
    @if($errors->any())
    <h4 class="error_message">{{$errors->first()}}</h4>
    @endif
    @if (session('message'))
        <div class="alert" style="color: red">{{ session('message') }}</div>
    @endif

    @if (session('alert_message'))
    <div id="alert_message" class="alert alert-success" style="display: none">
        {{ session('alert_message') }}
    </div>
    @endif

    @if (session('alert_message_error'))
    <div id="alert_message_error" class="alert alert-error" style="display: none">
        {{ session('alert_message_error') }}
    </div>
    @endif

    <form id="form-update-selected" action="" method="POST"><input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <div id="form-update-selected-content"></div>
    </form>
    <div class="container-fluid main">
        <div class="dataManagement">
            <div class="headTabs clearfix">
                <h4 class="float-left">
                    <span class="title_icon"> {!! @$config['title_icon'] !!} </span> {{ @$params['title'] }}
                </h4>
                <div class="rightSide">
                    @include('hyperspace::components.datatable_nav')
                </div>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                @include('hyperspace::components.datatable_content')
            </div>
        </div>
    </div>
    @include('hyperspace::components.datatable_button')
    @if(!empty($includes))
        @foreach($includes as $include)
            @include($include)
        @endforeach
    @endif

<?php if (!empty($routeRemoveItems) || !empty($routeUpdateStatusItems)): ?>
<script>
    let routeRemoveItems = "{{ $routeRemoveItems }}";
    let routeUpdateStatusItems = "{{ $routeUpdateStatusItems }}";
</script>
<?php endif;?>
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="    max-width: 300px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Xác nhận
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-danger">
               {{ $module->action_delete_confirm_msg??__("Are you sure to delete this item") }}
            </div>
            <div class="modal-footer">
                <form>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
.headTabs {
    border-radius: 4px;
    background: #fff;
    margin: 0 5px 30px 5px;
    padding: 15px 23px;
    color: var(--colo-blue-2);
}
.headTabs h4{
    text-transform: uppercase !important;
    font-weight: 700 !important;
    font-size: 24px;
    margin: 0;
}
.tab-content .filters {
    padding: 0;
    margin: 0px 10px 20px 10px;
}
.filters {
    display: flex !important;
    margin: 0;
    gap: 4px;
    /* justify-content: space-between;
    align-items: center;
    width: 100%; */
}
.filters .float-left{
    display: flex;
}
.filters .filter-input .col-md-12{
    margin: 0;
    padding: 0;
}
#keywords{
    width: 450px !important;
    /* flex-shrink: 0;
    border-radius: 4px !important;
    border: 1px solid #d2d2d2;
    color: #bebdbd;
    line-height: 20px;
    background-color: unset;
    margin-right: 4px; */
    line-height: unset;
    font-size: unset;
    height: max-content;
    height: 35px;
}
.btn-submit-filter{
    border-radius: 4px;
    background: #003f93;
    font-size: unset;
    height: max-content;
    color: #fff !important;
    height: 35px;
}
.float-right{
    justify-content: flex-end;
}
.dt-buttons  li div{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border-radius: 4px;
    background: var(--color-blue);
    color: #fff !important;
}
.dt-buttons  li div a{
    padding: 8px 24px;
    color: #fff !important;
}
.table thead th{
    background-color: var(--colo-blue-2);
    color: white;
    text-align: center !important;
    border: 1px solid #dee2e6;
}
.table tfoot th{

    border: 1px solid #6ad2ff45;
}
.table tbody td{
      border: 1px solid #6ad2ff45;
    background: #Fff;
}

@media only screen and (max-width:699px) {
    #keywords{
        width: calc(100% - -90px) !important;
    }
}
</style>
