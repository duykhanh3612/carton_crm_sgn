@if((empty($record) && check_rights($module->file,"create")) || (!empty($record) && check_rights($module->file,"update")))
@if (!request()->ajax())
<button type="button" class="btn btn-warning" id="btn-frm-apply">
    <img src="{{assets}}dist/img/icon/save.png" alt="" width="15">
     Lưu và tiếp tục

</button>
@endif


<button type="button" id="btn-frm-save" class="chooseDate text-white border-0">
    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="white">
        <path
            d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z">
        </path>
    </svg>
    <?=request()->segment(3) =="update" || request()->segment(3) =="edit"?"Lưu": "Thêm mới"?>
</button>
@endif

<a href="{{url('admin/'.request()->segment(2))}}">
<button type="button" class="btn btn-dark" data-dismiss="modal">
    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"
        fill="white">
        <path
            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z">
        </path>
    </svg>
    Hủy
</button>
</a>
