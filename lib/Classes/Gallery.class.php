<?php

class Gallery extends Database
{

    public static function GetAllCoversByDate() : array
    {
        return (new self)->query("SELECT `albumId`, `albumName`, filename, filepath, mime FROM `albums`
                                  INNER JOIN media
                                  ON albums.albumCoverId = media.mediaId")->fetchAll();
    }

    public static function GetAllAlbumImages(string $ID) : array
    {
        return (new self)->query("SELECT galleryId, filename, filepath, mime 
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

    public static function DeleteSingleImage(string $ID) : object
    {
        $mediaId = (new self)->query("SELECT fkGalleryMediaId FROM gallery WHERE galleryId = :ID", [':ID' => $ID])->fetch();
        (new self)->query("DELETE FROM gallery WHERE galleryId = :ID", [':ID' => $ID]);
        return $mediaId;
    }

    public static function DeleteAlbum(string $ID) : array
    {
        $mediaId = (new self)->query("SELECT fkGalleryMediaId FROM gallery WHERE fkGalleryAlbumId = :ID", [':ID' => $ID])->fetchAll();
        (new self)->query("DELETE FROM gallery WHERE fkGalleryAlbumId = :ID", [':ID' => $ID]);
        (new self)->query("DELETE FROM albums WHERE albumId = :ID", [':ID' => $ID]);
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

    public static function CurrentAlbum(string $ID) : object
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

    public static function UpdateAlbum($DATA, $ID = null) : bool
    {
        (new self)->query("UPDATE albums SET `albumName` = :NAME, `albumEventId` = :EVENTID",
                           [
                               ':NAME' => $DATA['albumName'],
                               ':EVENTID' => $ID
                           ]);
        return true;
    }

}