<?php

    // Create a DI
    // http://phalcon.5iunix.net/reference/di.html
    // $di = new Phalcon\DI\FactoryDefault();
    $di = new Phalcon\DI();


    // url
    $di->set('escaper', new Phalcon\Escaper );
    $di->set('url', new Phalcon\Mvc\Url );
    $di->get('url')->setBaseUri( Config::get('admin.base.url') .'/' );
    UrlManager::init(array(
        'baseUri' => Config::get('admin.base.url')
    ));


    // load js, css
    $di->set('assets', new Phalcon\Assets\Manager );

    // flash
    $di->set('flash', new Phalcon\Flash\Direct );

    // request
    $di->set('request', new Phalcon\Http\Request );

    // response
    $di->set('response', new Phalcon\Http\Response );


    // view component
    $di->set('view', function() {
        $view = new Phalcon\Mvc\View;
        $view->setViewsDir( Config::get('home.base.path') . '/app/'. APP_PORTAL .'_mods/views/' );
        return $view;
    });

    //
    $di->set('dispatcher', new Phalcon\Mvc\Dispatcher );

    //
    $di->set('router', function () {
        require Config::get('home.base.path') . '/app/'. APP_PORTAL .'_mods/setting/router.php';
        return $router;
    });

    //
    InputBrg::init($di);

    //Handle the request
    return new Phalcon\Mvc\Application($di);
