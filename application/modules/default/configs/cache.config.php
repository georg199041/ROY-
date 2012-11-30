<?php
return array (
  'resources' => 
  array (
    'cachemanager' => 
    array (
      'default' => 
      array (
        'frontend' => 
        array (
          'name' => 'Core',
          'options' => 
          array (
            'automatic_serialization' => true,
          ),
        ),
        'backend' => 
        array (
          'name' => 'File',
          'options' => 
          array (
          ),
        ),
      ),
      'page' => 
      array (
        'frontend' => 
        array (
          'name' => 'Capture',
          'options' => 
          array (
            'ignore_user_abort' => true,
          ),
        ),
        'backend' => 
        array (
          'name' => 'Static',
          'options' => 
          array (
            'public_dir' => '../public',
          ),
        ),
      ),
      'pagetag' => 
      array (
        'frontend' => 
        array (
          'name' => 'Core',
          'options' => 
          array (
            'automatic_serialization' => true,
            'lifetime' => NULL,
          ),
        ),
        'backend' => 
        array (
          'name' => 'File',
          'options' => 
          array (
          ),
        ),
      ),
      'configuration' => 
      array (
        'frontend' => 
        array (
          'name' => 'Core',
          'options' => 
          array (
            'lifetime' => '7200',
            'automatic_serialization' => '1',
          ),
        ),
        'backend' => 
        array (
          'name' => 'Apc',
        ),
      ),
      'DefaultModule' => 
      array (
        'frontend' => 
        array (
          'name' => 'Core',
          'options' => 
          array (
            'automatic_serialization' => true,
            'lifetime' => 86400,
          ),
        ),
        'backend' => 
        array (
          'name' => 'File',
          'options' => 
          array (
            'cache_dir' => 'W:\\htdocs\\roy/data/cache',
          ),
        ),
      ),
    ),
  ),
);
