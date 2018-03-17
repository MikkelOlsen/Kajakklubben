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
}
