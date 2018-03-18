<?php

if(Router::GetParamByName('ID') !== NULL)
{
        $mediaId = Users::DeleteUser(Router::GetParamByName('ID'));
        if(Media::UnlinkImage($mediaId->avatar, true) == true)
        {
            Router::Redirect('/Admin/Users');
        }
} 
else 
{
    Router::Redirect('/Admin/Users');
}




