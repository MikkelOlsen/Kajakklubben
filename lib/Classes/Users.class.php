<?php

class Users extends Database
{

    public static function UsernameCheck(string $USERNAME)
    {
        try
        {
            $userArray = (new self)->query("SELECT * FROM users WHERE username = :USERNAME", [':USERNAME' => $USERNAME])->fetchAll();
            if(sizeof($userArray) == 0)
            {
                return true;
            }
            return false;
        } catch(PDOException $e)
        {
            return false;
        }
    }

    public static function CreateUser(array $DATA, string $MEDIA) : bool
    {
        try
        {
            $PASSWORD = password_hash($DATA['password'], PASSWORD_BCRYPT);
            (new self)->query("INSERT INTO `users`(`username`, `password`, `fullname`, `userRole`, `userEmail`, `avatar`, `userKm`) 
                               VALUES (:USERNAME, :PASSWORD, :FULLNAME, :USERROLE, :EMAIL, :AVATAR, :KM)",
                               [
                                   ':USERNAME' => $DATA['username'],
                                   ':PASSWORD' => $PASSWORD,
                                   ':FULLNAME' => $DATA['fullName'],
                                   ':USERROLE' => $DATA['userRole'],
                                   ':EMAIL' => $DATA['email'],
                                   ':AVATAR' => $MEDIA,
                                   ':KM' => $DATA['userKM']
                               ]);
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        }
    }

    public static function UpdateUser(array $DATA, string $ID) : bool
    {
        try
        {
            (new self)->query("UPDATE `users` SET `username`=:USERNAME, `fullname`=:FULLNAME, `userRole`=:USERROLE, `userEmail`=:EMAIL, `userKm`=:KM
                                WHERE userId = :ID",
                               [
                                   ':USERNAME' => $DATA['username'],
                                   ':FULLNAME' => $DATA['fullName'],
                                   ':USERROLE' => $DATA['userRole'],
                                   ':EMAIL' => $DATA['email'],
                                   ':KM' => $DATA['userKM'],
                                   ':ID' => $ID
                               ]);

            if(isset($DATA['password']))
            {
                $PASSWORD = password_hash($DATA['password'], PASSWORD_BCRYPT);
                (new self)->query("UPDATE `users` SET `password`=:PASSWORD
                                WHERE userId = :ID",
                               [
                                   ':PASSWORD' => $PASSWORD,
                                   ':ID' => $ID
                               ]);

            }
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public static function UserRoles(string $LEVEL) : array
    {
        return (new self)->query("SELECT * from userroles WHERE roleLevel <= :LEVEL", [':LEVEL' => $LEVEL])->fetchAll();
    }

    public static function AllUsers() : array
    {
        return (new self)->query("SELECT userId, username, fullname, userroles.roleName, userroles.roleLevel, userEmail, userKm, media.filename, media.filepath, media.mime FROM `users`
                                INNER JOIN userroles
                                ON users.userRole = userroles.roleId
                                INNER JOIN media
                                ON users.avatar = media.mediaId")->fetchAll();
    }

    public function DeleteUser(string $ID) : object
    {
        $mediaId = (new self)->query("SELECT avatar FROM users WHERE userId = :ID", [':ID' => $ID])->fetch();
        (new self)->query("DELETE FROM users WHERE userId = :ID", [':ID' => $ID]);
        return $mediaId;
    }

    public static function CurrentUser(string $ID) : object
    {
        return (new self)->query("SELECT userId, username, fullname, userroles.roleName, userEmail, userKm, media.filename, media.filepath, media.mime, avatar, userRole
                                    FROM `users`
                                    INNER JOIN userroles
                                    ON users.userRole = userroles.roleId
                                    INNER JOIN media
                                    ON users.avatar = media.mediaId
                                    WHERE userId = :ID", [':ID' => $ID])->fetch();
    }

    public static function CurrentUserImage() : object
    {
        return (new self)->query("SELECT * FROM media WHERE mediaId = :ID", [':ID' => $_SESSION['USER']['AVATAR']])->fetch();
    }

    public static function CurrentUserLevel() : object
    {
        return (new self)->query("SELECT userLevelName
                                    FROM userlevels
                                    WHERE userLevelReqKm = (SELECT MAX(userLevelReqKm) FROM userlevels WHERE userLevelReqKm <= :USERKM)", [':USERKM' => $_SESSION['USER']['USERKM']])->fetch();
    }

    public static function CurrentUserEvents() : array
    {
        return (new self)->query("SELECT eventTitle, eventStartDate 
                                    FROM eventsubscribers
                                    INNER JOIN events 
                                    ON eventsubscribers.fkEventId = events.eventsId
                                    WHERE DATE(NOW()) <= `eventStartDate`
                                    AND fkEventSubUserId = :ID
                                    ORDER BY `eventStartDate` DESC", [':ID' => $_SESSION['USER']['USERID']])->fetchAll();
    }

    public static function SignEvent(string $ID, string $USER) : bool
    {
        try
        {
            (new self)->query("INSERT INTO eventsubscribers (fkEventSubUserId, fkEventId) VALUES (:USER, :EVENT)", [':USER' => $USER, ':EVENT' => $ID]);
            return true;
        } catch(PDOException $e)
        {
            return false;
        }
    }

    public static function OutEvent(string $ID, string $USER) : bool
    {
        try
        {
            (new self)->query("DELETE FROM eventsubscribers WHERE fkEventSubUserID = :USER AND fkEventID = :EVENT", [':USER' => $USER, ':EVENT' => $ID]);
            return true;
        } catch(PDOException $e)
        {
            return false;
        }
    }

    public static function UserEventCheck(string $ID) : bool
    {
        $userData = (new self)->query("SELECT * FROM eventsubscribers WHERE fkEventSubUserId = :USER AND fkEventId = :EVENT", [':USER' => $_SESSION['USER']['USERID'], ':EVENT' => $ID])->fetch();
        if($userData !== false)
        {
            return false;
        }
        return true;
    }
}
