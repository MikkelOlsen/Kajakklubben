<?php

class Gallery extends Database
{

    public static function GetAllCoversByDate() : array
    {
        return (new self)->query("SELECT `albumId`, `albumName`, eventTitle, eventCover, M1.filename as ALBUMFILE, M1.filepath as ALBUMPATH, M1.mime as ALBUMMIME,
                                  M2.filename as EVENTFILE, M2.filepath as EVENTPATH, M2.mime as EVENTMIME
                                  FROM `albums`
                                  INNER JOIN media M1
                                  ON albums.albumCoverId = M1.mediaId
                                  LEFT JOIN events 
                                  ON albumEventId = events.eventsId
                                  LEFT JOIN media M2
                                  ON events.eventCover = M2.MediaId")->fetchAll();
    }

    public static function GetAllAlbumImages(string $ID) : array
    {
        return (new self)->query("SELECT galleryId, fkGalleryMediaId, filename, filepath, mime 
                                  FROM gallery 
                                  INNER JOIN media 
                                  ON gallery.fkGalleryMediaId = media.mediaId
                                  WHERE gallery.fkGalleryAlbumId = :ID",
                                  [
                                      ':ID' => $ID
                                  ])->fetchAll();
    }

    public static function InsertGallery(string $MediaId, string $AlbumId) : bool
    {
        try 
        {
            (new self)->query("INSERT INTO gallery (fkGalleryAlbumId, fkGalleryMediaId) VALUES (:ALBUMID, :MEDIAID)",
                                [
                                    ':ALBUMID' => $AlbumId,
                                    ':MEDIAID' => $MediaId
                                ]);
            return true;
        } catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
        return false;
    }

    public static function GetAllAlbums() : array
    {
        return (new self)->query("SELECT * FROM albums")->fetchAll();
    }

    public static function DeleteSingleImage(string $ID) : bool
    {
        try
        {
            (new self)->query("DELETE FROM gallery WHERE fkGalleryMediaId = :ID", [':ID' => $ID]);
            return true;
        } catch(PDOException $e)
        {
            return false;
        }
    }

    public static function DeleteAlbum(string $ID) : array
    {
        $mediaId = (new self)->query("SELECT fkGalleryMediaId FROM gallery WHERE fkGalleryAlbumId = :ID", [':ID' => $ID])->fetchAll();
        $galleryName = (new self)->query("SELECT albumName FROM albums WHERE albumId = :ID", [':ID' => $ID])->fetch();
        (new self)->query("DELETE FROM gallery WHERE fkGalleryAlbumId = :ID", [':ID' => $ID]);
        (new self)->query("DELETE FROM albums WHERE albumId = :ID", [':ID' => $ID]);
        $folderName = str_replace(' ', '_', $galleryName->albumName);
        $dir = ROOT . '/assets/images/gallery/' . $folderName ;
        if(is_dir($dir))
        {
            $files = glob($dir . '/*');
            foreach($files as $file)
            {
                unlink($file);
            }
            rmdir($dir);
        }
        return $mediaId;
    }

    public static function CreateAlbum($DATA, $ID = null) : object
    {
        $coverId = (new self)->query("SELECT mediaId FROM `media` ORDER by mediaId DESC LIMIT 1 ")->fetch();
        (new self)->query("INSERT INTO albums (`albumName`, `albumCoverId`, `albumEventId`)
                           VALUES (:NAME, :COVERID, :EVENTID)",
                           [
                               ':NAME' => $DATA['albumName'],
                               ':COVERID' => $coverId->mediaId,
                               ':EVENTID' => $ID
                           ]);
        return (new self)->query("SELECT * FROM albums WHERE albumName = :NAME",[':NAME' => $DATA['albumName']])->fetch();
    }

    public static function CurrentAlbum(string $ID)
    {
        return (new self)->query("SELECT * FROM albums WHERE albumId = :ID", [':ID' => $ID])->fetch();
    }

    public static function UpdateAlbumImg($DATA, $ID = null) : bool
    {
        $coverId = (new self)->query("SELECT mediaId FROM `media` ORDER by mediaId DESC LIMIT 1 ")->fetch();
        (new self)->query("UPDATE albums SET `albumName` = :NAME, `albumCoverId` = :COVERID, `albumEventId` = :EVENTID",
                           [
                               ':NAME' => $DATA['albumName'],
                               ':COVERID' => $coverId->mediaId,
                               ':EVENTID' => $ID
                           ]);
        return true;
    }

    public static function UpdateAlbum(array $DATA, string $ALBUMID , string $ID = null) : bool
    {
        (new self)->query("UPDATE albums SET `albumName` = :NAME, `albumEventId` = :EVENTID
                           WHERE albumId = :ALBUMID",
                           [
                               ':NAME' => $DATA['albumName'],
                               ':EVENTID' => $ID,
                               ':ALBUMID' => $ALBUMID
                           ]);
        return true;
    }

    public static function CoverCheck(string $ID) : bool
    {
        $returnarray = (new self)->query("SELECT albums.albumCoverId, events.eventCover 
                                    FROM media 
                                    LEFT JOIN albums
                                    ON media.mediaId = albums.albumCoverId
                                    LEFT JOIN events	
                                    ON media.mediaId = events.eventCover
                                    WHERE media.mediaId = :ID", [':ID' => $ID])->fetch();
        if($returnarray->albumCoverId == NULL && $returnarray->eventCover == NULL)
        {
            return true;
        }
        return false;
    }

}