<?php
    if(Router::GetParamByName('ID') == NULL) {
        Router::Redirect('/Admin/Events');
    }

    $CurrentEvent = Events::CurrentEvent(Router::GetParamByName('ID'));
    $startDate = ucwords(strftime('%m/%d/%Y', strtotime($CurrentEvent->eventStartDate)));
    
    if(isset($POST['eventSubmit']))
    {
        if(Token::validateToken($POST['_once_default']) == true) {
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
                                'height' => '600',
                                'width' => '900'
                            ),
                            'gallery' => array(
                                'height' => '171',
                                'width' => '222' 
                            )
                        ),
                        'path' => 'assets/images/events',
                        'mediaId' => $CurrentEvent->eventCover
                    );

                    if($_FILES['files']['size'] !== 0)
                    {
                        Media::UpdateImg($_FILES['files'], $options);
                    }
                    if(Events::UpdateEvent($DATA, Router::GetParamByName('ID')) == true) 
                    {
                        $status = '<a id="successTooltip" href="'.Router::$BASE.'Admin/Events" class="success">Success</a>
                                  <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="successTooltip">Klik her for at komme tilbage til arrangementer.</div>';

                        $CurrentEvent = Events::CurrentEvent(Router::GetParamByName('ID'));
                        $startDate = ucwords(strftime('%m/%d/%Y', strtotime($CurrentEvent->eventStartDate)));
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

<div class="gallery-edit">

    
    <div class="create-news">
    <form method="post" enctype="multipart/form-data">
        <?= Token::createTokenInput() ?>
        <label for="eventTitle">Arrangemenets Titel</label>
        <input type="text" name="eventTitle" placeholder="Arrangemenets Titel" value="<?= $CurrentEvent->eventTitle ?>">
        <?= @$error['eventTitle'] ?>
        <label for="startDate">Arrangemenets Start Dato</label>
        <input name="startDate" class="datePicker" type="text" placeholder="Arrangemenets Start dato" value="<?= $startDate ?>">
        <?= @$error['startDate'] ?>
        <label for="eventMessage">Arrangemenets Beskrivelse</label>
        <textarea name="eventMessage" class="editor" ><?= $CurrentEvent->eventDescription ?></textarea>
        <?= @$error['content'] ?>
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at vælge arrangemenets billede.</span></label>
        <?= @$error['eventCover'] ?>
        <input name="eventSubmit" type="submit" value="Opdater Arrangement">
        <?= @$status ?>
    </form>

</div>

<div class="current-img">
    <h3>Nuværende Billede</h3>
    <img src="<?= Router::$BASE . $CurrentEvent->filepath . '/900x600_' . $CurrentEvent->filename . '.' . $CurrentEvent->mime ?>" alt="<?= $CurrentEvent->eventTitle ?>">
</div>
            </div>