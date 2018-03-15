<nav class="navbar">
        <a class="link <?=Router::IsActive('/Om-Klubben', 'active')?>" href="<?= Router::$BASE . 'Om-Klubben' ?>">Om Klubben</a>
        <a class="link <?=Router::IsActive('/Nyheder', 'active')?>" href="<?= Router::$BASE . 'Nyheder' ?>">Nyheder</a>
        <a class="link <?=Router::IsActive('/Arrangementer', 'active')?>" href="<?= Router::$BASE . 'Arrangementer' ?>">Arrangementer</a>
        <a class="link <?=Router::IsActive('/Galleri', 'active')?>" href="<?= Router::$BASE . 'Galleri' ?>">Galleri</a>
        <a class="link <?=Router::IsActive('/Baadpark', 'active')?>" href="<?= Router::$BASE . 'Baadpark' ?>">Bådpark</a>
        <a class="link <?=Router::IsActive('/Bliv-Medlem', 'active')?>" href="<?= Router::$BASE . 'Bliv-Medlem' ?>">Bliv Medlem</a>
        <a class="link <?=Router::IsActive('/Min-Side', 'active')?>" href="<?= Router::$BASE . 'Min-Side' ?>">Min Side</a>
        <a class="link <?=Router::IsActive('/Kontakt', 'active')?>" href="<?= Router::$BASE . 'Kontakt' ?>">Kontakt</a>
</nav>

<nav class="navbar-mobile">
<button onclick="myFunction()" class="dropbtn">Menu</button>
  <div id="myDropdown" class="dropdown-content">
        <a class="<?=Router::IsActive('/Om-Klubben', 'active')?>" href="<?= Router::$BASE . 'Om-Klubben' ?>"><div>Om Klubben</div></a>
        <a class="<?=Router::IsActive('/Nyheder', 'active')?>" href="<?= Router::$BASE . 'Nyheder' ?>"><div>Nyheder</div></a>
        <a class="<?=Router::IsActive('/Arrangementer', 'active')?>" href="<?= Router::$BASE . 'Arrangementer' ?>"><div>Arrangementer</div></a>
        <a class="<?=Router::IsActive('/Galleri', 'active')?>" href="<?= Router::$BASE . 'Galleri' ?>"><div>Galleri</div></a>
        <a class="<?=Router::IsActive('/Baadpark', 'active')?>" href="<?= Router::$BASE . 'Baadpark' ?>"><div>Bådpark</div></a>
        <a class="<?=Router::IsActive('/Bliv-Medlem', 'active')?>" href="<?= Router::$BASE . 'Bliv-Medlem' ?>"><div>Bliv Medlem</div></a>
        <a class="<?=Router::IsActive('/Min-Side', 'active')?>" href="<?= Router::$BASE . 'Min-Side' ?>"><div>Min Side</div></a>
        <a class="<?=Router::IsActive('/Kontakt', 'active')?>" href="<?= Router::$BASE . 'Kontakt' ?>"><div>Kontakt</div></a>
  </div>
</nav>