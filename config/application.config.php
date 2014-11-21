<?php
return array(
    
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Users',
        'UsersACL',
        'Home',
        'Contatos',
        'Ligacoes',
        'Comunicacoes',
        'Grupos',
        'Agenda',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php'
        )
    )
);
