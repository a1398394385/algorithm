<?php
define('BASEDIR', __DIR__);

include BASEDIR.'/Loader/Loader.php';
spl_autoload_register('\\Loader\\Loader::autoload');

App\Models\Test::index();
App\Controller\TestController::index();