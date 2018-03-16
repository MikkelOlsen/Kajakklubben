<?php
    $currentAlbum = Events::CurrentEvent(Router::GetParamByName('ID'));
?>


<div class="gallery-edit">
    <div class="form">

    </div>
    <div class="gallery">
        <h2>Nuværende billeder til - <i><?= $currentAlbum->eventTitle ?></i></h2>
        <?php
            echo '<div class="albums">';
            foreach(Gallery::GetAllEventImages(Router::GetParamByName('ID')) as $galleryImage)
            {
                echo '<div class="album">';
                echo '<img src="'. Router::$BASE . $galleryImage->filepath.'/222x171_'.$galleryImage->filename.'.'.$galleryImage->mime.'" alt="'.$currentAlbum->eventTitle.'">';
                echo '<a class="delLink" href="' .$galleryImage->galleryId.'"><i class="material-icons top-right">clear</i></a>';
                echo '</a>';
                echo '</div>';
            }
            echo '</div>'
        ?>
    </div>
</div>