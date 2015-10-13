<?php

    /**
     *  @see http://phalcon.5iunix.net/reference/routing.html
     */
    $router = new \Phalcon\Mvc\Router(true);

    // default
    $router->add('/', array(
        'controller' => 'public',
        'action'     => 'index',
    ));
