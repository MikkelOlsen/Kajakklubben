<?php
  Router::SetViewFoler(__ROOT__ . DS . 'view' . DS);
  Router::SetDefaultRoute('/Home');
  CONST ROUTES = array(
    [
      'path' => '/Home',
      'view' => 'Home.view.php'
    ],
    [
      'path' => '/News',
      'view' => 'News.view.php'
    ]
  );
?>
