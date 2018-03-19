<?php

if(Permission::LoginCheck() == false)
{
    Router::Redirect('/Logind');
}

$USERIMG = Users::CurrentUserImage();
$USERLEVEL = Users::CurrentUserLevel();

?>

<div class="profile">
    <h2>Min side</h2>
    <img src="<?= Router::$BASE . $USERIMG->filepath ?>/150x150_<?= $USERIMG->filename ?>.<?= $USERIMG->mime ?>" alt="">
    <div class="profile-information">

            <p>Navn:</p>
            <p><?= $_SESSION['USER']['FULLNAME'] ?></p>

            <p>Email:</p>
            <p><?= $_SESSION['USER']['USEREMAIL'] ?></p>

            <p>Færdighedsniveau:</p>
            <p><?= $USERLEVEL->userLevelName ?></p>

            <p>Roede kilometre</p>
            <p><?= $_SESSION['USER']['USERKM'] ?> km</p>
    </div>
    <div class="profile-information">
        <p>Tilmeldt:</p>
        <div class="upcoming-events">
                <?php
                    if(sizeof(Users::CurrentUserEvents()) > 0)
                    {
                        foreach(Users::CurrentUserEvents() as $event)
                        {
                            echo '<p>'.$event->eventTitle.' / '.strftime('%d-%m-%Y', strtotime($event->eventStartDate)).'</p>';
                        }
                    } else 
                    {
                        echo '<p>Du er ikke tilmeldt nogle arrangementer.</p>';
                    }
                ?>
        </div>
    </div>
    <?php
    if(Permission::LevelCheck(50) == true)
    {
        echo '<a href="'.Router::$BASE.'Admin">Til Administration</a>';
    }
    echo '<a href="'.Router::$BASE.'Logud">Log ud</a>';

    ?>
</div>
