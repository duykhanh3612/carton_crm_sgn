
<?php
return [
    'user' => [
        'title' => 'user',
        'theads' => [
            [
                'field' => 'id',
                'text' => '#',
                'orderable' => 1
            ],
            [
                'field' => 'fullname',
                'text' => 'Name',
                'orderable' => 1,
                'editable' => 1,
            ],
            [
                'field' => 'email',
                'text' => 'text',
                'orderable' => 1,
                'editable' => 1,
            ],

            [
                'field' => 'status',
                'text' => 'Trạng thái',
                'type' => 'public',
                'editable' => 1,
                'align' => 'right',
            ],
            [
                'field' => 'created_at',
                'text' => 'CREATED AT',
                'type' => 'datetime',
                'format' => 'd-m-Y',
            ],

            [
                'field' => 'action',
                'text' => 'OPERATIONS',
                'type' => 'action',
                'class' => 'width_80'
            ],
        ]
    ],
];

