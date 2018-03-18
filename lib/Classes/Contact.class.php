<?php

class Contact extends Database
{   
    public static function SubmitMessage($DATA)
    {
        try
        {
            (new self)->query("INSERT INTO `contact`(`contactName`, `contactEmail`, `contactMobile`, `contactMessage`) VALUES (:NAME, :EMAIL, :PHONE, :MESSAGE)",
                                [
                                    ':NAME' => $DATA['contactName'],
                                    ':EMAIL' => $DATA['contactEmail'],
                                    ':PHONE' => $DATA['contactPhone'],
                                    ':MESSAGE' => $DATA['contactMsg']
                                ]);
            return true;
        } 
        catch(PDOException $e)
        {
            return false;
        }
    }

    public static function GetAllMessages() : array
    {
        return (new self)->query("SELECT * FROM contact")->fetchAll();
    }

    public static function DeleteMsg(string $ID) : bool
    {
        try
        {
            (new self)->query("DELETE FROM contact WHERE contactId = :ID", [':ID' => $ID]);
            return true;
        } catch(PDOException $e)
        {
            return false;
        }
    }
}
