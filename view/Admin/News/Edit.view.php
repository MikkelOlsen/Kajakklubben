<?php
    $CurrentNews = News::CurrentNews(Router::GetParamByName('ID'));
    $startDate = ucwords(strftime('%m/%d/%Y', strtotime($CurrentNews->newsStartDate)));
    $endDate = ucwords(strftime('%m/%d/%Y', strtotime($CurrentNews->newsEndDate)));
    if(isset($POST['newsSubmit'])) 
    {
        if(Token::validateToken($POST['_once_default']) == true) {

            if(isset($POST['startDate']) && isset($POST['endDate']) && isset($POST['newsMessage']) && isset($POST['newsTitle']))
            {
                $error = [];
                $DATA['title'] = Validate::stringBetween($POST['newsTitle'], 2, 45) ? $POST['newsTitle']  : $error['newsTitle'] = '<div class="error">Titlen må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
                $DATA['startDate'] = Validate::date($POST['startDate']) ? $POST['startDate'] : $error['startDate'] = '<div class="error">Start dato er ikke i korrekt format.</div>';
                $DATA['endDate'] = Validate::date($POST['endDate']) ? $POST['endDate'] : $error['endDate'] = '<div class="error">Slut dato er ikke i korrekt format.</div>';
                if(in_array($_POST['newsMessage'], array('<p>&nbsp;</p>', ''))) 
                {
                    $error['content'] = '<div class="error">Nyhedens indhold må ikke være tom.</div>';
                } else 
                {
                    $DATA['content'] = $POST['newsMessage'];
                }
                if(sizeof($error) == 0) 
                {
                    if(News::UpdateNews($DATA, Router::GetParamByName('ID')) == true)
                    {
                        $status = '<div class="success">Nyheden er blevet opdateret.</div>';
                        $CurrentNews = News::CurrentNews(Router::GetParamByName('ID'));
                    } else 
                    {
                        $status = '<div class="error">Der skete desværre en fejl ved indsættelsen af dataen. Prøv igen.</div>';
                    }
                }
            }
        } else 
        {
            $status = '<div class="error">Dataen gik desværre ikke igennem, prøv igen.</div>';
        }
        }
?>


<h2>Opdater Nyhed</h2>

<div class="create-news">
    <form method="post">
        <?= Token::createTokenInput() ?>
        <input type="text" name="newsTitle" placeholder="Nyheds Titel" value="<?= $CurrentNews->newsTitle ?>">
        <?= @$error['newsTitle'] ?>
        <input name="startDate" class="datePicker" type="text" placeholder="Nyheds Start dato" value="<?= $startDate ?>">
        <?= @$error['startDate'] ?>
        <input name="endDate" class="datePicker" type="text" placeholder="Nyheds Slut dato" value="<?= $endDate ?>">
        <?= @$error['endDate'] ?>
        <textarea name="newsMessage" class="editor" placeholder="Nyheds Besked"><?= $CurrentNews->newsContent ?></textarea>
        <?= @$error['content'] ?>
        <input name="newsSubmit" type="submit" value="Opdater">
        <?= @$status ?>
    </form>

</div>