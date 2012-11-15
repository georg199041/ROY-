<?php

return array(
	'resources' => array (
		'router' => array (
			'routes' => array (
				'contacts' => array (
					'type' => 'Zend_Controller_Router_Route',
					'route' => 'recommendations.html',
					'defaults' => array (
						'module' => 'recommendations',
						'controller' => 'index',
						'action' => 'index',
					),
				),
			),
		),
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
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
);