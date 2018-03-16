<?php
    if(Router::GetParamByName('ID') !== NULL)
    {
        $mediaId = Gallery::DeleteAlbum(Router::GetParamByName('ID'));
        foreach($mediaId  as $media) {
            Media::UnlinkImage($media->fkGalleryMediaId, true);
        }
            Router::Redirect('/Admin/Gallery/Edit/'.Router::GetParamByName('GalleryID'));
    } else {
        Router::Redirect('/Admin/Gallery/Edit/'.Router::GetParamByName('GalleryID'));
    }
?>