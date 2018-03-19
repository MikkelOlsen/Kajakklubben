<?php
if(Permission::LevelCheck(90) == false)
{
    Router::Redirect('/Admin');
}
    if(Router::GetParamByName('ID') !== NULL)
    {
        $mediaId = Gallery::DeleteAlbum(Router::GetParamByName('ID'));
        foreach($mediaId  as $media) {
            Media::UnlinkImage($media->fkGalleryMediaId, true);
        }
            Router::Redirect('/Admin/Gallery');
    } else {
        Router::Redirect('/Admin/Gallery');
    }
?>