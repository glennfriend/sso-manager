<?php

    $roles = array(
        'lowest'    => 'login',
        'manager'   => 'manager',
        'developer' => 'developer',
    );

    // Dashboard
    MenuManager::addOption(array(
        'main' => array(
            'key'   => 'dashboard',
            'label' => 'Dashboard',
            'link'  => url('dashboard'),
            'role'  => $roles['lowest'],
        ),
        'sub' => array(
            array(
                'key'   => 'basic',
                'label' => 'Dashboard',
                'link'  => url('dashboard'),
                'role'  => $roles['lowest'],
            ),
            array(
                'key'   => 'advanced',
                'label' => 'Dashboard by manager',
                'link'  => url('dashboard/advanced',array('display'=>'advanced')),
                'role'  => $roles['manager'],
            ),
            array(
                'key'   => 'developer',
                'label' => 'Dashboard by developer',
                'link'  => url('dashboard/developer'),
                'role'  => $roles['developer'],
            ),
        )
    ));

    // 系統功能
    MenuManager::addOption(array(
        'main' => array(
            'key'   => 'systemic',
            'link'  => url('systemic/config'),
            'role'  => $roles['manager'],
        ),
        'sub' => array(
            array(
                'key'   => 'config',
                'link'  => url('systemic/config'),
                'role'  => $roles['manager'],
            ),
            array(
                'key'   => 'environment',
                'link'  => url('systemic/environment'),
                'role'  => $roles['manager'],
            ),
            array(
                'key'   => 'phalcon',
                'link'  => url('systemic/phalcon'),
                'role'  => $roles['manager'],
            ),
            array(
                'key'   => 'memcache',
                'link'  => url('systemic/memcache'),
                'role'  => $roles['developer'],
            ),
            array(
                'key'   => 'passwd',
                'link'  => url('systemic/passwd'),
                'role'  => $roles['developer'],
            )
        )
    ));

