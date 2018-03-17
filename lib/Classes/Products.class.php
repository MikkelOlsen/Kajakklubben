<?php

class Products extends Database
{
    public static function CreateProduct(array $DATA, $MediaID) : bool
    {
        try 
        {
            
            (new self)->query("INSERT INTO `kajaks`(`kajakName`, `kajakStock`, `fkKajakType`, `fkKajakMedia`) VALUES (:NAME, :STOCK, :TYPE, :MEDIA)",
            [
                ':NAME' => $DATA['productName'],
                ':STOCK' => $DATA['productStock'],
                ':TYPE' => $DATA['productType'],
                ':MEDIA' => $MediaID
            ]);
            if(isset($DATA['productPrice']) && !empty($DATA['productPrice']))
            {
                $kajak = (new self)->query("SELECT kajakId FROM kajaks where kajakName = :NAME",[':NAME' => $DATA['productName']])->fetch();
                (new self)->query("INSERT INTO sales (`salesKajakId`, `salesPrice`) VALUES (:KAJAK, :PRICE)",
                                    [
                                        ':KAJAK' => $kajak->kajakId,
                                        ':PRICE' => $DATA['productPrice']
                                    ]);
            }
            return true;
        } 
        catch(PDOException $e)
        {
            return false;
        }
        return false;
    }

    public static function GetAllProducts(string $ID) : array
    {
        return (new self)->query("SELECT kajaks.kajakId, kajaks.kajakName, kajaks.kajakStock, kajaks.fkKajakMedia, media.filename, media.filepath, media.mime, sales.salesPrice
                                    FROM kajaks 
                                    INNER JOIN media
                                    ON kajaks.fkKajakMedia = media.mediaId
                                    LEFT JOIN sales
                                    ON sales.salesKajakId = kajaks.kajakId
                                    WHERE kajaks.fkKajakType = :ID", [':ID' => $ID])->fetchAll();
    }

    public static function DeleteProduct(string $ID) : object
    {
        $MediaID = (new self)->query("SELECT fkKajakMedia FROM kajaks WHERE kajakId = :ID",
                                    [
                                        ':ID' => $ID
                                    ])->fetch();
        (new self)->query("DELETE FROM sales WHERE salesKajakId = :ID", 
                        [
                            ':ID' => $ID
                        ]);
        (new self)->query("DELETE FROM kajaks WHERE kajakId = :ID",
                         [
                             ':ID' => $ID
                         ]);
        return $MediaID;
    }

    public static function CurrentProduct(string $ID) : object
    {
        return (new self)->query("SELECT kajaks.kajakId, kajaks.kajakName, kajaks.kajakStock, kajaks.fkKajakMedia, media.filename, media.filepath, media.mime, sales.salesPrice, kajaktypes.kajakTypeId
                                    FROM kajaks 
                                    INNER JOIN media
                                    ON kajaks.fkKajakMedia = media.mediaId
                                    INNER JOIN kajaktypes
                                    ON kajaks.fkKajakType = kajaktypes.kajakTypeId
                                    LEFT JOIN sales
                                    ON sales.salesKajakId = kajaks.kajakId
                                    WHERE kajaks.kajakId = :ID", [':ID' => $ID])->fetch();
    }

    public static function UpdateProduct(array $DATA, $ID) : bool
    {
        try 
        {
            
            (new self)->query("UPDATE `kajaks` SET `kajakName`=:NAME,`kajakStock`=:STOCK,`fkKajakType`=:TYPE WHERE kajakId = :ID",
            [
                ':NAME' => $DATA['productName'],
                ':STOCK' => $DATA['productStock'],
                ':TYPE' => $DATA['productType'],
                ':ID' => $ID
            ]);
            if(self::PriceHandler($ID, $DATA) == true) {
                return true;
            }
            return false;
        } 
        catch(PDOException $e)
        {
            return false;
        }
        return false;
    }

    private static function PriceHandler(string $ID, array $DATA) : bool
    {
        $priceCheck = (new self)->query("SELECT * FROM sales WHERE salesKajakId = :ID", [':ID' => $ID])->fetchAll();
        if(sizeof($priceCheck) == 0) {
            if(isset($DATA['productPrice']) && !empty($DATA['productPrice']))
            {
                (new self)->query("INSERT INTO sales (`salesKajakId`, `salesPrice`) VALUES (:KAJAK, :PRICE)",
                                    [
                                        ':KAJAK' => $ID,
                                        ':PRICE' => $DATA['productPrice']
                                    ]);
            }
        } elseif(sizeof($priceCheck) > 0) 
        {
            if(isset($DATA['productPrice']) && !empty($DATA['productPrice']))
            {
                (new self)->query("UPDATE `sales` SET `salesPrice`=:PRICE WHERE salesKajakId = :KAJAK",
                                    [
                                        ':KAJAK' => $ID,
                                        ':PRICE' => $DATA['productPrice']
                                    ]);
            } else {
                (new self)->query("DELETE FROM sales WHERE salesKajakId = :ID", [':ID' => $ID]);
            }
        }
        return true;
    }

}
