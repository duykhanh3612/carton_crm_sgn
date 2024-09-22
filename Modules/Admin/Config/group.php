
<?php
return [
    'group' => [
        'title' => 'Group',
        'theads' => [
            [
                'field' => 'id',
                'text' => '#',
                'orderable' => 1,
                'editable' => 0
            ],
            [
                'field' => 'name',
                'text' => 'Group',
                'type' => 'text',
            ],
            [
                'field' => 'permissions',
                'text' => 'Permission',
                'type' => 'role_group',
                'viewable' => 0,
                'editable' => 1
            ],
            [
                'field' => 'status',
                'text' => 'Trạng thái',
                'type' => 'select',
                'data' => ['1'=>'Active','0'=>'Non-Actice'],
                'align' => 'right'
            ],
            [
                'field' => 'permissions_name',
                'text' => '',
                'editable' => 0
            ],

            [
                'field' => 'action',
                'text' => 'OPERATIONS',
                'type' => 'action',
                'class' => 'width_80',
                'editable' => 0
            ],
        ]
    ],
];

