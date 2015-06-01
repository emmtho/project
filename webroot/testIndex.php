<?php
require __DIR__.'/config_with_app.php';

$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

if(!$app->session->get('id')){
  $url = $di->url->create('../index.php/users/login');
  $di->response->redirect($url);
}
else{
  $di->setShared('db', function() {
      $db = new \Mos\Database\CDatabaseBasic();
      $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
      $db->connect();
      return $db;
    });

    $di->set('form', '\Mos\HTMLForm\CForm');

    $di->set('CommentdbController', function() use ($di) {
      $controller = new Anax\CommentDB\CommentdbController();
      $controller->setDI($di);
      return $controller;
    });

    $di->set('QuestionController', function() use($di) {
      $controller = new Anax\Question\QuestionController();
      $controller->setDI($di);
      return $controller;
    });

    $di->set('CommentController', function() use ($di) {
      $controller = new Phpmvc\Comment\CommentController();
      $controller->setDI($di);
      return $controller;
    });

    $di->set('AnswerController', function() use ($di){
      $controller = new Anax\Answer\AnswerController();
      $controller->setDI($di);
      return $controller;
    });

    $di->set('UsersController', function() use ($di) {
      $controller = new \Anax\Users\UsersController();
      $controller->setDI($di);
      return $controller;
    });

    $di->set('TagsController', function() use($di){
      $controller = new Anax\Tags\TagsController();
      $controller->setDI($di);
      return $controller;
    });


    $app->router->add('', function() use ($app) {
 	    $app->theme->setTitle("Startsidan");

      $app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'visa',
        'params'     => [5,"DESC"],
        ]);

      $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'view',
        'params'     => [5,"DESC"],
        ]);

      $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'index',
        'params'     => [5,"DESC"],
        ]);


    });

    $app->router->add('about', function () use ($app){
      $app->theme->setTitle('Om oss');
      $content = $app->fileContent->get('me.md');
      $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

      $byline = $app->fileContent->get('byline.md');
      $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

      $app->views->add('me/page', [
       'content' => $content,
       'footer' => $byline,

       ]);
    });

    $app->router->add('comment', function() use ($app) {
      $app->theme->setTitle("Redovisning");
      $app->views->add('comment/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
        'questionID' => $this->question->getId(),
      ]);


      $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
        'params' => ['comment'],
      ]);
    });

    $app->router->add('source', function() use ($app) {
      $app->theme->addStylesheet('css/source.css');
      $app->theme->setTitle("Källkod");

      $source = new \Mos\Source\CSource([
        'secure_dir' => '..',
        'base_dir' => '..',
        'add_ignore' => ['.htaccess'],
      ]);

      $app->views->add('me/source', [
        'content' => $source->View(),
      ]);
    });

    $app->router->add('logout', function () use ($app){
      $app->theme->setTitle('Logga ut');
      session_unset();
      $url = $app->url->create('../index.php/users/login');
      $app->response->redirect($url);
    });

// Kommentarer
    $app->router->add('question', function() use ($app) {
      $app->theme->setTitle("Frågor");

      /*$app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'add',
        'params' => ['commentdb'],
      ]);*/

      $app->dispatcher->forward([
        'controller'  => 'question',
        'action'      => 'view',
        'params'      => ['question'],
      ]);
/*
    $app->dispatcher->forward([
        'controller' => 'commentdb',
        'action'     => 'view',
        'params' => ['commentdb'],
    ]);*/


    });

    $app->router->add('tags', function() use ($app){
      $app->theme->setTitle("Taggar");

      $app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'view',
    ]);

      /*$app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'setup',
      ]);*/

    });


    $app->router->add('users', function() use ($app) {
      $app->theme->setTitle("Users");
      $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'index',
      ]);
    });


    $app->router->handle();
    $app->theme->render();
}
