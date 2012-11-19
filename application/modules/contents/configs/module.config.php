<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'contents/admin-posts/index' => array (
							'id'         => 'contents/admin-posts/index',
							'label'      => 'Контент',
							'module'     => 'contents',
							'controller' => 'admin-posts',
							'action'     => 'index',
							'pages' => array(
								'contents/admin-categories/index' => array (
									'id'         => 'contents/admin-categories/index',
									'label'      => 'Категории контента',
									'module'     => 'contents',
									'controller' => 'admin-categories',
									'action'     => 'index',
								),
							),
						),
					),
				),
			),
		),
	),
);