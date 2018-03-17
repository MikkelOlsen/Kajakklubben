<?php
    if(Router::GetParamByName('ID') !== NULL)
    {
        $mediaId = Gallery::DeleteAlbum(Router::GetParamByName('ID'), Router::$BASE);
        foreach($mediaId  as $media) {
            Media::UnlinkImage($media->fkGalleryMediaId, true);
        }
            Router::Redirect('/Admin/Gallery');
    } else {
        Router::Redirect('/Admin/Gallery');
    }
?>