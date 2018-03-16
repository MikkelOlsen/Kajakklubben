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
}