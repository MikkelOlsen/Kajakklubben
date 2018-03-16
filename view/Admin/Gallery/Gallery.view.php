<a href="<?= Router::$BASE . 'Admin/Gallery/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Galleri</a>

<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Album Navn</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(Gallery::GetAllAlbums() as $gallery) {
            echo '<tr>';
            echo '<td class="mdl-data-table__cell--non-numeric">'.$gallery->albumName.'</td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Gallery/Edit/'.$gallery->albumId.'"><i class="material-icons">mode_edit</i></td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Gallery/Delete/'.$gallery->albumId.'" class="delete"><i class="material-icons">delete</i></td>';
            echo '</tr>';
        }
      ?>

  </tbody>
</table>