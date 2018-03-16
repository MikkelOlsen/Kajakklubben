<a href="<?= Router::$BASE . 'Admin/Events/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Arrangement</a>


<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Arrangement Titel</th>
      <th>Start Dato</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(Events::GetAllEvents() as $event) {
            $startDate = ucwords(strftime('%d. %B - %Y', strtotime($event->eventStartDate)));
            echo '<tr>';
            echo '<td class="mdl-data-table__cell--non-numeric">'.$event->eventTitle.'</td>';
            echo '<td>'.$startDate.'</td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Events/Edit/'.$event->eventsId.'"><i class="material-icons">mode_edit</i></td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Events/Delete/'.$event->eventsId.'" class="delete"><i class="material-icons">delete</i></td>';
            echo '</tr>';
        }
      ?>

  </tbody>
</table>