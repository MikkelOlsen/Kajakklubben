  <nav class="navbar">
        <a class="link" href="<?= Router::$BASE . 'Om-Klubben' ?>">Til Forsiden</a>
        <a class="link <?=Router::IsActive('/Admin/Dashboard', 'active')?>" href="<?= Router::$BASE . 'Admin/Dashboard' ?>">Dashboard</a>
        <a class="link <?=Router::IsActive('/Admin/News', 'active')?>" href="<?= Router::$BASE . 'Admin/News' ?>">Nyheder</a>
        <a class="link <?=Router::IsActive('/Admin/Events', 'active')?>" href="<?= Router::$BASE . 'Admin/Events' ?>">Arrangementer</a>
        <a class="link <?=Router::IsActive('/Admin/Gallery', 'active')?>" href="<?= Router::$BASE . 'Admin/Gallery' ?>">Galleri</a>
        <a class="link <?=Router::IsActive('/Admin/Categories', 'active')?>" href="<?= Router::$BASE . 'Admin/Categories' ?>">Kajak Typer</a>
        <a class="link <?=Router::IsActive('/Admin/Products', 'active')?>" href="<?= Router::$BASE . 'Admin/Products' ?>">Bådpark</a>
        <a class="link <?=Router::IsActive('/Admin/Newsletter', 'active')?>" href="<?= Router::$BASE . 'Admin/Newsletter' ?>">Nyhedsbrev - Liste</a>
        <a class="link <?=Router::IsActive('/Admin/Contact', 'active')?>" href="<?= Router::$BASE . 'Admin/Contact' ?>">Beskeder</a>
        <a class="link <?=Router::IsActive('/Admin/Users', 'active')?>" href="<?= Router::$BASE . 'Admin/Users' ?>">Brugere</a>
</nav>

<nav class="navbar-mobile">
<button onclick="myFunction()" class="dropbtn">Menu</button>
  <div id="myDropdown" class="dropdown-content">
        <a href="<?= Router::$BASE . '/Om-Klubben' ?>">Til Forsiden</a>
        <a href="<?= Router::$BASE . 'Admin/Dashboard' ?>"><div>Dashboard</div></a>
        <a href="<?= Router::$BASE . 'Admin/News' ?>"><div>Nyheder</div></a>
        <a href="<?= Router::$BASE . 'Admin/Events' ?>"><div>Arrangementer</div></a>
        <a href="<?= Router::$BASE . 'Admin/Gallery' ?>"><div>Galleri</div></a>
        <a href="<?= Router::$BASE . 'Admin/Categories' ?>"><div>Kajak Typer</div></a>
        <a href="<?= Router::$BASE . 'Admin/Products' ?>"><div>Bådpark</div></a>
        <a href="<?= Router::$BASE . 'Admin/Newsletter' ?>"><div>Nyhedsbrev - Liste</div></a>
        <a href="<?= Router::$BASE . 'Admin/Contact' ?>"><div>Beskeder</div></a>
        <a href="<?= Router::$BASE . 'Admin/Users' ?>"><div>Brugere</div></a>
  </div>
</nav>