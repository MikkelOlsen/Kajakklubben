<?php
  if(Permission::LevelCheck(90) == false)
  {
    Router::Redirect('/Admin');
  }
?>

<a href="<?= Router::$BASE . 'Admin/News/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Nyhed</a>

<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Nyheds Titel</th>
      <th>Start Dato</th>
      <th>Slut Dato</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(News::GetAllNews() as $news) {
            $startDate = ucwords(strftime('%d. %B - %Y', strtotime($news->newsStartDate)));
            $endDate = ucwords(strftime('%d. %B - %Y', strtotime($news->newsEndDate)));
            echo '<tr>';
            echo '<td class="mdl-data-table__cell--non-numeric">'.$news->newsTitle.'</td>';
            echo '<td>'.$startDate.'</td>';
            echo '<td>'.$endDate.'</td>';
            echo '<td><a href="'.Router::$BASE.'Admin/News/Edit/'.$news->newsId.'"><i class="material-icons">mode_edit</i></td>';
            echo '<td><a href="'.Router::$BASE.'Admin/News/Delete/'.$news->newsId.'" class="delete"><i class="material-icons">delete</i></td>';
            echo '</tr>';
        }
      ?>

  </tbody>
</table>