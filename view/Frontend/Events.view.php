<?php
    $Events = Events::GetAllEventsByDate();
?>

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
            echo '<a href="'.Router::$BASE.'Arrangementer">Tilmeld</a>';
            echo '</div>';
            echo '</div>';
        }
    ?>
</div>