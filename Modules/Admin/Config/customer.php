<?php
return [
    'customer' => [
        'title' => 'Khách hàng',
        'option' =>[
            'paginate' => true,
        ],
        'actions' => [
            [
                'href' =>url("admin/customer/delete"),
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
                'class' => 'w_50',
                'class_thead' => 'w_50'
            ],
            [
                'field' => 'code',
                'text' => 'Mã KH',
                'type' => 'link_title',
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class' => 'w_100 text-center link_title',
                'class_thead' => 'w_100'
            ],

            [
                'field' => 'full_name',
                'text' => 'Họ và tên',
                'type' => 'text',
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class_thead' => 'w_200 text-center'
            ],
            [
                'field' => 'phone',
                'text' => 'SĐT',
                'type' => 'text',
                'orderable' => 1,
                'editable' => 1,
                'class_thead' => 'w-200  text-center'
            ],
            [
                'field' => 'email',
                'text' => 'Email',
                'type' => 'text',
                'viewable' => 0,
                'editable' => 1,
                'class' => 'w-100 text-center'
            ],
            [
                'field' => 'address',
                'text' => 'Địa chỉ',
                'type' => 'text',
                'class_thead' => "w_500 text_center",
                'class' => 'text_left',
                'orderable' => 1,
                'editable' => 1,
            ],
            [
				'field' => 'type',
				'text' => 'Nguồn',
				'type' => 'select',
                'align' => 'right',
                'data' => ['1'=>"Website",'2'=>''],
                'viewable' => 1,
				'class' => 'w_80 text-left',
                'rowClass' => 'col-12',
                'tag_group' => 'basic_information',
                'role' => [1, 2]
			],
            [
                'field' => 'note',
                'text' => 'Ghi chú',
                'type' => 'text',
                'viewable' => 0,
                'editable' => 1,
                'class' => 'text-center'
            ],
            [
                'field' => 'birthday',
                'text' => 'Sinh nhật',
                'type' => 'date',
                'viewable' => 0,
                'editable' => 1,
                'class' => 'w-80 text-center'
            ],
            [
                'field' => 'gender',
                'text' => 'Giới tính',
                'type' => 'select',
                'data' => ["Nam", "Nữ"],
                'viewable' => 0,
                'editable' => 1,
                'class' => 'w-80  text-center'
            ],
            [
                'field' => 'last_purchase',
                'text' => 'Lần cuối mua hàng',
                'type' => 'date',
                'format' => 'd/m/Y',
                'orderable' => 1,
                'editable' => 0,
                'required' => true,
                'class_thead' => 'w_150 text-center'
            ],
            [
                'field' => 'total_amount_of_goods',
                'text' => '	Tổng tiền hàng',
                'type' => 'decimal',
                'orderable' => 1,
                'editable' => 0,
                'required' => true,
                'class_thead' => 'w_150 text-right bold'
            ],
            [
                'field' => 'created_at',
                'text' => 'Ngày tạo',
                'type' => 'date',
                'format' => 'd/m/Y',
                'orderable' => 1,
                'editable' => 0,
                'required' => true,
                'class_thead' => 'w_150 text-center'
            ],
            [
                'text' => 'Hành động',
                'field' => 'action',
                'type' => 'action',
                'class' => 'w_150 action text-center',
                'class_thead' => 'w_150',
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
    ],
];
