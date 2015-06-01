<?php
require __DIR__.'/config_with_app.php';
$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_theme.php');
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

$di->set('CommentController', function() use ($di) {
    $controller = new Anax\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

$app->router->add('', function() use ($app) {
 	$app->theme->setTitle("Me-sidan");

 	  $content = $app->fileContent->get('me.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,

    ]);

    $app->views->add('comment/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
        'pageName' => null,
    ]);


    $app->dispatcher->forward([
      'controller' => 'comment',
      'action'     => 'view',
      'params' => [''],
    ]);



});

$app->router->add('regioner', function() use ($app) {

$app->theme->addStylesheet('css/anax-grid/style.php');
$app->theme->setTitle("Regioner");

$app->views->addString('flash', 'flash')
           ->addString('featured-1', 'featured-1')
           ->addString('featured-2', 'featured-2')
           ->addString('featured-3', 'featured-3')
           ->addString('main', 'main')
           ->addString('sidebar', 'sidebar')
           ->addString('triptych-1', 'triptych-1')
           ->addString('triptych-2', 'triptych-2')
           ->addString('triptych-3', 'triptych-3')
           ->addString('footer-col-1', 'footer-col-1')
           ->addString('footer-col-2', 'footer-col-2')
           ->addString('footer-col-3', 'footer-col-3')
           ->addString('footer-col-4', 'footer-col-4');

});

$app->router->add('typography', function() use ($app) {

  $app->theme->addStylesheet('css/anax-grid/style.php');
 	$app->theme->setTitle("Typography");

   $app->views->addString('flash', 'flash')
              ->addString('featured-1', 'featured-1')
              ->addString('featured-2', 'featured-2')
              ->addString('featured-3', 'featured-3')
              ->addString('<h1>HTML Ipsum Presents</h1>

              <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>
              <h2>Header Level 2</h2>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

              <blockquote>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</blockquote>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

              <h3>Header Level 3</h3>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <pre>
              #header h1 a {
                display: block;
                width: 300px;
                height: 80px;
              }
              </pre>

              <h4>Header Level 4</h4>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <table>
                <caption>Table 1. Example table</caption>
                <thead>
                  <tr>
                    <th>Header 1</th>
                    <th>Header 2</th>
                    <th>Header 3</th>
                    <th>Header 4</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                  </tr>
                  <tr>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                  </tr>
                  <tr>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                  </tr>
                </tbody>
              </table>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <h5>Header Level 5</h5>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <ul>
                 <li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li>
                 <li>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</li>
                 <li>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</li>
                 <li>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</li>
              </ul>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

              <ol>
                 <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                 <li>Aliquam tincidunt mauris eu risus.</li>
                 <li>Vestibulum auctor dapibus neque.</li>
              </ol>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <h6>Header Level 6</h6>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <dl>
                 <dt>Definition list</dt>
                 <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
                 <dt>Lorem ipsum dolor sit amet</dt>
                 <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
              </dl>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
', 'main')
              ->addString('<h1>HTML Ipsum Presents</h1>

              <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>

              <h2>Header Level 2</h2>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

              <blockquote>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</blockquote>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

              <h3>Header Level 3</h3>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <pre>
              #header h1 a {
                display: block;
                width: 300px;
                height: 80px;
              }
              </pre>

              <h4>Header Level 4</h4>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <table>
                <caption>Table 1. Example table</caption>
                <thead>
                  <tr>
                    <th>Header 1</th>
                    <th>Header 2</th>
                    <th>Header 3</th>
                    <th>Header 4</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                  </tr>
                  <tr>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                  </tr>
                  <tr>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                  </tr>
                </tbody>
              </table>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <h5>Header Level 5</h5>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <ul>
                 <li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li>
                 <li>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</li>
                 <li>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</li>
                 <li>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</li>
              </ul>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

              <ol>
                 <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                 <li>Aliquam tincidunt mauris eu risus.</li>
                 <li>Vestibulum auctor dapibus neque.</li>
              </ol>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <h6>Header Level 6</h6>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>

              <dl>
                 <dt>Definition list</dt>
                 <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
                 <dt>Lorem ipsum dolor sit amet</dt>
                 <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</dd>
              </dl>

              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
', 'sidebar')
              ->addString('footer-col-1', 'footer-col-1')
              ->addString('footer-col-2', 'footer-col-2')
              ->addString('footer-col-3', 'footer-col-3')
              ->addString('footer-col-4', 'footer-col-4');
});

$app->router->add('font_awesome', function() use ($app) {
    $app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
    $app->theme->setTitle("Font Awesome");

    $sidebar = $app->fileContent->get('font-awesome-sidebar.html');
    $content = $app->fileContent->get('font-awesome-content.html');
    //$trip1 = $app->fileContent->get('trip-1.html');
    //$trip2 = $app->fileContent->get('trip-2.html');
    //$trip3 = $app->fileContent->get('trip-3.html');

    $app->views->addString($content, 'main')
               ->addString($sidebar, 'sidebar')
               //->addString($trip1, 'triptych-1')
               //->addString($trip2, 'triptych-2')
               //->addString($trip3, 'triptych-3')
               ;

});



$app->router->handle();
$app->theme->render();
