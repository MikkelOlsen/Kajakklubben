<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kajakklubben - Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-indigo.min.css" /> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?= Router::$BASE ?>assets/css/adminpanel.css">
    <link rel="stylesheet" href="<?= Router::$BASE ?>assets/css/base.css">
    <link rel="stylesheet" href="<?= Router::$BASE ?>assets/css/adminCustom.css">
</head>
    <body>
    <header class="header"><?php require_once __ROOT__ . DS . 'includes' . DS . 'admin-header.php'; ?></header>
        <main class="main">
        <?php require_once __ROOT__ . DS . 'includes' . DS . 'admin-nav.php'; ?>
            <div class="main-content">
                <h3><?= Router::$Title ?></h3>
                    <?php require_once Router::$View; ?>
                </div>
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
        </div>
        <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
        <script src="<?= Router::$BASE ?>assets/js/admin-init.js"></script>
        <script src="<?= Router::$BASE ?>assets/js/navigation.js"></script>
    </body>
</html>
