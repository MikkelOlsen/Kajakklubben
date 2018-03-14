<?php
  Router::SetViewFoler(__ROOT__ . DS . 'view' . DS);
  Router::SetDefaultRoute('/Om-Klubben');
  CONST ROUTES = array(
    [
      'path' => '/Om-Klubben',
      'view' => 'Frontend'.DS.'Home.view.php'
    ],
    [
      'path' => '/Nyheder',
      'view' => 'Frontend'.DS.'News.view.php',
      'params' => ['page']
    ],
    [
      'path' => '/Arrangementer',
      'view' => 'Frontend'.DS.'Events.view.php'
    ],
    [
      'path' => '/Galleri',
      'view' => 'Frontend'.DS.'Gallery.view.php',
      'params' => ['album', 'page']
    ],
    [
      'path' => '/Baadpark',
      'view' => 'Frontend'.DS.'Boats.view.php'
    ],
    [
      'path' => '/Bliv-Medlem',
      'view' => 'Frontend'.DS.'Member.view.php'
    ],
    [
      'path' => '/Min-Side',
      'view' => 'Frontend'.DS.'Profile.view.php'
    ],
    [
      'path' => '/Kontakt',
      'view' => 'Frontend'.DS.'Contact.view.php'
    ],
    [
      'path' => '/Logind',
      'view' => 'General'.DS.'Login.view.php'
    ],
    [
      'path' => '/Logud',
      'view' => 'General'.DS.'Logout.view.php'
    ]
  );
?>
