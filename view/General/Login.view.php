<?php
    if(isset($POST['']))
?>

<div class="contact">
    <div class="contact-form">
        <form method="post">
            <input name="username" type="text" placeholder="Brugernavn" value="<?= @$POST['username'] ?>">
            <input name="password" type="email" placeholder="Adgangskode">
            <input type="submit" name="login" value="Logind">
        </form>
    </div>
</div>