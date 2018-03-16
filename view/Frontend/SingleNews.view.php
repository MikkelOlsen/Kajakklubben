<?php
    $CurrentNews = News::CurrentNews(Router::GetParamByName('ID'));
?>

<div class="news">
    <div class="news-stories">
    <div class="news-story">
        <h3><?= $CurrentNews->newsTitle ?></h3>
        <p><?= ucwords(strftime('%d. %B - %Y', strtotime($CurrentNews->newsStartDate))) ?></p>
        <?= htmlspecialchars_decode($CurrentNews->newsContent) ?></p>
        <a href="<?= Router::$BASE . 'Nyheder' ?>">Tilbage til nyheder</a>
        </div>
    </div>
</div>