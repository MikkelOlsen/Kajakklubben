<?php
    if(isset($POST['newsSubmit'])) {
        if(Token::validateToken($POST['_once_default']) == true) {
            if(isset($POST['startDate']) && isset($POST['endDate']) && isset($POST['newsMessage']) && isset($POST['newsTitle']))
            {
                $error = [];
                $DATA['title'] = Validate::stringBetween($POST['newsTitle'], 2, 45) ? $POST['newsTitle']  : $error['newsTitle'] = '<div class="error">Titlen må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
                $DATA['startDate'] = Validate::date($POST['startDate']) ? $POST['startDate'] : $error['startDate'] = '<div class="error">Start dato er ikke i korrekt format.</div>';
                $DATA['endDate'] = Validate::date($POST['endDate']) ? $POST['endDate'] : $error['endDate'] = '<div class="error">Slut dato er ikke i korrekt format.</div>';
                if(in_array($_POST['newsMessage'], array('<p>&nbsp;</p>', ''))) {
                    $error['content'] = '<div class="error">Nyhedens indhold må ikke være tom.</div>';
                } else {
                    $DATA['content'] = $POST['newsMessage'];
                }
                if(sizeof($error) == 0) 
                {
                    if(News::InsertNews($DATA) == true)
                    {
                        $status = '<div class="success">Nyheden er blevet oprettet.</div>';
                    } else 
                    {
                        $status = 'Der skete desværre en fejl ved indsættelsen af dataen. Prøv igen.';
                    }
                }
            }
        }
    }
?>


<h2>Opret Nyhed</h2>

<div class="create-news">
    <form method="post">
        <?= Token::createTokenInput() ?>
        <input type="text" name="newsTitle" placeholder="Nyheds Titel">
        <?= @$error['newsTitle'] ?>
        <input name="startDate" class="datePicker" type="text" placeholder="Nyheds Start dato">
        <?= @$error['startDate'] ?>
        <input name="endDate" class="datePicker" type="text" placeholder="Nyheds Slut dato">
        <?= @$error['endDate'] ?>
        <textarea name="newsMessage" id="editor" placeholder="Nyheds Besked"></textarea>
        <?= @$error['content'] ?>
        <input name="newsSubmit" type="submit" value="Opret">
        <?= @$status ?>
    </form>

</div>