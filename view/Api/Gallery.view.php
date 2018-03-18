<?php
    if(Router::GetParamByName('DELID') !== NULL)
    {
        if(Gallery::CoverCheck(Router::GetParamByName('DELID')) == true)
        {
            if(Gallery::DeleteSingleImage(Router::GetParamByName('DELID')) == true) 
            {
                if(Media::UnlinkImage(Router::GetParamByName('DELID')) == true)
                {
                    echo json_encode(['err' => false]);
                } else 
                {
                    echo json_encode(['err' => true, 'msg' => 'Kunne ikke fjerne filen til billede : ' . $mediaId->fkGalleryMediaId]);
                }
            }
        } 
        else 
        {
            echo json_encode(['err' => true, 'msg' => 'Du kan ikke slette coverbilledet fra et galleri.']);
        }
    } 
    else 
    {
        echo json_encode(['err' => true, 'msg' => 'Fejl i billede ID : ' . Router::GetParamByName('DELID')]);
    }
?>