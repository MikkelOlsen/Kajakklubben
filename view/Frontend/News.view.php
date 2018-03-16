<?php
    $page = isset(Router::$Params['PAGE']) ? Router::$Params['PAGE'] : null;
    $currentPage = isset($page) ? $page : 1;
    Pagination::Init(News::GetAllNewsByDate());
    $articles = Pagination::Items($currentPage, 5);
?>

<div class="news">
    <h2>Nyheder</h2>
    <div class="news-stories">
        <?php
            foreach($articles as $news) {
                $desc = preg_replace('/\s+?(\S+)?$/', ' ...', substr($news->newsContent, 0, 197));
                echo '<div class="news-story">';
                echo '<h3>'.$news->newsTitle.'</h3>';
                echo '<p>'.ucwords(strftime('%d. %B - %Y', strtotime($news->newsStartDate))).'</p>';
                echo htmlspecialchars_decode($desc).'</p>';
                echo '<a href="'. Router::$BASE . 'Nyheder/Laes-Mere/'. $news->newsId .'">Læs mere...</a>';
                echo '</div>';
            }
            echo '<div class="pagination">';
            if($page > 1 && $page !== 1) {
                echo '<a href="'. Router::$BASE . 'Nyheder/'. ($currentPage > 1 ? $currentPage-1 : 1) .'">Tidligere Nyheder</a>';
            }
            if(sizeof($articles) >= 5) {
                echo '<a href="'. Router::$BASE . 'Nyheder/'. ($currentPage+1) .'">Ældre Nyheder</a>';
            }
            echo '</div>';
        ?>
        
    </div>
</div>