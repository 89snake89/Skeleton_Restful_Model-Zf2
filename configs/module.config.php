<?php
return array(
    'errors' => array(
        'post_processor' => 'json-pp',
        'show_exceptions' => array(
        	'message' => true,
        	'trace'   => true
        )
    ),
    'di' => array(
        'instance' => array(
        	'alias' => array(
        		'json-pp'  => 'Main\PostProcessor\Json',
        		'image-pp' => 'Main\PostProcessor\Image',
        		'xml-pp' => 'Main\PostProcessor\Xml',
        	)
        )
    ),
    'controllers' => array(
        'invokables' => array(
        	'info' => 'Main\Controller\InfoController',
        )
    ),
    'router' => array(
        'routes' => array(
            'restful' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/rest[/:formatter]',
                    'constraints' => array(
                        'formatter' => '[a-zA-Z0-9_-]*',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => '[/:controller[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*'
                            ),
                        ),
                    ),
                ),
            ),

        ),
    ),
);
