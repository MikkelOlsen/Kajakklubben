<?php
    if(isset($POST['login']))
    {
        if(Permission::Login($POST) == true )
        {
            Router::Redirect('/Min-Side');
        }
        else 
        {
            $status = '<p style="color:red;">Fejl i brugernavn og/eller password.</p>';
        }
    }
?>

<div class="contact">
    <div class="contact-form login">
    <h3>Bruger Login</h3>
        <form method="post">
            <input name="username" type="text" placeholder="Brugernavn" value="<?= @$POST['username'] ?>">
            <input name="password" type="password" placeholder="Adgangskode">
            <?= @$status ?>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</div>