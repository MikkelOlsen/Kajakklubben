<?php

if(Router::GetParamByName('ID') !== NULL)
{
        $mediaId = Products::DeleteProduct(Router::GetParamByName('ID'));
        if(Media::UnlinkImage($mediaId->fkKajakMedia, true) == true)
        {
            Router::Redirect('/Admin/Products');
        }
} 
else 
{
    Router::Redirect('/Admin/Products');
}




