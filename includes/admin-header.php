<header class="demo-header mdl-layout__header">
        <div class="mdl-layout__header-row">
            <span>Kajakklubben Pagaj - Administration / <?= Router::$Title ?></span>
        </div>
</header>
    <div class="demo-drawer mdl-layout__drawer">
        <header class="demo-drawer-header">
            <span>John Doe</span>
        </header>
        <nav class="demo-navigation mdl-navigation">
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Dashboard</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/News' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Nyheder</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href="../index.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Til siden</a>
          <a class="mdl-navigation__link" href="?p=logout"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">exit_to_app</i>Log out</a>
        </nav>
    