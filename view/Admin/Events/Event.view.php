<a href="<?= Router::$BASE . 'Admin/Events/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Arrangement</a>

<p style="color:orange">Arrangementet er ikke afholdt endnu.</p>
<p style="color:blue">Arrangementet afholdes i dag.</p>
<p style="color:green">Arrangementet er blevet afholdt.</p>

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
            $date = date("Y-m-d", strtotime("now"));
            if($event->eventStartDate > $date) 
            {
              $color = 'orange';
            } elseif($event->eventStartDate == $date)
            {
              $color = 'blue';
            } else 
            {
              $color = 'green';
            }
            $startDate = ucwords(strftime('%d. %B - %Y', strtotime($event->eventStartDate)));
            echo '<tr>';
            echo '<td style="color:'.$color.'" class="mdl-data-table__cell--non-numeric">'.$event->eventTitle.'</td>';
            echo '<td>'.$startDate.'</td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Events/Edit/'.$event->eventsId.'"><i class="material-icons">mode_edit</i></td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Events/Delete/'.$event->eventsId.'" class="delete"><i class="material-icons">delete</i></td>';
            echo '</tr>';
        }
      ?>

  </tbody>
</table>