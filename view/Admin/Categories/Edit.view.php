<?php
    $currentCategory = Categories::CurrentCategory(Router::GetParamByName('ID'));
    if(isset($POST['typeSubmit'])) {
        if(Token::validateToken($POST['_once_default']) == true) {
                $error = [];
                $DATA['typeName'] = Validate::stringBetween($POST['typeName'], 2, 45) ? $POST['typeName']  : $error['typeName'] = '<div class="error">Titlen må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
                if(!empty($POST['typeDiff']))
                {
                    $DATA['typeDiff'] = Validate::intBetween($POST['typeDiff'], 1, 2) ? $POST['typeDiff'] : $error['typeDiff'] = '<div class="error">Sværhedsgraden må kun indeholde tal og være mellem 1 og 11.</div>';
                }
                if(sizeof($error) == 0) 
                {
                    if(Categories::UpdateCategory($DATA, Router::GetParamByName('ID')) == true)
                    {
                        $status = '<a id="successTooltip" href="'.Router::$BASE.'Admin/Categories" class="success">Success</a>
                                  <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="successTooltip">Klik her for at komme tilbage til arrangementer.</div>';
                                  $currentCategory = Categories::CurrentCategory(Router::GetParamByName('ID'));

                    } else 
                    {
                        $status = '<div class="error">Der skete desværre en fejl ved indsættelsen af dataen. Prøv igen.</div>';
                    }
                }
        } else 
        {
            $status = '<div class="error">Dataen gik desværre ikke igennem, prøv igen.</div>';
        }
    }
?>

<div class="create-news">
    <form method="post">
        <?= Token::createTokenInput() ?>
        <label for="typeName">Kajak Type</label>
        <input type="text" name="typeName" placeholder="Kajak Typens Navn" value="<?= $currentCategory->kajakTypeName ?>">
        <?= @$error['typeName'] ?>
        <label for="typeDiff">Sværhedsgrad</label>
        <input type="number" name="typeDiff" min="1" max="11" placeholder="Kajak Typens Sværhedsgrad (1-11)" value="<?= $currentCategory->kajakTypeLevel ?>">
        <?= @$error['typeDiff'] ?>
        <input name="typeSubmit" type="submit" value="Opdater Kajak Type">
        <?= @$status ?>
    </form>
</div>