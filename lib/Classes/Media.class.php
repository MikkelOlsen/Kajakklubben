<?php

class Media extends Database
{

    public static function ImageHandler(array $files, array $options = [], $crop = false )
    {
        try {
            if(!file_exists($options['path'])) {
                mkdir($options['path'], 0777, true);
            }
            $err = [];
            $uniqueName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
            foreach($options['sizes'] as $size) {
            $validExts = $options['validExts'];
            $width = $size['width'];
            $height = $size['height'];
            $ext = strtolower(pathinfo($files['name'], PATHINFO_EXTENSION));
            if(in_array($ext, $validExts)) {
                list($w, $h) = getimagesize($files['tmp_name']);
                $x = 0;
                $y = 0;
                $ratio = $w / $h;
                $fileName = $width.'x'.$height.'_'.$uniqueName.'.'.$ext;
                $path = $options['path'].'/'.$fileName;

                if($crop) {
                    $ratio = $width / $w;       //try max width first...
                    $newWidth = $width;
                    $newHeight = $h * $ratio;  
                    if ($newHeight < $height) {  //if that created an image smaller than what we wanted, try the other way
                        $ratio = $height / $h;
                        $newHeight = $height;
                        $newWidth = $w * $ratio;
                    }
                    elseif ($newHeight > $height) { //crop vertically
                        $extra = $newHeight - $height;
                        $x = 0; //source x
                        $y = round($extra / 2); //source y
                    }
                    else {
                        $extra = $newWidth - $width;
                        $x = round($extra / 2); //source x
                        $y = 0; //source y
                    }
                } else 
                {

                    if($width/$height > $ratio) {
                        $newWidth = $height*$ratio;
                        $newHeight = $height;
                    } else 
                    {
                        $newWidth = $width;
                        $newHeight = $width/$ratio;
                    }
                }
                
                /* Save image */
                switch ($files['type']) {
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($files['tmp_name']);
                        $tmp = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmp, $image,
                        0, 0,
                        $x, $y,
                        $newWidth, $newHeight,
                        $w, $h);
                        imagejpeg($tmp, $path, 100);
                    break;

                    case 'image/png':
                        $image = imagecreatefrompng($files['tmp_name']);
                        $tmp = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmp, $image,
                        0, 0,
                        $x, $y,
                        $newWidth, $newHeight,
                        $w, $h);
                        imagepng($tmp, $path, 0);
                    break;

                    case 'image/gif':
                        $image = imagecreatefromgif($files['tmp_name']);
                        $tmp = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmp, $image,
                        0, 0,
                        $x, $y,
                        $newWidth, $newHeight,
                        $w, $h);
                        imagegif($tmp, $path);
                    break;

                    default:
                    exit;
                    break;
                }
            } else {
                $err['err'] = '<b style="color:black;">'.$files['name'].'</b> Filen er ikke gyldig da <b style="color:black;">.'.$ext.'</b> ikke er en gyldig fil format.';
            }
        }
            if(sizeof($err) > 0) {
                return $err;
            }

                $returnArray = array(
                    'filePath' => $options['path'],
                    'fileName' => $uniqueName,
                    'mime' => $ext
                );
                if(isset($options['create']) && $options['create'] == true) {
                    return self::ImageUploader($returnArray);
                } else {
                    return $returnArray;
                }
                /* cleanup memory */
                imagedestroy($image);
                imagedestroy($tmp);
            
        
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function ImageUploader(array $infoArray) : object
    { 
        $file = (new self)->query("INSERT INTO `media`(`filepath`, `filename`, `mime`) VALUES (:filepath, :filename, :mime)", [':filepath' => $infoArray['filePath'], ':filename' => $infoArray['fileName'], ':mime' => $infoArray['mime']]);
        return (new self)->query("SELECT mediaId FROM media WHERE filename = :FILENAME", [':FILENAME' => $infoArray['fileName']])->fetch();
    }

    public static function UnlinkImage($mediaId, $delete = false) : bool
    {
        try {
            $infoArray = (new self)->query("SELECT * FROM media WHERE mediaId = :id", [':id' => $mediaId])->fetch();
            if($delete == true) {
                (new self)->query("DELETE FROM media WHERE mediaId = :id", [':id' => $mediaId]);
            }
            $files = glob($infoArray->filepath.'/*'.$infoArray->filename.'.'.$infoArray->mime);
            foreach($files as $file) {
                if(file_exists($file)) {
                    unlink($file);
                }
            }
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return false;
    }

    public static function UpdateImg(array $files, array $options = [], $crop = false) : bool
    {
           $infoArray = self::ImageHandler($files, $options, $crop);
           var_dump($crop);
           if(array_key_exists('filePath', $infoArray)) 
           {
           try {
            self::UnlinkImage($options['mediaId']);
            (new self)->query("UPDATE `media` SET `filepath`=:PATH, `filename`=:NAME, `mime`=:MIME WHERE mediaId = :ID", 
            [
                ':PATH' => $infoArray['filePath'],
                ':NAME' => $infoArray['fileName'],
                ':MIME' => $infoArray['mime'],
                ':ID' => $options['mediaId']
            ]);
            return true;
           } catch(PDOExcetption $e) {
               return false;
           }
        } else {
            return $infoArray;
        }
           return false;
    }

    public static function MultiUploadArray($FILES) : array
    {
        $files = count($FILES['name']);
        $FileArray = [];
        for($i = 0; $i<$files; $i++) {
                $FileArray[$i] = array(
                    'name' => $FILES['name'][$i],
                    'type' => $FILES['type'][$i],
                    'tmp_name' => $FILES['tmp_name'][$i],
                    'error' => $FILES['error'][$i],
                    'size' => $FILES['size'][$i]
                );
        }

        return $FileArray;
    }
}