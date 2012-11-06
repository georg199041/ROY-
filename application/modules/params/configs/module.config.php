<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'params/admin' => array (
							'id'    => 'params/admin',
							'type'  => 'Zend_Navigation_Page_Uri',
							'label' => 'Params',
							'pages' => array(
								'params/admin-categories/index' => array (
									'id'         => 'params/admin-categories/index',
									'label'      => 'Categories',
									'module'     => 'params',
									'controller' => 'admin-categories',
									'action'     => 'index',
								),
								'params/admin-names/index' => array (
									'id'         => 'params/admin-names/index',
									'label'      => 'Names',
									'module'     => 'params',
									'controller' => 'admin-names',
									'action'     => 'index',
								),
								'params/admin-sources/index' => array (
									'id'         => 'params/admin-sources/index',
									'label'      => 'Sources',
									'module'     => 'params',
									'controller' => 'admin-sources',
									'action'     => 'index',
								),
								'params/admin-types/index' => array (
									'id'         => 'params/admin-types/index',
									'label'      => 'Types',
									'module'     => 'params',
									'controller' => 'admin-types',
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