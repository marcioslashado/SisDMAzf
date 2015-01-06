<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    
    /** 
     * Conecta ao banco de dados.
     * Conexão realizada via CONFIG pois trata-se de um módulo independente e, portanto, 
     * necessita de conexão à base de dados independentemente do sistema.
     */
//    'db' => array(
//        'driver' => 'Pdo',
//        'dsn'            => 'mysql:dbname=maff_zf;hostname=localhost',
//        'username'       => 'root',
//        'password'       => '',
//        'driver_options' => array(
//            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
//        ),
//    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Agenda\Controller\Index' => 'Agenda\Controller\IndexController'
        ),
    ),
    
    'router' => array(
        'routes' => array(
            //Agenda Index, Add, Edit, Delete
            'agenda' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/agenda[/:action][/:form_codigo]',
                    'defaults' => array(
                        'controller' => 'Agenda\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'agenda/index/index' => __DIR__ . '/../view/agenda/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
