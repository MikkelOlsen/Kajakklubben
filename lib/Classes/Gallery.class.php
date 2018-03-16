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
                                  INNER JOIN events 
                                  ON gallery.fkGalleryEventId = events.eventsId
                                  WHERE events.eventsId = :ID",
                                  [
                                      ':ID' => $ID
                                  ])->fetchAll();
    }

    public static function InsertGallery(string $MediaId, string $EventId) : bool
    {
        try 
        {
            (new self)->query("INSERT INTO gallery (fkGalleryEventId, fkGalleryMediaId) VALUES (:EVENTID, :MEDIAID)",
                                [
                                    ':EVENTID' => $EventId,
                                    ':MEDIAID' => $MediaId
                                ]);
            return true;
        } catch(PDOException $e)
        {
            return false;
        }
        return false;
    }

    public static function GetAllGalleries() : array
    {
        return (new self)->query("SELECT events.eventTitle, events.eventStartDate, events.eventsId
                                    FROM events
                                    INNER JOIN gallery
                                    ON gallery.fkGalleryEventId = events.eventsId
                                    GROUP BY events.eventsId")->fetchAll();
    }
}