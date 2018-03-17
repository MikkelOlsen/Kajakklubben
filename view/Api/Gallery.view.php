<?php
    if(Router::GetParamByName('DELID') !== NULL)
        {
            $mediaId = Gallery::DeleteSingleImage(Router::GetParamByName('DELID'));
            if(Media::UnlinkImage($mediaId->fkGalleryMediaId, true) == true)
            {
                echo json_encode(['err' => false]);
            } else 
            {
                echo json_encode(['err' => true, 'msg' => 'Kunne ikke fjerne filen til billede : ' . $mediaId->fkGalleryMediaId]);
            }
        } else {
            echo json_encode(['err' => true, 'msg' => 'Fejl i billede ID : ' . Router::GetParamByName('DELID')]);
        }
?>