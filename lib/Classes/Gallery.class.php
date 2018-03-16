<?php

class Gallery extends Database
{

    public static function GetAllCoversByDate() : array
    {
        return (new self)->query("SELECT `eventsId`, `eventTitle`, `eventStartDate`, filename, filepath, mime FROM `events`
                                  INNER JOIN media
                                  ON events.eventCover = media.mediaId
                                  WHERE DATE(NOW()) >= `eventStartDate` ORDER BY `eventStartDate` DESC")->fetchAll();
    }

    public static function GetAllEventImages(string $ID) : array
    {
        return (new self)->query("SELECT galleryId, filename, filepath, mime FROM gallery 
                                  INNER JOIN media 
                                  ON gallery.fkGalleryMediaId = media.mediaId
                                  INNER JOIN album
                                  ON gallery.fkGalleryAlbumId = albums.albumId
                                  WHERE albums.albumId = :ID",
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

    public static function GetAllGalleries() : array
    {
        return (new self)->query("SELECT * FROM albums")->fetchAll();
    }

    public static function DeleteSingleImage(string $ID) : object
    {
        $mediaId = (new self)->query("SELECT fkGalleryMediaId FROM gallery WHERE galleryId = :ID", [':ID' => $ID])->fetch();
        (new self)->query("DELETE FROM gallery WHERE galleryId = :ID", [':ID' => $ID]);
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

}