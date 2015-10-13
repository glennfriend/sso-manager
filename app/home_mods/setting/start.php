<?php

    // Create a DI
    // http://phalcon.5iunix.net/reference/di.html
    // $di = new Phalcon\DI\FactoryDefault();
    $di = new Phalcon\DI();


    // url
    $di->set('escaper', new Phalcon\Escaper );
    $di->set('url', new Phalcon\Mvc\Url );
    $di->get('url')->setBaseUri( Config::get('home.base.url') .'/' );
    UrlManager::init(array(
        'baseUri' => Config::get('home.base.url')
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
    /*
    $di->set('db', function() {
        return new Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host"      => 'localhost',
            "username"  => 'root',
            "password"  => '',
            "dbname"    => 'test',
        ));
    });
    */


    /*
    $di->set('cookies', function() {
        $cookies = new Phalcon\Http\Response\Cookies();
        $cookies->useEncryption(false);
        return $cookies;
    });
    */


    $di->set('router', function () {
        require Config::get('home.base.path') . '/app/'. APP_PORTAL .'_mods/setting/router.php';
        return $router;
    });


    InputBrg::init($di);


    /*
        $translation = function()
        {
            $language = $this->request->getBestLanguage();
            if (file_exists("app/messages/".$language.".php")) {
                require "app/messages/".$language.".php";
            } else {
                require "app/messages/en.php";
            }

            $message = new \Phalcon\Translate\Adapter\NativeArray(array(
               "content" => $messages
            ));
        }
        $message = $translation();
    */


    //Handle the request
    return new Phalcon\Mvc\Application($di);
