<?php
return [
	'geo_province' => [
		'title' => 'Tỉnh Thành',
		'theads' => [
			[
				'field' => 'id',
				'text' => '#',
				'orderable' => 1
			],
			[
				'field' => 'name',
				'text' => 'Tỉnh thành',
				'type' => 'text',
				'orderable' => 1,
				'editable' => 1,
				'required' => true,
				'class' => 'text-left'
			],
            [
				'field' => 'type',
				'text' => 'Type',
				'orderable' => 1,
				'editable' => 0,
				'class' => 'text-left  no-wrap',
			],

			[
				'field' => 'action',
				'text' => 'Thao tác',
				'type' => 'action',
				'class' => 'width_80'
			],
		]
	],
];
