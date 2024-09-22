<?php
return [
    'product' => [
        'title' => 'SẢN PHẨM',
        'icon' => "<i class='fa fa-barcode'></i>",
        'actions' => [
            [
                'href' =>url("admin/product/delete"),
                'class' => 'action-delete',
                'label' => 'Xóa',
                'title' => 'Xóa',
                'icon' => 'fa fa-trash-alt'
            ],
        ],
        'option' =>[
            'paginate' => true,
        ],
        'theads' => [
            [
                'field' => 'id',
                'text' => '#',
                'input' => 'no',
                'orderable' => 1,
                'editable' => 0,
                'class' => 'w_50',
                'class_thead' => 'w_50'
            ],
            [
                'field' => 'name',
                'text' => 'Tên sản phẩm',
                'type' => 'link_title',
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class' => ' text-left',
                'class_thead' => 'w_500',
                'tag_group' => 'basic_information',
            ],
            // [
            //     'field' => 'sku',
            //     'text' => 'Mã sản phẩm',
            //     'type' => 'text',
            //     'orderable' => 1,
            //     'viewable' => 1,
            //     'editable' => 1,
            //     'class' => 'text-center',
            //     'tag_group' => 'basic_information',
            // ],
            [
                'field' => 'product_category_id',
                'text' => 'Danh mục',
                'type' => 'form_drop',
                'empty_value' => 'danh mục',
                'table' => 'product_category',
                'table_field' => ['key' => "id", "value" => "name"],
                'display_filter' => "form_drop",
                'orderable' => 0,
                'editable' => 1,
                'class' => 'text-center'
            ],
            [
                'field' => 'price',
                'text' => 'Giá bán',
                'type' => 'decimal',
                'editable' => 1,
                'viewable' => 1,
                'class' => 'text-right format_price bold',
                'rowClass' => 'col-4 col-left',
                'tag_group' => 'basic_information',
            ],
            [
                'field' => 'image',
                'text' => 'Ảnh',
                'type' => 'image',
                'viewable' => 1,
                'class_thead' => 'w_150',
                'class' => ' text-center',
                'align' => 'right',
            ],
            [
                'field' => 'published',
                'text' => 'Website',
                'type' => 'select',
                'data' => ['1'=>"Hiện thị",'0'=>''],
                'editable' => 1,
                'viewable' => 1,
                'class_thead' => 'w_80 text-center',
                'class' => '',
                'rowClass' => 'col-12',
                'tag_group' => 'basic_information',
                'role' => [1, 2]
            ],
            [
                'field' => 'action',
                'text' => 'Hành động',
                'type' => 'action',
                'class_thead'=> 'w_150',
                'class' => 'w_150 action text-center',
                'text_class' => 'd-flex gap-10',
                'editable' => 0,
            ],
        ],
        'tfoots' =>[
            [
                'align' => 'right',
                'type' => 'paging',
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
    ],
];
