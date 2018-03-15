<?php

class News extends Database
{

    public static $news = null;


    public static function InsertNews(array $DATA)
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

    public static function GetAllNews()
    {
        self::$news = (new self)->query("SELECT * FROM news")->fetchAll();
    }
}