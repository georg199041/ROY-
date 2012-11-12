<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'contacts/admin-contacts/index' => array (
							'id'         => 'contacts/admin-contacts/index',
							'label'      => 'Contacts',
							'module'     => 'contacts',
							'controller' => 'admin-contacts',
							'action'     => 'index',
							'pages'      => array(
								'contacts/admin-groups/index' => array(
									'id'         => 'contacts/admin-groups/index',
									'label'      => 'Contacts groups',
									'module'     => 'contacts',
									'controller' => 'admin-groups',
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