<?php
return [
    'shipment' => [
        'title' => 'Phí vận chuyển',
        'option' =>[
            'paginate' => true,
        ],
        'actions' => [
            [
                'href' =>url("admin/shipment/delete"),
                'class' => 'action-delete',
                'label' => 'Xóa',
                'title' => 'Xóa',
                'icon' => 'fa fa-trash-alt'
            ],
        ],
        'theads' => [
            [
                'field' => 'id',
                'input' => 'no',
                'text' => '#',
                'editable' => 0,
                'class' => 'w_70',
                'class_thead' => 'w_70'
            ],
            [
                'field' => 'name',
                'text' => 'Áp dụng tại',
                'type' => 'link_title',
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class' => ' text-left',
                'class_text' => 'tex-wrap',
                'class_thead' => '',
                'rowClass' => 'form-group',
            ],

            [
                'field' => 'district_id[]',
                'type' => 'geo_district',
                'table'=> 'geo_district',
                'table_field' => ['key' => "id", "value" => "name"],
                'table_where' => "province_id=79",
                'text' => 'Quận/Huyện',
                'rowClass' => 'form-group',
                'orderable' => 1,
                'viewable' => 0,
                'class' => 'text-left select2',
                'multiple' => true,
                'tag_group' => 'place',
            ],
            [
                'field' => 'fee',
                'text' => 'Phí vận chuyển',
                'type' => 'decimal',
                'orderable' => 1,
                'editable' => 1,
                'class' => 'text-right',
                'class_thead' => '',
                'rowClass' => 'form-group',
            ],
            [
                'field' => 'price_from',
                'text' => 'Đơn hàng từ',
                'type' => 'decimal',
                'viewable' => 1,
                'editable' => 1,
                'class' => ' text-right',
                'rowClass' => 'form-group',
            ],
            [
                'field' => 'price_to',
                'text' => 'Đơn hàng đến',
                'type' => 'decimal',
                'viewable' =>1,
                'editable' => 1,
                'class' => ' text-right',
                'rowClass' => 'form-group',
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
    ],
];
