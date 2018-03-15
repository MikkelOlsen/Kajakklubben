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
}