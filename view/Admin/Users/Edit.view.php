<?php

$currentUser = Users::CurrentUser(Router::GetParamByName('ID'));
if(isset($POST['userSubmit']))
{
    if(Token::validateToken($POST['_once_default']) == true) {
        $error = [];
        if($POST['username'] !== $currentUser->username)
        {
            $DATA['username'] = Users::UsernameCheck($POST['username']) ? $POST['username'] : $error['username'] = '<div class="error">Dette brugernavn er allerede i brug.</div>';
            if(sizeof($error) == 0)
            {
            $DATA['username'] = Validate::stringBetween($POST['username'], 2, 45) ? $POST['username'] : $error['username'] = '<div class="error">Brugernavnet må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
            }
        }
        else 
        {
            $DATA['username'] = $POST['username'];
        }
        if(!empty($POST['password']))
        {

            $DATA['password'] = Validate::mixedBetween($POST['password'], 5, 60) ? $POST['password'] : $error['password'] = '<div class="error">Adgangskoden må kun være mellem 5 og 60 tegn.</div>';
        }
        $DATA['fullName'] = Validate::characters($POST['fullName'], 5, 45) ? $POST['fullName'] : $error['fullName'] = '<div class="error">Det fulde navn må kun inholde bogstaver. Samt være mellem 5 og 45 tegn.</div>';
        $DATA['email'] = Validate::email($POST['email']) ? $POST['email'] : $error['email'] = '<div class="error">Dette er ikke en gyldig email.</div>';
        $DATA['userRole'] = ($POST['userRole'] >= 1 && $POST['userRole'] <= 3) ? $POST['userRole'] : $error['userRole'] = '<div class="error">Ugyldigt valgt af bruger rolle.</div>';
        $DATA['userKM'] = (is_numeric($POST['userKM'])) ? $POST['userKM'] : $error['userKM'] = '<div class="error">Antal kilometer skal være mellem 1 og 20 tal.</div>';

        if(sizeof($error) == 0)
        {
            $options = array(
                'validExts' => array(
                    'jpeg',
                    'jpg',
                    'png',
                    'gif'
                ),
                'sizes' => array(
                    'normal' => array(
                        'height' => '150',
                        'width' => '150'
                    )
                ),
                'path' => 'assets/images/users',
                'mediaId' => $currentUser->avatar
            );
            if($_FILES['files']['size'] !== 0)
            {
                $MediaId = Media::UpdateImg($_FILES['files'], $options, true);
            }
            if(Users::UpdateUser($DATA, Router::GetParamByName('ID')) == true)
            {
                $status = '<a id="successTooltip" href="'.Router::$BASE.'Admin/Users" class="success">Success</a>
                            <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="successTooltip">Klik her for at komme tilbage til brugere.</div>';
                $currentUser = Users::CurrentUser(Router::GetParamByName('ID'));
            } else {
                $status = '<div class="error">Der skete en fejl ved opdateringen af brugeren, genindlæs siden og prøv igen.</div>';
            }

    }
    }

}

?>
<div class="create-news user-create">
    <form method="post" enctype="multipart/form-data">
        <?= Token::createTokenInput() ?>
        <div>
            <input type="text" name="username" placeholder="Brugernavn" value="<?= $currentUser->username ?>">
            <?= @$error['username'] ?>
        </div>
        <div>
            <input type="text" name="password" placeholder="Adgangskode">
            <?= @$error['password'] ?>
        </div>
        <div>
            <input type="text" name="fullName" placeholder="Fulde Navn" value="<?= $currentUser->fullname ?>">
            <?= @$error['fullName'] ?>
        </div>
        <div>
            <input type="email" name="email" placeholder="Email" value="<?= $currentUser->userEmail ?>">
            <?= @$error['email'] ?> 
        </div>
        <div>
            <select name="userRole" id="userRole">
                <?php
                if(Permission::LevelCheck(90) == true)
                {
                    $LEVEL = '90';
                }
                else 
                {
                    $LEVEL = '50';
                }
                    foreach(Users::UserRoles($LEVEL) as $role)
                    {
                        $selected = ($role->roleId == $currentUser->userRole) ? 'selected' : '';
                        echo '<option '.$selected.' value="'.$role->roleId.'">'.$role->roleName.'</option>';
                    }
                ?>
            </select>
            <?= @$error['userRole'] ?>
        </div>
        <div>
            <input type="number" name="userKM" placeholder="Kilometer Antal" value="<?= $currentUser->userKm ?>">
            <?= @$error['userKM'] ?> 
        </div>
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at vælge brugerens billede.</span></label>
        <?= @$error['userAvatar'] ?>
        <input name="userSubmit" type="submit" value="Opdater Bruger">
        <?= @$status ?>
    </form>
    <img src="<?= Router::$BASE . $currentUser->filepath ?>/150x150_<?= $currentUser->filename ?>.<?= $currentUser->mime ?>" alt="">
</div>