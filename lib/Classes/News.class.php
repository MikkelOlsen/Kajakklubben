<?php

class News
{

    public static function InsertNews(array $DATA)
    {
        try 
        {
            (new Database)->query("INSERT INTO news (newsTitle, newsContent, newsStartDate, newsEndDate) VALUES (:TITLE, :CONTENT, STR_TO_DATE(:START, '%m/%d/%Y'), STR_TO_DATE(:END, '%m/%d/%Y'))", 
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
}