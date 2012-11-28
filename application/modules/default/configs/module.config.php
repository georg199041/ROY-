<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'default/admin-index/frontpage' => array (
							'id'    => 'default/admin-index/frontpage',
							'type'  => 'Zend_Navigation_Page_Uri',
							'label' => 'Главная',
							'order' => -10,
						),
					),
				),
			),
		),
	),
);