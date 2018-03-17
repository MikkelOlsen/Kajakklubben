<?php
    if(Router::GetParamByName('ID') == NULL) {
        Router::Redirect('/Admin/Gallery');
    }
    $currentAlbum = Gallery::CurrentAlbum(Router::GetParamByName('ID'));
    $gallery = Gallery::GetAllAlbumImages(Router::GetParamByName('ID'));
    $events = Events::GetAllEventsByDateReverse();


    if(isset($POST['submit'])) {
        $eventId = null;
        $selectValid = false;
        $error = [];
        if(isset($POST['event']) && !empty($POST['event'])) 
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
                'path' => 'assets/images/gallery/'.$currentAlbum->albumName,
                'create' => true,
                'mediaId' => Router::GetParamByName('ID')
            );
            if(sizeof($error) == 0)
            {
                if($_FILES['files']['size'][0] !== 0) 
                {
                    $MultiArray = Media::MultiUploadArray($_FILES['files']);
                    for($i=0;$i<count($MultiArray);$i++)
                    {
                        $mediaId[$i] = Media::ImageHandler($MultiArray[$i], $options);
                        if(array_key_exists('err', $mediaId[$i])) 
                        {
                            $error[$i] = $mediaId[$i];
                        }
                        
                    }
                    if(sizeof($error) == 0) 
                    {
                        if($POST['albumName'] !== $currentAlbum->albumName || isset($POST['event']) && $POST['event'] !== 0 && $POST['event'] !== $currentAlbum->albumEventId) 
                        {
                            Gallery::UpdateAlbumImg($POST, $eventId);
                        }
                        for($x=0;$x<count($mediaId);$x++){
                            Gallery::InsertGallery($mediaId[$x]->mediaId, Router::GetParamByName('ID'));
                        }
                        $gallery = Gallery::GetAllAlbumImages(Router::GetParamByName('ID'));
                        $currentAlbum = Gallery::CurrentAlbum(Router::GetParamByName('ID'));
                    }
                    if(sizeof($error) > 0) 
                    {
                        $status = '<div class="error">';
                        foreach ($error as $error) 
                        {
                            $status .= $error['err'].'<br>';
                        }
                        $status .= '</div>';
                    } 
                } else {
                    Gallery::UpdateAlbum($POST, $eventId);
                    $currentAlbum = Gallery::CurrentAlbum(Router::GetParamByName('ID'));
                }
        }
       }
?>


<div class="gallery-edit">
    <div class="form">
    <h2>Rediger Albummet - <i><?= $currentAlbum->albumName ?></i> </h2>
    <a id="baseURL" style="display:hidden;" href="<?= Router::$BASE ?>"></a>
        <div class="create-news">
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="albumName" placeholder="Albummets Navn" value="<?= $currentAlbum->albumName ?>">
                <?= @$error['albumTitle'] ?>
                <select name="event">
                    <?php
                        $select = false;
                        $selectDef = '';
                        foreach($events as $event) 
                        {
                            $selected = '';
                            if($event->eventsId == $currentAlbum->albumEventId) {
                                $selected = 'selected';
                                $select = true;
                            }
                            echo '<option selected="'.$selected.'" value="'.$event->eventsId.'">'.$event->eventTitle.'</option>';
                        }
                        if($select == false) {
                            $selectDef = 'selected';
                        }
                        ?>
                    <option <?= $selectDef ?> value="" style="display:none">Klik for at vælge et arrangement, som galleriet skal tilhøre</option>
                </select>
                <?= @$error['event'] ?>

                <input type="file" name="files[]" id="file" class="inputfile" multiple="multiple"/>
                <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at tilføje billeder til galleriet.</span></label>

                <input name="submit" type="submit" value="Opdater Galleri">
                <?= @$status ?>
            </form>
        </div>
    </div>
    <div class="gallery">
        <h2>Nuværende billeder</h2>
        <i class="material-icons remove">clear</i> = Slet Billede<br>
        <i class="material-icons current">check_circle</i> = Cover billede (Kan ikke slettes).
        <?php
            echo '<div class="albums">';
            
            foreach($gallery as $galleryImage)
            {
                $border = 'album_cover';
                $a = '<a class="delLink"><i class="material-icons top-left current">check_circle</i></a>';
                if($galleryImage->fkGalleryMediaId !== $currentAlbum->albumCoverId) 
                {
                    $a = '<a class="delLink" href="' . $galleryImage->galleryId . '"><i class="material-icons top-left remove">remove_circle</i></a>';
                    $border = '';
                }
                echo '<div class="album">';
                echo '<img class="'.$border.'" src="'. Router::$BASE . $galleryImage->filepath.'/222x171_'.$galleryImage->filename.'.'.$galleryImage->mime.'" alt="'.$currentAlbum->albumName.'">';
                echo $a;
                echo '</div>';
            }
            echo '</div>'
        ?>
    </div>
</div>