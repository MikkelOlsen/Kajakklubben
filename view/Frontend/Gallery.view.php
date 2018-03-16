<div class="gallery">
    <h2>Galleri</h2>
    
    <?php
    if(!isset(Router::$Params['album'])) 
    {
        echo '<div class="albums">';
        foreach(Gallery::GetAllCoversByDate() as $cover)
        {
            echo '<div class="album">';
            echo '<a href="'.Router::$BASE.'Galleri/'.$cover->eventsId.'">';
            echo '<img src="'.$cover->filepath.'/222x171_'.$cover->filename.'.'.$cover->mime.'" alt="'.$cover->eventTitle.'">';
            echo '<div class="album-overlay">';
            echo '<p class="album-name">'.$cover->eventTitle.'</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        } 
        echo '</div>';
    } elseif(isset(Router::$Params['album']))
    {
        $currentAlbum = Events::CurrentEvent(Router::GetParamByName('album'));
        echo '<h2>Album / '.$currentAlbum->eventTitle.'</h2>';
        echo '<div class="albums">';
        foreach(Gallery::GetAllEventImages(Router::GetParamByName('album')) as $galleryImage)
        {
            echo '<div class="album">';
            echo '<img class="lightbox_img" data-jslghtbx-group="'.$currentAlbum->eventTitle.'" data-jslghtbx="../'.$galleryImage->filepath.'/900x600_'.$galleryImage->filename.'.'.$galleryImage->mime.'" src="../'.$galleryImage->filepath.'/222x171_'.$galleryImage->filename.'.'.$galleryImage->mime.'" alt="'.$currentAlbum->eventTitle.'">';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
        
    
</div>