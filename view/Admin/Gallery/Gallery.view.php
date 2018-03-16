<a href="<?= Router::$BASE . 'Admin/Gallery/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Galleri</a>

<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Galleri for</th>
      <th>Arrangementets dato</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(Gallery::GetAllGalleries() as $gallery) {
            $startDate = ucwords(strftime('%d. %B - %Y', strtotime($gallery->eventStartDate)));
            echo '<tr>';
            echo '<td class="mdl-data-table__cell--non-numeric">'.$gallery->eventTitle.'</td>';
            echo '<td>'.$startDate.'</td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Gallery/Edit/'.$gallery->eventsId.'"><i class="material-icons">mode_edit</i></td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Gallery/Delete/'.$gallery->eventsId.'" class="delete"><i class="material-icons">delete</i></td>';
            echo '</tr>';
        }
      ?>

  </tbody>
</table>