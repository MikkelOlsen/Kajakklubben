<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?= Router::$Title ?></span>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span>hello@example.com</span>
            <div class="mdl-layout-spacer"></div>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Dashboard</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/News' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Nyheder</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Events' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i>Arrangementer</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Gallery' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">report</i>Galleri</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Forums</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Updates</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i>Promos</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Purchases</a>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Social</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>