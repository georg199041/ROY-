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
					'name'                 => 'Core_Cache_Frontend_MasterFile',
					'customFrontendNaming' => true,
					'options'              => array(
						'label'                       => 'Кеш картинок рекомендаций',
						'automatic_serialization'     => true,
		    			'lifetime'                    => 3600000,
						'master_files'                => array(),
						'master_files_mode'           => Zend_Cache_Frontend_File::MODE_OR,
						'ignore_missing_master_files' => false,
					),
				),
				'backend'  => array(
					'name'    => 'Core_Cache_Backend_SlaveFile',
					'customBackendNaming' => true,
					'options' => array(
						'cache_dir' => PUBLIC_PATH . '/cache'
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