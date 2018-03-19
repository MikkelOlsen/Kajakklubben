<?php
if(Permission::LevelCheck(90) == false)
{
    Router::Redirect('/Admin');
}
if(Router::GetParamByName('ID') !== NULL)
{
    $AlbumCheck = Events::AlbumCheck(Router::GetParamByName('ID'));
    var_dump($AlbumCheck);
    if(sizeof($AlbumCheck) > 0)
    {
        Gallery::DeleteAlbum($AlbumCheck[0]->albumId);
    }
    $mediaId = Events::DeleteEvent(Router::GetParamByName('ID'));
    if(Media::UnlinkImage($mediaId->eventCover, true) == true)
    {
        Router::Redirect('/Admin/Events');
    }
} else 
{
    Router::Redirect('/Admin/Events');
}