<?php

return [
	'field_template' => [
		'title' => 'Sản phẩm',
        "title_icon" => "<i class='fa fa-city'></i>",
        "custom_link_by_field" =>[
            'type' => [
                'office_floor' =>   url("admin/estates"),
                'other' =>  url("admin/estates_other")
            ]
        ],
        'option' =>[
            //"top_paginate" => []
            "paginate" => [
                'align' => 'right',
                'type' => 'paging',
            ],
            "include" =>[
                "admin::estate.script_other"
            ],
            'table_wrapper' => 'table-row',
            "class_buttons" =>  'panel-button',
        ],
        'buttons' => [
            [
                'href' =>url("admin/estates_other/create"),
                'class' => 'btnRed',
                'label' => 'Tạo mới',
                'title' => 'Tạo mới',
                'icon' => 'fa-plus'
            ]
        ],
        'filters' => [
            [
                'name' => 'keywords',
                'placeholder' => __('Nhập tên sản phẩn / Mã / Giá sản phẩm') . ':',
                'value' => "keywords",
                'class' => 'w_500'
            ],
            [
                'name' => "availability",
                'type' => "option_items_keynum",
                'empty_value' => [""=>"Tất cả"],
                'option_key' => "availability",
                'class' => 'datatable-filter',
            ],
            [
                'name' => "road",
                'type' => "option_items_keynum",
                'empty_value' => [""=>"Chọn Mặt tiền / Hẻm"],
                'option_key' => "estate_road",
                'class' => 'datatable-filter',
            ],
            [
                'name' => 'type',
                'type' => 'form_drop',
                'table' => 'estates_group',
                'table_field' => ['key' => "slug", "value" => "name"],
                'table_where' => "",
                'table_value_except' => ["office_floor"],
                'viewable' => 0,
                'editable' => 1,
                'defaultValue' => true,
                'class' => 'text-left datatable-filter',
                'required' => true
            ],
            [
                'name' => "search",
                'type' => "submit",
                'value' => "Tìm kiếm",
                'icon' => "<i class='fa fa-search'></i>"
            ],
        ],
		'theads' => [
			[
                'field' => 'wide_length',
				'fields' => ['wide','length'],
                'symbol' => 'x',
				'text' => 'Ngang x Dài',
				'type' => 'column',
                'viewable' => 1,
				'orderable' => 1,
				'editable' => 0,
				'class' => 'text-left',
			],
		],

        'setting'=>[
            'has_tag' => true,
            'tag_groups'=>[
                'basic_information' => 'Thông tin chung',
                'rent_and_area' => 'Giá thuê và diện tích',
                'place' => 'Địa chỉ',
                'cost_control'=>'Giá thuê',
                'contact_information' => 'Thông tin liên hệ (*)',
                'source' => 'Nguồn nhập',
                'images' => 'Hình ảnh',
                'description' => 'Mô tả'
            ],
        ]
	],
];
