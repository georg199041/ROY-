<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'contents/admin' => array (
							'id'    => 'contents/admin',
							'type'  => 'Zend_Navigation_Page_Uri',
							'label' => 'Contents',
							'pages' => array(
								'contents/admin-categories/index' => array (
									'id'         => 'contents/admin-categories/index',
									'label'      => 'Categories',
									'module'     => 'contents',
									'controller' => 'admin-categories',
									'action'     => 'index',
								),
								'contents/admin-posts/index' => array (
									'id'         => 'contents/admin-posts/index',
									'label'      => 'Posts',
									'module'     => 'contents',
									'controller' => 'admin-posts',
									'action'     => 'index',
								),
								'contents/admin-static-posts/index' => array (
									'id'         => 'contents/admin-static-posts/index',
									'label'      => 'Static posts',
									'module'     => 'contents',
									'controller' => 'admin-static-posts',
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