<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Email</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(Newsletter::NewsletterList() as $newsletter) {
            echo '<tr>';
            echo '<td class="mdl-data-table__cell--non-numeric">'.$newsletter->newsLetterSubscribersEmail.'</td>';
            echo '<td><a href="'.Router::$BASE.'Admin/Newsletter/Delete/'.$newsletter->newsLetterSubscribersId.'" class="delete"><i class="material-icons">delete</i></td>';
            echo '</tr>';
        }
      ?>

  </tbody>
</table>