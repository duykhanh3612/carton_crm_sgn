<?php
return [
    'order' => [
        'title' => 'Đơn hàng',
        'actions' => [
            [
                'href' =>"#",
                'class' => 'action-export-excel',
                'label' => 'Xuất DS đơn hàng',
                'title' => 'Xuất DS đơn hàng',
                'icon' => 'fa fa-file'
            ],
        ],
        'filters' => [
            [
                // 'label' => __('Lọc'),
                'name' => 'keywords',
                'placeholder' =>  __('Nhập mã đơn hoặc mã/họ tên/SĐT khách hàng/NCC và enter') . ':',
                // 'value' => request()->keywords
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ],
            "children" => [
                "name" => "",
                "nodes" => [
                    "left" => [
                        [
                            'name' => 'created_by',
                            'type' => 'form_drop',
                            'table' => 'users',
                            'table_field' => ['key' => "id", "value" => "full_name"],
                            'table_where' => "",
                            'viewable' => 0,
                            'editable' => 1,
                            'defaultValue' => true,
                            'class' => 'text-left datatable-filter',
                            'required' => true
                        ],
                        [
                            'name' => "road",
                            'type' => "option_items_keynum",
                            'empty_value' => [""=>"Chọn Mặt tiền / Hẻm"],
                            'option_key' => "estate_road",
                            'class' => 'datatable-filter',
                        ],
                    ],
                    "right" => [
                        [
                            'name' => "road",
                            'type' => "option_items_keynum",
                            'empty_value' => [""=>"Chọn Mặt tiền / Hẻm"],
                            'option_key' => "estate_road",
                            'class' => 'datatable-filter',
                        ],
                    ]
                ]

            ]
        ],
        'option' =>[
            'paginate' => true,
        ],
        'theads' => [
            [
                'field' => 'id',
                'input' => 'icon',
                'class' => 'w-40 text-center',
                'class_thead' => 'w_40',
                'html' => '<i class="item-detail fa fa-plus"></i>',
            ],
            [
                'field' => 'id',
                'input' => 'no',
                'class' => 'w_50 text-center',
                'class_thead' => 'w_50',
                'text' => '#',
            ],

            [
                'field' => 'code',
                'text' => 'Mã phiếu',
                'type' => 'link_title',
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class' => 'text-center'
            ],
            [
                'field' => 'created_at',
                'text' => 'Ngày bán',
                'type' => 'datetime',
                'format' => 'full_day',
                'orderable' => 1,
                'class' => 'text-center'
            ],
            [
                'field' => 'customer_id',
                'text' => 'Khách hàng',
                'type' => 'form_drop',
                'table'=> 'customers',
                'table_field' => ['key' => "id", "value" => "full_name"],
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class' => 'text-left'
            ],
            [
                'field' => 'saler_id',
                'text' => 'Nhân viên',
                'type' => 'form_drop',
                'table'=> 'users',
                'table_field' => ['key' => "id", "value" => "full_name"],
                'display_filter' => "form_drop",
                'empty_value' => 'Thu ngân',
                'orderable' =>0,
                'editable' => 1,
                'required' => true,
                'class' => 'text-center text-hidden'
            ],
            // [
            //     'field' => 'store_id',
            //     'text' => 'Cửa hàng',
            //     'type' => 'form_drop',
            //     'table'=> 'store',
            //     'table_field' => ['key' => "id", "value" => "name"],
            //     'orderable' => 1,
            //     'editable' => 1,
            //     'required' => true,
            //     'class' => 'text-center'
            // ],
            [
                'field' => 'status',
                'text' => 'Trạng thái',
                'type' => 'form_drop',
                'empty_value' => 'Trạng thái',
                'table' => 'order_status',
                'table_field' => ['key' => "id", "value" => "name"],
                'display_filter' => "form_drop",
                'orderable' => 0,
                'editable' => 1,
                // 'required' => true,
                'class' => 'w_120  text-center'
            ],
            [
                'field' => 'total',
                'text' => 'Tổng tiền',
                'type'=>'decimal',
                'orderable' => 1,
                'editable' => 0,
                'class' => 'text-right  no-wrap bold',
            ],
            [
                'field' => 'debt',
                'text' => 'Nợ',
                'type' => 'decimal',
                'orderable' => 1,
                'editable' => 0,
                'class' => 'text-right  no-wrap red',
            ],

            [
                'field' => 'action',
                'text' => 'Hành động',
                'type' => 'action_include',
                'view' => 'admin::order.process_status',
                'class' => 'w_150 action text-center pr-15 nowrap',
                'class_thead' => 'w_150'
            ],
        ],
        'tfoots' =>[
            [
                'align' => 'right',
                'type' => 'paging',
            ],
        ],
    ],
];
