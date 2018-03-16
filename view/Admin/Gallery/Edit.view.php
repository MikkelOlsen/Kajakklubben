<?php
    if(Router::GetParamByName('ID') == NULL) {
        Router::Redirect('/Admin/Gallery');
    }
    // $currentAlbum = Events::CurrentEvent(Router::GetParamByName('ID'));
    // $gallery = Gallery::GetAllEventImages(Router::GetParamByName('ID'));
    // if(sizeof($gallery) == 0) 
    //         {
    //             Router::Redirect('/Admin/Gallery');
    //         }

    if(isset($POST['submit'])) {
       if(!empty($_FILES['files']['name'][0])) {
           $errArr = [];
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
                'path' => 'assets/images/gallery/'.$currentAlbum->eventTitle,
                'create' => true,
                'mediaId' => Router::GetParamByName('ID')
            );
                $MultiArray = Media::MultiUploadArray($_FILES);
                for($i=0;$i<count($MultiArray);$i++){
                    $mediaId = Media::ImageHandler($MultiArray[$i], $options);
                    if(array_key_exists('err', $mediaId)) {
                        $errArr[$i] = $mediaId;
                    }
                    if(sizeof($errArr) == 0) {
                        Gallery::InsertGallery($mediaId->mediaId, Router::GetParamByName('ID'));
                    }
                }
                if(sizeof($errArr) > 0) {
                    $status = '<div class="error">';
                    foreach ($errArr as $error) 
                    {
                        $status .= $error['err'].'<br>';
                    }
                    $status .= '</div>';
                } else {
                    $gallery = Gallery::GetAllEventImages(Router::GetParamByName('ID'));
                }
       } else {
        $status = '<div class="error">Du skal vælge nogle billeder før du kan uploade dem.</div>';
    }
    }
?>


<div class="gallery-edit">
    <div class="form">
    <h2>Rediger Gallariet - <i><?= $currentAlbum->eventTitle ?></i> </h2>

        <div class="create-news">
            <form method="post" enctype="multipart/form-data">
            
                <input type="file" name="files[]" id="file" class="inputfile" multiple="multiple"/>
                <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at tilføje billeder til galleriet.</span></label>

                <input name="submit" type="submit" value="Opdater Galleri">
                <?= @$status ?>
            </form>
        </div>
    </div>
    <div class="gallery">
        <h2>Nuværende billeder</h2>
        <?php
            echo '<div class="albums">';
            
            foreach($gallery as $galleryImage)
            {
                echo '<div class="album">';
                echo '<img src="'. Router::$BASE . $galleryImage->filepath.'/222x171_'.$galleryImage->filename.'.'.$galleryImage->mime.'" alt="'.$currentAlbum->eventTitle.'">';
                echo '<a class="delLink" href="'. Router::$BASE . 'Admin/Gallery/Delete/' . $currentAlbum->eventsId . '/' . $galleryImage->galleryId.'"><i class="material-icons top-right">clear</i></a>';
                echo '</a>';
                echo '</div>';
            }
            echo '</div>'
        ?>
    </div>
</div>