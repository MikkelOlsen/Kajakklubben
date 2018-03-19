
<div class="contactMsg">
    <?php
        foreach(Contact::GetAllMessages() as $message)
        {
            echo '<div class="msg">';
            echo '<p><b>Navn:</b> '.$message->contactName.'</p>';
            echo '<p><b>Email:</b> '.$message->contactEmail.'</p>';
            echo '<p><b>Telefon:</b> '.$message->contactMobile.'</p>';
            echo '<p>'.$message->contactMessage.'</p>';
            echo '<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="'.Router::$BASE.'Admin/Contact/Delete/'.$message->contactId.'">Slet Nyhed</a>';
            echo '</div>';
        }
    ?>

</div>