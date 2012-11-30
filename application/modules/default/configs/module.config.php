<?php

return array(
	'resources' => array (
		'cachemanager' => array(
			'DefaultModule' => array(
				'frontend' => array(
					'name'    => 'Core',
					'options' => array(
						'automatic_serialization' => true,
		    			'lifetime'                => 86400,
					),
				),
				'backend'  => array(
					'name'    => 'File',
					'options' => array(
						'cache_dir' => ROOT_PATH . '/data/cache'
					),
				),
			),
		),
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
						'default/admin-cache/index' => array (
							'id'         => 'default/admin-cache/index',
							'label'      => 'Кеш',
							'order'      => -1,
							'module'     => 'default',
							'controller' => 'admin-cache',
							'action'     => 'index'
						),
					),
				),
			),
		),
	),
);