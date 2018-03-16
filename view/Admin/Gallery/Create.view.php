<?php 
$events = Events::GetAllEventsByDateReverse();
    if(isset($POST['submit'])) {
        $selectValid = false;
        foreach($events as $singleEvent) {
            if($POST['event'] == $singleEvent->eventsId )
            {
                $selectValid = true;
                $eventName = $singleEvent->eventTitle;
                break;
            }
        }
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
                Gallery::InsertGallery($mediaId->mediaId, $POST['event']);
            }
        }

    }
?>
<h2>Opret Galleri</h2>

<div class="create-news">
    <?php
        if(sizeof($events) > 0) {
    ?>
    <form method="post" enctype="multipart/form-data">
        <select name="event">
            <option value="" style="display:none" selected>Klik for at vælge et arrangement, som galleriet skal tilhøre</option>
            <?php
                foreach($events as $event) 
                {
                    echo '<option value="'.$event->eventsId.'">'.$event->eventTitle.'</option>';
                }
            ?>
        </select>
    
        <input type="file" name="files[]" id="file" class="inputfile" multiple="multiple"/>
        <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at vælge billeder til galleriet.</span></label>

        <input name="submit" type="submit" value="Opret Galleri">
        <?= @$status ?>
    </form>
    <?php
        } else 
        {
            echo '<p>Du har desværre ingen arrangementer, hvor der kan tilføjes et galleri.</p>';
            echo '<a href="'. Router::$BASE . 'Admin/Gallery" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Klik her for at gå tilbage.</a>';
        }
    ?>

</div>