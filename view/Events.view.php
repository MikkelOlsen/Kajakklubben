<?php
    setlocale(LC_ALL, array('da_DA.UTF-8','da_DA@euro','da_DA','danish'));
?>

<div class="events">
    <h2>Arrangementer</h2>
    <div class="event">
        <img src="./assets/images/kajak04.jpg" alt="">
        <div class="event-text">
            <h3>Sommerafslutning</h3>
            <p><?= strftime("%e. %B - %Y") ?></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, temporibus consectetur? Praesentium temporibus accusamus fugiat, dolore ad voluptates ipsa facilis iusto exercitationem, quasi tenetur nemo mollitia quia quis natus officia!</p>
            <a href="<?= Router::$BASE . 'Home' ?>">Tilmeld</a>
        </div>
    </div>

    <div class="event">
        <img src="./assets/images/kajak04.jpg" alt="">
        <div class="event-text">
            <h3>Sommerafslutning</h3>
            <p><?= strftime("%e. %B - %Y") ?></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, temporibus consectetur? Praesentium temporibus accusamus fugiat, dolore ad voluptates ipsa facilis iusto exercitationem, quasi tenetur nemo mollitia quia quis natus officia!</p>
            <a href="<?= Router::$BASE . 'Home' ?>">Tilmeld</a>
        </div>
    </div>
</div>