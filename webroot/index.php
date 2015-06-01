<?php
require __DIR__.'/config_with_app.php';

$di  = new \Anax\DI\CDIFactoryDefault();

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
    $db->connect();
    return $db;
});

$di->set('form', '\Mos\HTMLForm\CForm');

$app = new \Anax\Kernel\CAnax($di);
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_login.php');

$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});



$app->router->add('', function() use ($app) {

      $app->theme->setTitle("Logga in");
      $app->dispatcher->forward([
          'controller' => 'users',
          'action'     => 'login',
      ]);

});

$app->router->handle();
$app->theme->render();
