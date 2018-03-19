<div class="gallery">
    
    <?php
    if(!isset(Router::$Params['album'])) 
    {
        $galleries = Gallery::GetAllCoversByDate();
        if(sizeof($galleries) > 0)
        {
            echo '<h2>Galleri</h2>';
            echo '<div class="albums">';
            foreach($galleries as $cover)
            {
                echo '<div class="album">';
                echo '<a href="'.Router::$BASE.'Galleri/'.$cover->albumId.'">';
                if($cover->EVENTFILE)
                {
                    echo '<img src="'.$cover->EVENTPATH.'/222x171_'.$cover->EVENTFILE.'.'.$cover->EVENTMIME.'" alt="'.$cover->eventTitle.'">';
                }
                else 
                {
                    echo '<img src="'.$cover->ALBUMPATH.'/222x171_'.$cover->ALBUMFILE.'.'.$cover->ALBUMMIME.'" alt="'.$cover->albumName.'">';
                
                }
                echo '<div class="album-overlay">';
                if($cover->EVENTFILE)
                {
                    echo '<p class="album-name">'.$cover->eventTitle.'</p>';
                }
                else
                {
    
                    echo '<p class="album-name">'.$cover->albumName.'</p>';
                }
                echo '</div>';
                echo '</a>';
                echo '</div>';
            } 
            echo '</div>';
        }
        else 
        {
            echo '<h2>Der er desværre ingen albummer.</h2>';
        }
        
    } elseif(isset(Router::$Params['album']))
    {
        $currentAlbum = Gallery::CurrentAlbum(Router::GetParamByName('album'));
        if($currentAlbum !== false)
        {
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
        else 
        {
            echo '<h2>Dette album eksistere ikke.</h2>';
        }
    }
    ?>
        
    
</div>