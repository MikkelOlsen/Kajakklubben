<?php 
$events = Events::GetAllEventsByDateReverse();
if(isset($POST['submit'])) {
        $eventId = null;
        $selectValid = false;
        $error = [];
        if(isset($POST['event']) && $POST['event'] !== 0) 
        {
            foreach($events as $singleEvent) {
                if($POST['event'] == $singleEvent->eventsId )
                {
                    $selectValid = true;
                    $eventId = $POST['event'];
                    break;
                }
            }
            if($selectValid == false)
            {
                $error['event'] = '<div class="error">Ugyldig begivenhed, genindlæs siden og prøv igen</div>';
            }
        } 
        $DATA['albumName'] = Validate::stringBetween($POST['albumName'], 2, 45) ? $POST['albumName']  : $error['albumName'] = '<div class="error">Titlen må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
        $DATA['files'] = $_FILES['files']['size'][0] !== 0 ? $_FILES['files'] : $error['image'] = '<div class="error">Du skal vælge minimum ét billede.</div>';
        $eventName = str_replace(' ', '_', $POST['albumName']);
        $mediaId = [];
        $options = array(
            'validExts' => array(
                'jpeg',
                'jpg',
                'png',
                'gif'
            ),
            'sizes' => array(
                'gallery' => array(
                    'height' => '171',
                    'width' => '222' 
                ),
                'big' => array(
                    'height' => '600',
                    'width' => '900' 
                )
            ),
            'path' => 'assets/images/gallery/'.$eventName,
            'create' => true
        );
        if(sizeof($error) == 0) {
            $MultiArray = Media::MultiUploadArray($DATA['files']);
            for($i=0;$i<count($MultiArray);$i++){
                $mediaId[$i] = Media::ImageHandler($MultiArray[$i], $options);
                if(array_key_exists('err', $mediaId[$i])) {
                    $error[$i] = $mediaId[$i];
                }
                
            }
            if(sizeof($error) == 0) {
                $albumId = Gallery::CreateAlbum($DATA, $eventId);
                for($x=0;$x<count($mediaId);$x++){
                    Gallery::InsertGallery($mediaId[$x]->mediaId, $albumId->albumId);
                }
                unset($POST);
                $status = '<a id="successTooltip" href="'.Router::$BASE.'Admin/Gallery" class="success">Success</a>
                        <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="successTooltip">Klik her for at komme tilbage til gallerier.</div>';

            }
            if(sizeof($error) > 0) {
                $error['image'] = '<div class="error">';
                foreach ($error as $imgError) 
                {
                    $error['image'] .= $imgError['err'].'<br>';
                }
                $error['image'] .= '</div>';
            }
        }

    }
?>
<h2>Opret Galleri</h2>

<div class="create-news">

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="albumName" placeholder="Albummets Navn" value="<?= @$POST['albumName'] ?>">
        <?= @$error['albumName'] ?>
        <?php
            if(sizeof($events) > 0) {
        ?>
        <select name="event">
            <option value="" style="display:none" selected>Klik for at vælge et arrangement, som galleriet skal tilhøre</option>
            <?php
                foreach($events as $event) 
                {
                    echo '<option value="'.$event->eventsId.'">'.$event->eventTitle.'</option>';
                }
            ?>
        </select>
        <?= @$error['event'] ?>
        <?php
            } else 
            {
                echo '<p>Du har desværre ingen arrangementer, hvor der kan tilføjes et galleri.</p>';
            }
        ?>
        <input type="file" name="files[]" id="file" class="inputfile" multiple="multiple"/>
        <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at vælge billeder til galleriet.</span></label>
        <?= @$error['image'] ?>
        <input name="submit" type="submit" value="Opret Galleri">
        <?= @$status ?>
    </form>
    

</div>