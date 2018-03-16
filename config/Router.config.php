<?php
  Router::SetViewFoler(__ROOT__ . DS . 'view' . DS);
  Router::SetDefaultRoute('/Om-Klubben');
  Router::SetDefaultLayout('Frontend');
  CONST ROUTES = array(
    [
      'path' => '/Om-Klubben',
      'view' => 'Frontend'.DS.'Home.view.php'
    ],
    [
      'path' => '/Nyheder',
      'view' => 'Frontend'.DS.'News.view.php',
      'params' => ['PAGE']
    ],
    [
      'path' => '/Nyheder/Laes-Mere',
      'view' => 'Frontend'.DS.'SingleNews.view.php',
      'params' => ['ID']
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
    ],
    [
      'path' => '/Admin',
      'view' => 'Admin'.DS.'Dashboard.view.php',
      'layout' => 'Admin',
      'title' => 'Dashboard'
    ],
    [
      'path' => '/Admin/News',
      'view' => 'Admin'.DS.'News'.DS.'News.view.php',
      'layout' => 'Admin',
      'title' => 'Nyheder'
    ],
    [
      'path' => '/Admin/News/Create',
      'view' => 'Admin'.DS.'News'.DS.'Create.view.php',
      'layout' => 'Admin',
      'title' => 'Opret Nyhed'
    ],
    [
      'path' => '/Admin/News/Delete',
      'view' => 'Admin'.DS.'News'.DS.'Delete.view.php',
      'params' => ['ID']
    ],
    [
      'path' => '/Admin/News/Edit',
      'view' => 'Admin'.DS.'News'.DS.'Edit.view.php',
      'layout' => 'Admin',
      'title' => 'Rediger Nyhed',
      'params' => ['ID']
    ],
    [
      'path' => '/Admin/Events',
      'view' => 'Admin'.DS.'Events'.DS.'Event.view.php',
      'layout' => 'Admin',
      'title' => 'Arrangementer'
    ],
    [
      'path' => '/Admin/Events/Create',
      'view' => 'Admin'.DS.'Events'.DS.'Create.view.php',
      'layout' => 'Admin',
      'title' => 'Opret Arrangement'
    ],
    [
      'path' => '/Admin/Events/Delete',
      'view' => 'Admin'.DS.'Events'.DS.'Delete.view.php',
      'params' => ['ID']
    ],
    [
      'path' => '/Admin/Events/Edit',
      'view' => 'Admin'.DS.'Events'.DS.'Edit.view.php',
      'layout' => 'Admin',
      'title' => 'Rediger Arrangement',
      'params' => ['ID']
    ]
  );
?>
