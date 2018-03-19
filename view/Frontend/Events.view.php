<?php
    $Events = Events::GetAllEventsByDate();
?>
<a id="baseURL" style="display:hidden;" href="<?= Router::$BASE ?>"></a>
<div class="events">
    <h2>Arrangementer</h2>

    <?php
        foreach($Events as $event) {
            
            echo '<div class="event">';
            echo '<img src="'.$event->filepath.'/900x600_'.$event->filename.'.'.$event->mime.'" alt="'.$event->eventTitle.'">';
            echo '<div class="event-text">';
            echo '<h3>'.$event->eventTitle.'</h3>';
            echo '<p>'.ucwords(strftime('%d. %B - %Y', strtotime($event->eventStartDate))).'</p>';
            echo htmlspecialchars_decode($event->eventDescription);
            if(Users::UserEventCheck($event->eventsId) == true)
            {
                echo '<div class="sub"><a class="eventSub" href="'.$event->eventsId.'/'.$_SESSION['USER']['USERID'].'">Tilmeld</a></div>';
            } else 
            {
                echo '<div class="sub"><a class="eventNoSub" href="'.$event->eventsId.'/'.$_SESSION['USER']['USERID'].'">Du er allerede tilmeldt - Afmeld</a></div>';
            }
            echo '</div>';
            echo '</div>';
        }
    ?>
</div>