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
}