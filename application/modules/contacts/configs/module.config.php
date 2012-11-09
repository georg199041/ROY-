<?php

return array(
	'resources' => array (
		'navigation' => array (
			'pages' => array (
				'default/admin-index/index' => array (
					'pages' => array(
						'contacts/admin-contacts/index' => array (
							'id'         => 'contacts/admin-contacts/index',
							'type'       => 'Zend_Navigation_Page_Mvc',
							'label'      => 'Contacts',
							'module'     => 'contacts',
							'controller' => 'admin-contacts',
							'action'     => 'index',
						),
					),
				),
			),
		),
	),
);