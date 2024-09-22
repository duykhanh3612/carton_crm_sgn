<?php
return [
    'pages' => [
        'title' => 'Pages',
        'icon' => "<i class='fa fa-barcode'></i>",
        'custom_link' => url("admin/pages"),
        'actions' => [
            [
                'href' =>url("admin/pages/delete"),
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
                'class' => 'w_50 text-center',
                'class_thead' => 'w_50 ',
                'editable'=> 0,
                'text' => '#',
            ],
            [
                'field' => 'name',
                'text' => 'Tiêu đề',
                'type' => 'link_title',
                'orderable' => 1,
                'editable' => 1,
                'required' => true,
                'class' => 'text-left',
                'tag_group' => 'basic_information',
            ],

            [
                'field' => 'description',
                'text' => 'Mô tả',
                'type' => 'fck_editor',
                'viewable' => 0,
                'editable' => 1,
                'class' => 'text-left',
                'tag_group' => 'basic_information',
            ],
            [
                'field' => 'content',
                'text' => 'Nội dung chi tiết',
                'type' => 'fck_editor',
                'viewable' => 0,
                'editable' => 1,
                'class' => 'text-right bold',
                'class' => 'text-left',
                'tag_group' => 'basic_information',
            ],
            [
                'field' => 'image',
                'text' => 'Ảnh',
                'type' => 'image',
                'editable' => 1,
                'align' => 'right',
            ],
            // [
            //     'field' => 'gallery',
            //     'text' => 'Gallery',
            //     'type' => 'gallery',
            //     'viewable' => 0,
            //     'editable' => 1,

            // ],
            [
                'field' => 'updated_at',
                'text' => 'Cập nhật lần cuối',
                'type' => 'date',
                'viewable' => 1,
                'editable' => 0,

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
    ],
];
