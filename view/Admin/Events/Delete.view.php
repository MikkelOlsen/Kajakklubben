<?php

if(Router::GetParamByName('ID') !== NULL)
{
    $mediaId = Events::DeleteEvent(Router::GetParamByName('ID'));
    if(Media::UnlinkImage($mediaId->eventCover, true) == true)
    {
        Router::Redirect('/Admin/Events');
    }
} else 
{
    Router::Redirect('/Admin/Events');
}