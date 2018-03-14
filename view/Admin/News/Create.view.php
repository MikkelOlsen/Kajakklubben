<?php
    if(isset($POST['newsSubmit'])) {
        if(Token::validateToken($POST['_once_default']) == true) {
            if(isset($POST['startDate']) && isset($POST['endDate']) && isset($POST['newsMessage']) && isset($POST['newsTitle']))
            {
                $error = [];
                $DATA['title'] = Validate::stringBetween($POST['newsTitle'], 2, 45) ? $POST['newsTitle']  : $error['newsTitle'] = 'Titlen må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.';
                $DATA['startDate'] = Validate::date($POST['startDate']) ? $POST['startDate'] : $error['startDate'] = 'Start dato er ikke i korrekt format.';
                $DATA['endDate'] = Validate::date($POST['endDate']) ? $POST['endDate'] : $error['endDate'] = 'Slut dato er ikke i korrekt format.';
                $DATA['content'] = !empty($POST['newsMessage']) ? $POST['newsMessage'] : $error['content'] = 'Nyhedens indhold må ikke være tom.';

                if(sizeof($error) == 0) 
                {
                    if(News::InsertNews($DATA) == true)
                    {
                        $status = 'Nyheden er blevet oprettet.';
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
    <?= @$status ?>
    <form method="post">
        <?= Token::createTokenInput() ?>
        <input type="text" name="newsTitle" placeholder="Nyheds Titel">

        <input name="startDate" class="datePicker" type="text" placeholder="Nyheds Start dato">

        <input name="endDate" class="datePicker" type="text" placeholder="Nyheds Slut dato">

        <textarea name="newsMessage" id="editor" placeholder="Nyheds Besked"></textarea>

        <input name="newsSubmit" type="submit" value="Opret">
    </form>

</div>