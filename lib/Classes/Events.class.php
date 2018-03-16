<?php

class Events extends Database
{



    public static function InsertEvent(array $DATA, string $ID) : bool
    {
        try 
        {
            (new self)->query("INSERT INTO events (eventTitle, eventDescription, eventStartDate, eventCover) VALUES (:TITLE, :CONTENT, STR_TO_DATE(:START, '%m/%d/%Y'), :COVER)", 
            [
                ':TITLE' => $DATA['eventTitle'],
                ':CONTENT' => $DATA['content'],
                ':START' => $DATA['startDate'],
                ':COVER' => $ID
            ]);
            return true;
        } catch (PDOException $e) 
        {
            return false;
        }
    }

    public static function GetAllEvents() : array
    {
        return (new self)->query("SELECT * FROM events")->fetchAll();
    }

    public static function DeleteEvent(string $ID) : object
    {
        $mediaId = (new self)->query("SELECT eventCover FROM events WHERE eventsId = :ID", [':ID' => $ID])->fetch();
        (new self)->query("DELETE FROM events WHERE eventsId = :ID", [':ID' => $ID]);
        return $mediaId;
    }

    public static function CurrentEvent(string $ID) : object
    {
        return (new self)->query("SELECT * FROM events WHERE eventsId = :ID", [':ID' => $ID])->fetch();
    }

    public static function UpdateEvent(array $DATA, string $ID) : bool
    {
        try 
        {
            (new self)->query("UPDATE `events` SET `eventTitle` = :TITLE, `eventStartDate` = STR_TO_DATE(:START, '%m/%d/%Y') ,`eventDescription` = :CONTENT WHERE `eventsId` = :ID", 
            [
                ':TITLE' => $DATA['eventTitle'],
                ':CONTENT' => $DATA['content'],
                ':START' => $DATA['startDate'],
                ':ID' => $ID
            ]);
            return true;
        } catch (PDOException $e) 
        {
            echo $e->getMessage();
            return false;
        }
    }

    public static function GetAllEventsByDate() : array
    {
        return (new self)->query("SELECT `eventsId`, `eventTitle`, `eventDescription`, `eventStartDate`, filename, filepath, mime FROM `events`
                                  INNER JOIN media
                                  ON events.eventCover = media.mediaId
                                  WHERE DATE(NOW()) <= `eventStartDate` ORDER BY `eventStartDate` DESC")->fetchAll();
    }

    public static function GetAllEventsByDateReverse() : array
    {
        return (new self)->query("SELECT events.eventTitle, events.eventsId
                                FROM events
                                LEFT JOIN albums
                                ON albums.albumEventId = events.eventsId
                                WHERE DATE(NOW()) >= `eventStartDate`
                                ORDER BY `eventStartDate` DESC")->fetchAll();
    }
}