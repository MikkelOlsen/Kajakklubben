<?php
    
    if(isset($POST['eventSubmit']))
    {
        clearstatcache();
        $error = [];
                $DATA['eventTitle'] = Validate::stringBetween($POST['eventTitle'], 2, 45) ? $POST['eventTitle']  : $error['eventTitle'] = '<div class="error">Titlen må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
                $DATA['startDate'] = Validate::date($POST['startDate']) ? $POST['startDate'] : $error['startDate'] = '<div class="error">Start dato er ikke i korrekt format.</div>';
                if(in_array($_POST['eventMessage'], array('<p>&nbsp;</p>', ''))) {
                    $error['content'] = '<div class="error">Arrangementets beskrivelse må ikke være tom.</div>';
                } else {
                    $DATA['content'] = $POST['eventMessage'];
                }
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
                                'height' => '204',
                                'width' => '268'
                            )
                        ),
                        'path' => 'assets/images/site',
                        'create' => true
                    );
                    $MediaId = Media::ImageHandler($_FILES['files'], $options);
                    if(Events::InsertEvent($DATA, $MediaId->mediaId) == true) 
                    {
                        $status = '<div class="success">Arrangementet er blevet oprettet.</div>';
                    } else 
                    {
                        $status = 'Der skete desværre en fejl ved indsættelsen af dataen. Prøv igen.';
                    }
                }
    }
?>

<h2>Opret Arrangement</h2>

<div class="create-news">
    <form method="post" enctype="multipart/form-data">
        <?= Token::createTokenInput() ?>
        <input type="text" name="eventTitle" placeholder="Nyheds Titel">
        <?= @$error['eventTitle'] ?>
        <input name="startDate" class="datePicker" type="text" placeholder="Nyheds Start dato">
        <?= @$error['startDate'] ?>
        <textarea name="eventMessage" class="editor" >Arrangement Beskrivelse</textarea>
        <?= @$error['content'] ?>
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file">Klik for at vælge arrangemenets billede.</label>
        <input name="eventSubmit" type="submit" value="Opret">
        <?= @$status ?>
    </form>

</div>