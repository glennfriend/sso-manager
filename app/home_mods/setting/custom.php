<?php

    SessionBrg::init($di);
    CookiesBrg::init($di);

    // menu
    $getMenu = function() {
        require_once Config::get('home.base.path') . '/app/'. APP_PORTAL .'_mods/setting/menu.php';
    };
    $getMenu();

    /**
     *  zend loader
     */
    $zendLoader = function()
    {
        $basePath = Config::get('home.base.path');
        require_once $basePath . '/app/vendors/Zend/Loader/StandardAutoloader.php';
        
        $loader = new Zend\Loader\StandardAutoloader(array(
            'autoregister_zf' => true,
            'namespaces' => array(
                'Ydin'    => $basePath . '/app/vendors/Ydin',
                'Imagine' => $basePath . '/app/vendors/Imagine',
            ),
        ));
        $loader->register();
    };
    $zendLoader();

