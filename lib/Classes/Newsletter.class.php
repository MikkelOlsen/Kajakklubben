<?php

class Newsletter extends Database
{
    public static function NewsletterCheck(string $EMAIL) : bool
    {
        $emailreturn = (new self)->query("SELECT * FROM `newslettersubscribers` WHERE newsLetterSubscribersEmail = :EMAIL", [':EMAIL' => $EMAIL])->fetchAll();
        if(sizeof($emailreturn) == 0)
        {
            return true;
        } else 
        {
            return false;
        }
    }

    public static function CreateNewsletter(string $EMAIL) : bool
    {
        try
        {
            if(self::NewsletterCheck($EMAIL) == true)
            {
                (new self)->query("INSERT INTO newslettersubscribers (newsLetterSubscribersEmail) VALUES (:EMAIL)", [':EMAIL' => $EMAIL]);
                return true;
            }
            else {
                return false;
            }
        } 
        catch(PDOException $e)
        {
            return false;
        }
    }

    public static function NewsletterList() : array
    {
        return (new self)->query("SELECT * FROM newslettersubscribers")->fetchAll();
    }

    public static function DeleteNewsletter(string $ID) : bool
    {
        try
        {
            (new self)->query("DELETE FROM newslettersubscribers WHERE newsLetterSubscribersId = :ID", [':ID' => $ID]);
            return true;
        } catch(PDOException $e)
        {
            return false;
        }
    }
}
