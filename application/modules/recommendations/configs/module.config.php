<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'recommendations' => array (
					'type'  => 'Zend_Controller_Router_Route_Static',
					'route' => 'recommendations.html',
					'label' => 'Рекомендации',
					'defaults' => array (
						'module'     => 'recommendations',
						'controller' => 'index',
						'action'     => 'index',
					),
				),
			),
		),
		'cachemanager' => array(
			'Recomendations' => array(
				'frontend' => array(
					'name'                 => 'Core_Image_Cache_Frontend_Image',
					'customFrontendNaming' => true,
					'options'              => array(
						'label'                    => 'Кеш картинок рекомендаций',
						'lifetime'                 => 3600000,
						'image_master_check_mtime' => true,
						'logging'                  => false,
					),
				),
				'backend'  => array(
					'name'    => 'Core_Image_Cache_Backend_Image',
					'customBackendNaming' => true,
					'options' => array(
						'cache_dir'        => 'cache',
						'image_processing' => array(
							array('method' => 'setCompression', 'arguments' => array(60)),
							array('method' => 'resizeToCrop', 'arguments' => array(104, 70)),
						),
					),
				),
			),
			'Recomendations2' => array(
				'frontend' => array(
					'name'                 => 'Core_Image_Cache_Frontend_Image',
					'customFrontendNaming' => true,
					'options'              => array(
						'label'                    => 'Кеш картинок рекомендаций',
						'lifetime'                 => 3600000,
						'image_master_check_mtime' => true,
						'logging'                  => false,
					),
				),
				'backend'  => array(
					'name'    => 'Core_Image_Cache_Backend_Image',
					'customBackendNaming' => true,
					'options' => array(
						'cache_dir'        => 'cache_width570',
						'image_processing' => array(
							array('method' => 'setCompression', 'arguments' => array(70)),
							array('method' => 'resizeToWidth', 'arguments' => array(570)),
						),
					),
				),
			),
		),
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'default/admin-index/modules' => array (
							'pages' => array(
								'recommendations/admin-posts/index' => array (
									'id'         => 'recommendations/admin-posts/index',
									'label'      => 'Рекоммендации',
									'module'     => 'recommendations',
									'controller' => 'admin-posts',
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