<?php
  Router::SetViewFoler(__ROOT__ . DS . 'view' . DS);
  Router::SetDefaultRoute('/Om-Klubben');
  Router::SetDefaultLayout('Frontend');
  Router::SetErrorPath('/Fejl');
  CONST ROUTES = array(
    [
      'path' => '/Fejl',
      'params' => ['ERROR_ID', 'PAGE'],
      'view' => 'Error.view.php'
    ],
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
      'path' => '/Login',
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
    ],
    [
      'path' => '/Admin/Gallery',
      'view' => 'Admin'.DS.'Gallery'.DS.'Gallery.view.php',
      'layout' => 'Admin',
      'title' => 'Galleri'
    ],
    [
      'path' => '/Admin/Gallery/Create',
      'view' => 'Admin'.DS.'Gallery'.DS.'Create.view.php',
      'layout' => 'Admin',
      'title' => 'Opret Galleri'
    ],
    [
      'path' => '/Admin/Gallery/Edit',
      'view' => 'Admin'.DS.'Gallery'.DS.'Edit.view.php',
      'layout' => 'Admin',
      'title' => 'Rediger Galleri',
      'params' => ['ID']
    ],
    [
      'path' => '/Api/Gallery/Delete',
      'view' => 'Api'.DS.'Gallery.view.php',
      'params' => ['DELID'],
      'layout' => 'Api'
    ],
    [
      'path' => '/Admin/Gallery/Delete-Album',
      'view' => 'Admin'.DS.'Gallery'.DS.'Delete.view.php',
      'params' => ['ID']
    ],
    [
      'path' => '/Admin/Categories',
      'view' => 'Admin'.DS.'Categories'.DS.'Categories.view.php',
      'layout' => 'Admin',
      'title' => 'Kajak Typer'
    ],
    [
      'path' => '/Admin/Categories/Create',
      'view' => 'Admin'.DS.'Categories'.DS.'Create.view.php',
      'layout' => 'Admin',
      'title' => 'Opret Kajak Type'
    ],
    [
      'path' => '/Admin/Categories/Delete',
      'view' => 'Admin'.DS.'Categories'.DS.'Delete.view.php',
      'layout' => 'Admin',
      'params' => ['ID']
    ],
    [
      'path' => '/Admin/Categories/Edit',
      'view' => 'Admin'.DS.'Categories'.DS.'Edit.view.php',
      'layout' => 'Admin',
      'params' => ['ID'],
      'title' => 'Rediger Kajak Type'
    ],
    [
      'path' => '/Admin/Products',
      'view' => 'Admin'.DS.'Products'.DS.'Products.view.php',
      'layout' => 'Admin',
      'title' => 'Bådpark'
    ],
    [
      'path' => '/Admin/Products/Create',
      'view' => 'Admin'.DS.'Products'.DS.'Create.view.php',
      'layout' => 'Admin',
      'title' => 'Opret Kajak'
    ],
    [
      'path' => '/Admin/Products/Delete',
      'view' => 'Admin'.DS.'Products'.DS.'Delete.view.php',
      'layout' => 'Admin',
      'params' => ['ID']
    ],
    [
      'path' => '/Admin/Products/Edit',
      'view' => 'Admin'.DS.'Products'.DS.'Edit.view.php',
      'layout' => 'Admin',
      'params' => ['ID'],
      'title' => 'Rediger Kajak'
    ],
    [
      'path' => '/Admin/Newsletter',
      'view' => 'Admin'.DS.'Newsletter'.DS.'Newsletter.view.php',
      'layout' => 'Admin',
      'title' => 'Nyhedsbrevs Tilmeldte'
    ],
    [
      'path' => '/Admin/Newsletter/Delete',
      'view' => 'Admin'.DS.'Newsletter'.DS.'Delete.view.php',
      'layout' => 'Admin',
      'params' => ['ID']
    ],
    [
      'path' => '/Api/Newsletter',
      'view' => 'Api'.DS.'Newsletter.view.php',
      'params' => ['EMAIL'],
      'layout' => 'Api'
    ],
    [
      'path' => '/Admin/Contact',
      'view' => 'Admin'.DS.'Contact'.DS.'Contact.view.php',
      'layout' => 'Admin',
      'title' => 'Kontakt Beskeder'
    ],
    [
      'path' => '/Admin/Contact/Delete',
      'view' => 'Admin'.DS.'Contact'.DS.'Delete.view.php',
      'layout' => 'Admin',
      'params' => ['ID']
    ],
    [
      'path' => '/Soeg',
      'view' => 'Frontend'.DS.'Search.view.php',
      'params' => ['PAGE']
    ],
    [
      'path' => '/Admin/Users',
      'view' => 'Admin'.DS.'Users'.DS.'Users.view.php',
      'layout' => 'Admin',
      'title' => 'Bruger liste'
    ],
    [
      'path' => '/Admin/Users/Create',
      'view' => 'Admin'.DS.'Users'.DS.'Create.view.php',
      'layout' => 'Admin',
      'title' => 'Opret Bruger'
    ],
    [
      'path' => '/Admin/Users/Edit',
      'view' => 'Admin'.DS.'Users'.DS.'Edit.view.php',
      'layout' => 'Admin',
      'params' => ['ID'],
      'title' => 'Rediger Bruger'
    ],
    [
      'path' => '/Admin/Users/Delete',
      'view' => 'Admin'.DS.'Users'.DS.'Delete.view.php',
      'layout' => 'Admin',
      'params' => ['ID']
    ],
    [
      'path' => '/Api/Event',
      'view' => 'Api'.DS.'Event.view.php',
      'params' => ['ID', 'USER'],
      'layout' => 'Api'
    ],
    [
      'path' => '/Api/EventDelete',
      'view' => 'Api'.DS.'EventDelete.view.php',
      'params' => ['ID', 'USER'],
      'layout' => 'Api'
    ]
  );
?>
