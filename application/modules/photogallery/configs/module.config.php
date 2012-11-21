<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'photogallery' => array (
					'type'     => 'Zend_Controller_Router_Route',
					'route'    => 'photogallery',
					'defaults' => array (
						'module'     => 'photogallery',
						'controller' => 'index',
						'action'     => 'index',
					),
				),
				'photogallery_album' => array (
					'type'     => 'Zend_Controller_Router_Route',
					'route'    => 'photogallery/:album_alias',
					'defaults' => array (
						'module'     => 'photogallery',
						'controller' => 'index',
						'action'     => 'album',
						'album_alias'      => '',
					),
				),
			),
		),
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'photogallery/admin-images/index' => array (
							'id'         => 'photogallery/admin-images/index',
							'label'      => 'Фотогалерея',
							'module'     => 'photogallery',
							'controller' => 'admin-images',
							'action'     => 'index',
							'pages' => array(
								'photogallery/admin-albums/index' => array (
									'id'         => 'photogallery/admin-albums/index',
									'label'      => 'Альбомы фотогалереи',
									'module'     => 'photogallery',
									'controller' => 'admin-albums',
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