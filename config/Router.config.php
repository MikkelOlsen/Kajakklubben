<?php
  Router::SetViewFoler(__ROOT__ . DS . 'view' . DS);
  Router::SetDefaultRoute('/Home');
  CONST ROUTES = array(
    [
      'path' => '/Om-Klubben',
      'view' => 'Home.view.php'
    ],
    [
      'path' => '/Nyheder',
      'view' => 'News.view.php',
      'params' => ['page']
    ],
    [
      'path' => '/Arrangementer',
      'view' => 'Events.view.php'
    ],
    [
      'path' => '/Galleri',
      'view' => 'Gallery.view.php',
      'params' => ['album', 'page']
    ]
  );
?>
