<?php
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'init.php';
    Router::init($_SERVER['REQUEST_URI'], ROUTES);
    CONST ROOT = __DIR__;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kajakklubben</title>
    <link rel="stylesheet" href="./assets/css/base.css">
</head>
<body>
<header class="header"><?php require_once __DIR__ . DS . 'includes' . DS . 'header.php'; ?></header>
  <main class="main">
      <?php require_once __DIR__ . DS . 'includes' . DS . 'nav.php'; ?>
      <div class="main-content">
          <?php require_once Router::$View; ?>
      </div>
  </main>
  <footer class="footer">Footer</footer>    
</body>
<script src="./assets/js/navigation.js"></script>
</html>