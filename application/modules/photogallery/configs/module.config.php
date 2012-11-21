<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'photogallery' => array (
					'type'     => 'Zend_Controller_Router_Route_Static',
					'route'    => 'photogallery.html',
					'defaults' => array (
						'module'     => 'photogallery',
						'controller' => 'index',
						'action'     => 'index',
					),
				),
				'photogallery_album' => array (
					'type'     => 'Zend_Controller_Router_Route_Regex',
					'route'    => 'photogallery/(.*).html',
					'defaults' => array (
						'module'      => 'photogallery',
						'controller'  => 'index',
						'action'      => 'album',
						'album_alias' => '',
					),
					'map' => array(1 => 'album_alias'),
					'reverse' => 'photogallery/%s.html'
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