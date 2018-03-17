<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kajakklubben</title>
    <link rel="stylesheet" href="<?= Router::$BASE ?>assets/css/base.css">
    <link rel="stylesheet" href="<?= Router::$BASE ?>assets/css/lightbox.css">
</head>
<body>
<header class="header"><?php require_once __ROOT__ . DS . 'includes' . DS . 'header.php'; ?></header>
  <main class="main">
      <?php require_once __ROOT__ . DS . 'includes' . DS . 'nav.php'; ?>
      <div class="main-content">
          <?php require_once Router::$View; ?>
      </div>
  </main>
  <footer class="footer">
      <div class="footer-content">
        <p>Kajakklubben Pagaj</p>
        <p>Loremvej 4</p>
        <p>tlf. 22 22 22 22</p>
        <p>mail@adresse.dk</p>
      </div>
  </footer>  
  </body>
<script src="<?= Router::$BASE ?>assets/js/navigation.js"></script>
<script src="<?= Router::$BASE ?>assets/js/lightbox.js" type="text/javascript"></script>
<script src="<?= Router::$BASE ?>assets/js/frontend-init.js"></script>
</html>