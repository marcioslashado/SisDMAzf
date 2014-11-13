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
            'Contatos\Controller\Index' => 'Contatos\Controller\IndexController'
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'contatos' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Contatos\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'listacontatos' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/listacontatos',
                    'defaults' => array(
                        'controller' => 'Contatos\Controller\Index',
                        'action'     => 'listacontatos',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'contatos' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/contatos',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Contatos\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
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
            'contatos/index/index' => __DIR__ . '/../view/contatos/index/index.phtml',
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
