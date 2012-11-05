<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'navigation/admin-pages/index' => array (
							'id'         => 'navigation/admin-pages/index',
							'type'       => 'Zend_Navigation_Page_Mvc',
							'label'      => 'Navigation',
							'module'     => 'navigation',
							'controller' => 'admin-pages',
							'action'     => 'index',
						),
					),
				),
			),
		),
	),
);