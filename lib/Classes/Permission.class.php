<?php

class Permission extends Database
{

    public static function Login(array $DATA) : bool
    {
        try
        {
            $PASSWORD = (new self)->query("SELECT password FROM users WHERE username = :USERNAME",
            [
                ':USERNAME' => $DATA['username']
            ])->fetch();
            if(password_verify($DATA['password'], $PASSWORD->password))
            {
                return true;
            }
            return false;
        } 
            catch(PDOException $e)
        {
            return false;
        }
    }

    public static function LoginCheck() : bool
    {
        if(isset($_SESSION['user']['username']) && isset($_SESSION['user']['userId']) && isset($_SESSION['user']['userEmail']) && isset($_SESSION['user']['fullname']) && isset($_SESSION['user']['userRole']) && isset($_SESSION['user']['userKm']))
        {
            $err = 0;
            for($i=0;$i<count($_SESSION['user']);$i++)
            {
                $sql = "SELECT ".$_SESSION['user'][$i]." FROM users WHERE ".$_SESSION['user'][$i]." = :".strtoupper($_SESSION['user'][$i])."";
                $userData = (new self)->query($sql, [':'.strtoupper($_SESSION['user'][$i]) => $_SESSION['user'][$i]])->fetch();
                if(sizeof($userData) !== 1)
                {
                    $err++;
                }
            }
            if($err == 0)
            {
                return true;
            }
            else 
            {
                return false;
            }
        }
        return false;
    }
}
