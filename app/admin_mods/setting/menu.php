<?php

    // Dashboard
    MenuManager::addOption(array(
        'main' => array(
            'key'   => 'dashboard',
            'label' => 'Dashboard',
            'link'  => url('dashboard'),
            'role'  => 'login',
        ),
        'sub' => array(
            array(
                'key'   => 'basic',
                'label' => 'Dashboard',
                'link'  => url('dashboard'),
                'role'  => 'login',
            ),
            array(
                'key'   => 'advanced',
                'label' => 'Dashboard by manager',
                'link'  => url('dashboard/advanced',array('display'=>'advanced')),
                'role'  => 'manager',
            ),
            array(
                'key'   => 'developer',
                'label' => 'Dashboard by developer',
                'link'  => url('dashboard/developer'),
                'role'  => 'developer',
            ),
        )
    ));

    // 每一個登入者都可以看到的內容
    MenuManager::addOption(array(
        'main' => array(
            'key'       => 'about-me',
            'label'     => 'Me',
            'link'      => url('me'),
            'role'      => 'login',
        ),
        'sub' => array(
            array(
                'key'   => 'about-myself',
                'label' => 'About Me',
                'link'  => url('me'),
                'role'  => 'login',
            ),
            array(
                'key'   => 'modify-password',
                'label' => 'Change Password',
                'link'  => url('me/password'),
                'role'  => 'login',
            ),
            array(
                'key'   => 'show-logs',
                'label' => 'Show Logs',
                'link'  => url('me/logs'),
                'role'  => 'login',
            ),
        )
    ));

    // 系統功能
    MenuManager::addOption(array(
        'main' => array(
            'key'   => 'systemic',
            'link'  => url('systemic/config'),
            'role'  => 'manager',
        ),
        'sub' => array(
            array(
                'key'   => 'config',
                'link'  => url('systemic/config'),
                'role'  => 'manager',
            ),
            array(
                'key'   => 'environment',
                'link'  => url('systemic/environment'),
                'role'  => 'manager',
            ),
            array(
                'key'   => 'phalcon',
                'link'  => url('systemic/phalcon'),
                'role'  => 'manager',
            ),
            array(
                'key'   => 'gearman',
                'link'  => url('systemic/gearman'),
                'role'  => 'developer',
            ),
            array(
                'key'   => 'memcache',
                'link'  => url('systemic/memcache'),
                'role'  => 'developer',
            ),
            array(
                'key'   => 'passwd',
                'link'  => url('systemic/passwd'),
                'role'  => 'developer',
            )
        )
    ));
