<a href="<?= Router::$BASE . 'Admin/Categories/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Kajak Type</a>

<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Kajak Type</th>
      <th>Sværhedsgrad</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(Categories::GetAllCategories() as $category) {
            echo '<tr>';
            echo '<td class="mdl-data-table__cell--non-numeric">'.$category->kajakTypeName.'</td>';
            echo '<td>'.$category->kajakTypeLevel.'</td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Categories/Edit/'.$category->kajakTypeId.'"><i class="material-icons">mode_edit</i></td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Categories/Delete/'.$category->kajakTypeId.'" class="delete"><i class="material-icons">delete</i></td>';
            echo '</tr>';
        }
      ?>

  </tbody>
</table>