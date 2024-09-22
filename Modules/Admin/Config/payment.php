<?php
return [
    'payment' => [
        'title' => 'Thu chi',
        'filters' => [
            [
                'name' => 'keywords',
                'placeholder' =>  __('Nhập mã đơn hoặc mã/họ tên/SĐT khách hàng/NCC và enter') . ':',
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ],
            "children" => [
                "left" => [
                    [
                        'name' => "filter[payment_type]",
                        'field_name' => 'payment_type',
                        'type' => "option_items_keynum",
                        'option_key' => 'payment_type',
                        'defaultValue' => true,
                        'empty_value' => [""=>"----  Phương thức ----"],
                        'class' => 'datatable-filter',
                    ],
                ],
                "right" => [
                    [
                        'name' => "filter[created_at]",
                        'field_name' => 'created_at',
                        'type' => "choose_date",
                    ],
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
                'class' => 'w-40',
                'class_thead' => 'w_40',
                'html' => '<i class="item-detail fa fa-plus"></i>',
            ],
            [
                'field' => 'id',
                'input' => 'no',
                'class' => 'w_50',
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
                'text' => 'Khách hàng <br/> Nhà cung cấp',
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
                'class' => 'text-center'
            ],

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
                'class' => 'text-center'
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
