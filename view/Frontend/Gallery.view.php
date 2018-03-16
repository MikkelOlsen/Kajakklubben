<div class="gallery">
    <h2>Galleri</h2>
    
    <?php
    if(!isset(Router::$Params['album'])) 
    {
        echo '<div class="albums">';
        foreach(Gallery::GetAllCoversByDate() as $cover)
        {
            echo '<div class="album">';
            echo '<a href="'.Router::$BASE.'Galleri/'.$cover->albumId.'">';
            echo '<img src="'.$cover->filepath.'/222x171_'.$cover->filename.'.'.$cover->mime.'" alt="'.$cover->albumName.'">';
            echo '<div class="album-overlay">';
            echo '<p class="album-name">'.$cover->albumName.'</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        } 
        echo '</div>';
    } elseif(isset(Router::$Params['album']))
    {
        $currentAlbum = Gallery::CurrentAlbum(Router::GetParamByName('album'));
        echo '<h2>Album / '.$currentAlbum->albumName.'</h2>';
        echo '<div class="albums">';
        foreach(Gallery::GetAllalbumImages(Router::GetParamByName('album')) as $galleryImage)
        {
            echo '<div class="album">';
            echo '<img class="lightbox_img" data-jslghtbx-group="'.$currentAlbum->albumName.'" data-jslghtbx="../'.$galleryImage->filepath.'/900x600_'.$galleryImage->filename.'.'.$galleryImage->mime.'" src="../'.$galleryImage->filepath.'/222x171_'.$galleryImage->filename.'.'.$galleryImage->mime.'" alt="'.$currentAlbum->albumName.'">';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
        
    
</div>