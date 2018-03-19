<a href="<?= Router::$BASE . 'Admin/Users/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Bruger</a>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Fulde Navn</th>
      <th class="mdl-data-table__cell--non-numeric">Brugernavn</th>
      <th class="mdl-data-table__cell--non-numeric">Email</th>
      <th class="mdl-data-table__cell--non-numeric"></th>
      <th class="mdl-data-table__cell--non-numeric">Bruger Type</th>
      <th>Antal Roede KM</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(Users::AllUsers() as $user)
        {
                echo '<tr>';
                echo '<th class="mdl-data-table__cell--non-numeric">'.$user->fullname.'</th>';
                echo '<th class="mdl-data-table__cell--non-numeric">'.$user->username.'</th>';
                echo '<th class="mdl-data-table__cell--non-numeric">'.$user->userEmail.'</th>';
                echo '<th class="mdl-data-table__cell--non-numeric"><img src="'. Router::$BASE .$user->filepath.'/150x150_'.$user->filename.'.'.$user->mime.'"></th>';
                echo '<th class="mdl-data-table__cell--non-numeric">'.$user->roleName.'</th>';
                echo '<th>'.$user->userKm.'</th>';
                if(Permission::LevelCheck($user->roleLevel))
                {
                  echo '<td><a href="'.Router::$BASE.'Admin/Users/Edit/'.$user->userId.'"><i class="material-icons">mode_edit</i></td>';
                  echo '<td><a href="'.Router::$BASE.'Admin/Users/Delete/'.$user->userId.'" class="delete"><i class="material-icons">delete</i></td>';
                }
                echo '<tr>';

        }
        
      ?>

  </tbody>
</table>