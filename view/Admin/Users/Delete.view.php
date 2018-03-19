<?php

if(Router::GetParamByName('ID') !== NULL)
{
    if($_SESSION['USER']['USERID'] !== Router::GetParamByName('ID'))
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
} 
else 
{
    Router::Redirect('/Admin/Users');
}




