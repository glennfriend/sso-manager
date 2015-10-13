<?php
header('Content-Type: text/html; charset=utf-8');
define('APP_PORTAL','admin');
require_once '../../app/init.php';

try {

    $app = $factoryApplication();

} catch( \Phalcon\Exception $e ) {

    if ( !UserManager::isAdmin() ) {
        echo "<h1>Page not found: 804001</h1>";
        exit;
    }

    echo "PhalconException: ", $e->getMessage();
    echo '<p>';
    echo    nl2br(htmlentities( $e->getTraceAsString() ));
    echo '</p>';

}

if ( !UserManager::isAdmin() ) {
    echo "Permission Deny";
    exit;
}

phpinfo();

