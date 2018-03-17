<?php

class News extends Database
{



    public static function InsertNews(array $DATA) : bool
    {
        try 
        {
            (new self)->query("INSERT INTO news (newsTitle, newsContent, newsStartDate, newsEndDate) VALUES (:TITLE, :CONTENT, STR_TO_DATE(:START, '%m/%d/%Y'), STR_TO_DATE(:END, '%m/%d/%Y'))", 
            [
                ':TITLE' => $DATA['title'],
                ':CONTENT' => $DATA['content'],
                ':START' => $DATA['startDate'],
                ':END' => $DATA['endDate']
            ]);
            return true;
        } catch (PDOException $e) 
        {
            return false;
        }
    }

    public static function GetAllNews() : array
    {
        return (new self)->query("SELECT * FROM news")->fetchAll();
    }

    public static function DeleteNews(string $ID) : void
    {
        (new self)->query("DELETE FROM news WHERE newsId = :ID", [':ID' => $ID]);
    }

    public static function CurrentNews(string $ID) : object
    {
        return (new self)->query("SELECT * FROM news WHERE newsId = :ID", [':ID' => $ID])->fetch();
    }

    public static function UpdateNews(array $DATA, string $ID) : bool
    {
        try 
        {
            (new self)->query("UPDATE news SET `newsTitle` = :TITLE, `newsContent` = :CONTENT, `newsStartDate` = STR_TO_DATE(:START, '%m/%d/%Y'), `newsEndDate` = STR_TO_DATE(:END, '%m/%d/%Y') WHERE `newsId` = :ID", 
            [
                ':TITLE' => $DATA['title'],
                ':CONTENT' => $DATA['content'],
                ':START' => $DATA['startDate'],
                ':END' => $DATA['endDate'],
                ':ID' => $ID
            ]);
            return true;
        } catch (PDOException $e) 
        {
            return false;
        }
    }

    public static function GetAllNewsByDate() : array
    {
        return (new self)->query("SELECT `newsId`,`newsTitle`, `newsContent`, `newsStartDate` FROM `news` WHERE DATE(NOW()) between `newsStartDate` AND `newsEndDate`ORDER BY `newsStartDate` DESC")->fetchAll();
    }

    public static function NewsletterCheck(string $EMAIL) : bool
    {
        $emailreturn = (new self)->query("SELECT newsLetterSubscribersId FROM `newslettersubscribers` WHERE newsLetterSubscribersEmail = :EMAIL LIMIT 1", [':EMAIL' => $EMAIL])->fetchAll();
        if(!isset($emailreturn['newsLetterSubscribersId']))
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


}