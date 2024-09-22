<?php
return [
    'title' => 'Khách hàng',
    'title_icon' => "<i class='fa fa-user-tie'></i>",
    'option' => [
         "paginate" => [
            'align' => 'right',
            'type' => 'paging',
        ],
        "include" =>[
            "admin::estate.script"
        ],
        'table_wrapper' => 'table-row',
        "class_buttons" =>  'panel-button',
    ],
    'buttons' => [
        [
            'href' =>url("admin/group/create"),
            'class' => 'btnRed please-wait',
            'label' => 'Tạo mới',
            'title' => 'Tạo Nhóm',
            'icon' => 'fa-newspaper'
        ],
        [
            'route' => "admin.modules.column_options",
            'class' => 'btn-border-purple purple col-show-hide',
            'label' => '',
            'title' => 'Display config',
            'icon' => 'fa-list'
        ],
        [
            'href' => url('admin/customer/export'),
            'route' => 'admin.customer.export',
            'class' => 'btnBlue please-wait',
            'label' => 'Excel',
            'title' => __('Add new'),
            'icon' => 'fa-file'
        ],
    ],
    'filters' => [
        [
            'name' => 'keywords',
            'placeholder' => __('Nhập mã đơn hoặc mã/họ tên/SĐT khách hàng và enter') . ':',
            'value' => request()->keywords,
            'class' => 'w_500'
        ],
        [
            'name' => "search",
            'type' => "submit",
            'value' => "Tìm kiếm",
            'icon' => "<i class='fa fa-search'></i>",
            'class' => "btnBlue "
        ],
        [
            'name' => "road",
            'type' => "option_items_keynum",
            'empty_value' => [""=>"Chọn Mặt tiền / Hẻm"],
            'option_key' => "estate_road",
            'class' => 'datatable-filter',
        ],
    ],
	'fields' => [
        [
            'field' => 'id',
            'text' => '#',
            'input' => 'no',
            'editable' => 0
        ],
        [
            'field' => 'name',
            'text' => 'Tên',
            'type' => 'text',
            'orderable' => 1,
            'editable' => 1,
            'required' => true,
            'class' => 'text-left'
        ],
        [
            'field' => 'name',
            'text' => 'Tên',
            'type' => 'link_title',
            'orderable' => 1,
            'editable' => 1,
            'required' => true,
            'class' => 'text-left'
        ],
        [
            'field' => '',
            'text' => 'Liên hệ',
            'type' => 'column',
            'symbol'=> '/',
            'order' => 3,
            'fields' => ['contact_name','contact_phone'],
            'viewable' => 1,
            'editable' => 0,
        ],
        [
            'field' => 'status',
            'text' => 'Trạng thái',
            'type' => 'select',
            'align' => 'right',
            'data' => ['pending'=>"Chờ duyệt",'accept'=>'Đã duyệt'],
            'viewable' => 1,
            'class' => 'w_80 text-left',
            'rowClass' => 'col-12',
            'tag_group' => 'basic_information',
            'role' => [1, 2]
        ],
        [
            'field' => 'fee_electric_ac',
            'text' => 'Điện máy lạnh',
            'type' => 'option_items_keynum',
            'field' => 'fee_electric_ac',
            'viewable' => 0,
            'rowClass' => 'form-group col-4',
            'class' => 'text-left',
            'tag_group' => 'cost_control',
        ],
        [
            'field' => 'type',
            'text' => 'Loại thiết bị',
            'type' => 'select',
            'data' => [''=>'Select...','car'=>'Car'],
            'orderable' => 1,
            'editable' => 1,
            'required' => true,
            'class' => 'text-left'
        ],
        [
            'field' => 'customer_id',
            'text' => 'Khách hàng',
            'type' => 'form_drop',
            'table' => 'user',
            'table_field' => ['key' => "id", "value" => "user_name"],
            'table_where' => "user_group_id=2",
            'viewable' => 0,
            'editable' => 1,
            'class' => 'text-left',
            'required' => true
        ],
        [
            'field' => 'created_by',
            'text' => 'Nhân viên Sale',
            'short_text' => "Sale",
            'type' => 'form_drop',
            'table' => 'users',
            'table_field' => ['key' => "id", "value" => "full_name"],
            'order' => 3,
            'viewable' => 1,
            'editable' => 0,
            'class' => 'text-left',
            'required' => true,
            'role' => [1,2],
        ],
    ],
    'setting' => [
        'has_tag' => true,
        'tag_groups' => [
            'basic_information' => 'Thông tin chung',
            'place' => 'Địa chỉ',
            'cost_control' => 'Điều kiện hợp đồng và các chi phí khác',
            'contact_information' => 'Thông tin liên hệ'
        ],
    ]
];
?>
