<form class="search" method="post">
    <input type="search" name="search" placeholder="Søge Tekst" value="<?= $POST['search'] ?>">
</form>
<?php 
if(isset($POST['search']) && !empty($POST['search']))
{
    $searchResults = Search::SearchResults($POST['search']);
    
?>
<div class="search-results">
    <div class="title">
        <h2>Søge Resultater - Nyheder</h2>
        <h2>Søge Resultater - Arrangementer</h2>
    </div>
    
    <div class="news-stories">
    <?php
    if(sizeof($searchResults['news']) > 0) {
        foreach($searchResults['news'] as $news)
        {
            $desc = preg_replace('/\s+?(\S+)?$/', ' ...', substr($news->newsContent, 0, 97));
            echo '<div class="news-story">';
            echo '<h3>'.$news->newsTitle.'</h3>';
            echo '<p>'.ucwords(strftime('%d. %B - %Y', strtotime($news->newsStartDate))).'</p>';
            echo htmlspecialchars_decode($desc).'</p>';
            echo '<a href="'. Router::$BASE . 'Nyheder/Laes-Mere/'. $news->newsId .'">Læs mere...</a>';
            echo '</div>';
        }
    }else 
    {
        echo '<h2>Din søgnng retunerede ingen nyheder, prøv at omformulere søgningen.</h2>';
    }
    ?>
    </div>
    <div class="events">
    <?php
    if(sizeof($searchResults['events']) > 0) {
        foreach($searchResults['events'] as $event)
        {
            echo '<div class="event">';
                echo '<img src="'.$event->filepath.'/222x171_'.$event->filename.'.'.$event->mime.'" alt="'.$event->eventTitle.'">';
                echo '<div class="event-text">';
                echo '<h3>'.$event->eventTitle.'</h3>';
                echo '<p>'.ucwords(strftime('%d. %B - %Y', strtotime($event->eventStartDate))).'</p>';
                echo htmlspecialchars_decode($event->eventDescription);
                echo '<a href="'.Router::$BASE.'Arrangementer">Tilmeld</a>';
                echo '</div>';
                echo '</div>';
        }
    } else 
    {
        echo '<h2>Din søgnng retunerede ingen arrangementer, prøv at omformulere søgningen.</h2>';
    }
    ?>
    </div>
</div>
<?php
}

