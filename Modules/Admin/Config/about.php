<?php
return [
    'about' => [
        'title' => 'Hàng hóa',
        'icon' => "<i class='fa fa-barcode'></i>",
        'theads' => [
            [
                'field' => 'id',
                'text' => '#',
                'type' => 'no',
                'orderable' => 1,
                'editable' => 0,
                'class' => 'w_30'
            ],
            [
                'field' => 'name',
                'text' => 'Hàng hóa',
                'type' => 'link_title',
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class' => 'text-left',
                'tag_group' => 'basic_information',
            ],
            [
                'field' => 'sku',
                'text' => 'Mã hàng hóa',
                'type' => 'text',
                'orderable' => 1,
                'viewable' => 1,
                'editable' => 1,
                'class' => 'text-center',
                'tag_group' => 'basic_information',
            ],
            [
                'field' => 'sku',
                'text' => 'Số lượng tồn kho',
                'short_text' => "SL",
                'type' => 'text',
                'orderable' => 1,
                'viewable' => 1,
                'editable' => 1,
                'class' => 'text-left',
                'tag_group' => 'basic_information',
            ],
            [
                'field' => 'price',
                'text' => 'Giá bán',
                'type' => 'text',
                'editable' => 1,
                'viewable' => 1,
                'class' => 'text-right bold',
                'rowClass' => 'col-4 col-left',
                'tag_group' => 'basic_information',
            ],
            // [
            //     'field' => 'air_conditioning_system',
            //     'text' => 'Nhóm hàng',
            //     'type' => 'text',
            //     'editable' => 1,
            //     'viewable' =>1,
            //     'class' => 'text-left',
            //     'rowClass' => 'col-4 col-mid',
            //     'tag_group' => 'basic_information',
            // ],
            // [
            //     'field' => 'building_direction',
            //     'text' => 'Nhà sản xuất',
            //     'type' => 'text',
            //     'editable' => 1,
            //     'viewable' => 1,
            //     'class' => 'text-left',
            //     'rowClass' => 'col-4 col-right',
            //     'tag_group' => 'basic_information',
            // ],
            [
                'field' => 'image',
                'text' => 'Image',
                'type' => 'image',
                'editable' => 1,
                'align' => 'right',
            ],

            [
                'field' => 'action',
                'text' => '',
                'type' => 'action',
                'class' => 'w_90 action',
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
