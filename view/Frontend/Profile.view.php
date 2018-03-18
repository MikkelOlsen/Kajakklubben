<?php

if(Permission::LoginCheck() == false)
{
    Router::Redirect('/Logind');
}

?>

<div class="profile">
    <h2>Min side</h2>
    <img src="./assets/images/profile_placeholder.jpg" alt="">
    <div class="profile-information">

            <p>Navn:</p>
            <p>Lorentz Ibson</p>

            <p>Email:</p>
            <p>something@something.dk</p>

            <p>Færdighedsniveau:</p>
            <p>Begynder</p>

            <p>Roede kilometre</p>
            <p>42 km</p>
    </div>
    <div class="profile-information">
        <p>Tilmeldt:</p>
        <div class="upcoming-events">
                <p>Kajaktur 15-06-2016</p>
                <p>Kajaktur 26-06-2016</p>
        </div>
    </div>
    <a href="<?= Router::$BASE . 'Admin' ?>">Til Administration</a>

</div>
