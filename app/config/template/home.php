<?php

/**
 *  設置規定:
 *
 *      所有路徑最後面都不能包含 "/" 符號
 *
 */

$basePath = '/var/www/sso-manager';

return [

    /**
     *  base path
     *  base url
     */
    'base' => [
        'path' => $basePath,
        'url'  => '/sso-manager',
    ],

    /**
     *  resource path
     */
    'resource' => [
        'path' => $basePath . '/home/media',
        'url'  => '/media',
    ]

];
