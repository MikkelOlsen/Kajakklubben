<?php 
$events = Events::GetAllEventsByDateReverse();
    if(isset($POST['submit'])) {
        $selectValid = false;
        $eventId = null;
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
        } else {
            $selectValid = true;
        }

        $eventName = str_replace(' ', '_', $POST['albumName']);
        $errArr = [];
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
        if($selectValid) {
            $MultiArray = Media::MultiUploadArray($_FILES);
            for($i=0;$i<count($MultiArray);$i++){
                $mediaId = Media::ImageHandler($MultiArray[$i], $options);
                if(array_key_exists('err', $mediaId)) {
                    $errArr[$i] = $mediaId;
                }
                
            }
            if(sizeof($errArr) == 0) {
                $albumId = Gallery::CreateAlbum($POST, $eventId);
                for($x=0;$x<count($MultiArray);$x++){
                    Gallery::InsertGallery($mediaId->mediaId, $albumId->albumId);
                }
            }
            if(sizeof($errArr) > 0) {
                $status = '<div class="error">';
                foreach ($errArr as $error) 
                {
                    $status .= $error['err'].'<br>';
                }
                $status .= '</div>';
            }
        } else {
            $status = '<div class="error">Der skete en fejl i dit valg af begivenhed, genindlæs siden og prøv igen.</div>';
        }

    }
?>
<h2>Opret Galleri</h2>

<div class="create-news">

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="albumName" placeholder="Albummets Navn">
        <?= @$error['albumTitle'] ?>
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
        <?php
            } else 
            {
                echo '<p>Du har desværre ingen arrangementer, hvor der kan tilføjes et galleri.</p>';
            }
        ?>
        <input type="file" name="files[]" id="file" class="inputfile" multiple="multiple"/>
        <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at vælge billeder til galleriet.</span></label>

        <input name="submit" type="submit" value="Opret Galleri">
        <?= @$status ?>
    </form>
    

</div>