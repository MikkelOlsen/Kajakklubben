<?php
    if(Router::GetParamByName('ID') !== NULL)
    {
        $mediaId = Gallery::DeleteSingleImage(Router::GetParamByName('ID'));
        if(Media::UnlinkImage($mediaId->fkGalleryMediaId, true) == true)
        {
            Router::Redirect('/Admin/Gallery');
        }
    } else {
        Router::Redirect('/Admin/Gallery');
    }
?>