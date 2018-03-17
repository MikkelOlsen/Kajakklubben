<?php

class Categories extends Database
{
    public static function InsertCategory(array $DATA) : bool
    {
        try 
        {
            $LEVEL = isset($DATA['typeDiff']) ? $DATA['typeDiff'] : NULL;
            (new self)->query("INSERT INTO `kajaktypes` (`kajakTypeName`, `kajakTypeLevel`) VALUES (:NAME, :LEVEL)",
            [
                ':NAME' => $DATA['typeName'],
                ':LEVEL' => $LEVEL
            ]);
            return true;
        } 
        catch(PDOException $e)
        {
            return false;
        }
        return false;
    }

    public static function GetAllCategories() : array
    {
        return (new self)->query("SELECT * FROM kajaktypes")->fetchAll();
    }

    public static function DeleteCheck(string $ID) : array
    {
        return (new self)->query("SELECT * FROM kajaks WHERE fkKajakType = :ID", [':ID' => $ID])->fetchAll();
    }

    public static function CurrentCategory(string $ID) : object
    {
        return (new self)->query("SELECT * FROM kajaktypes WHERE kajakTypeId = :ID",[':ID' => $ID])->fetch();
    }

    public static function DeleteCategory(string $ID) : bool
    {
        try 
        {
            (new self)->query("DELETE FROM `kajaktypes` WHERE kajakTypeId = :ID",
            [
                ':ID' => $ID
            ]);
            return true;
        } 
        catch(PDOException $e)
        {
            return false;
        }
        return false;
    }

    public static function UpdateCategory(array $DATA, string $ID) : bool
    {
        try 
        {
            $LEVEL = isset($DATA['typeDiff']) ? $DATA['typeDiff'] : NULL;
            (new self)->query("UPDATE `kajaktypes` SET `kajakTypeName` = :NAME,  `kajakTypeLevel` = :LEVEL WHERE kajakTypeId = :ID",
            [
                ':NAME' => $DATA['typeName'],
                ':LEVEL' => $LEVEL,
                ':ID' => $ID
            ]);
            return true;
        } 
        catch(PDOException $e)
        {
            return false;
        }
        return false;
    }
}
