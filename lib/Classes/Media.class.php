<?php

class Media extends Database
{

    public static function ImageHandler(array $files, array $options = [], $crop = false )
    {
        try {
            if(!file_exists($options['path'])) {
                mkdir($options['path'], 0777, true);
            }
            foreach($options['sizes'] as $size) {
            $validExts = $options['validExts'];
            $width = $size['width'];
            $height = $size['height'];
            $ext = strtolower(pathinfo($files['name'], PATHINFO_EXTENSION));
            $uniqueName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
            if(in_array($ext, $validExts)) {
                list($w, $h) = getimagesize($files['tmp_name']);

                $ratio = $w / $h;
                $fileName = $width.'x'.$height.'_'.$uniqueName.'.'.$ext;
                $path = $options['path'].'/'.$fileName;

                if($crop) {
                    if($w > $h)
                    {
                        $w = ceil($w-($w*abs($ratio-$width/$height)));
                    } else 
                    {
                        $h = ceil($h-($h*abs($ratio-$height/$height)));
                    }
                    $newWidth = $w;
                    $newHeight = $h;
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
                        0, 0,
                        $newWidth, $newHeight,
                        $w, $h);
                        imagejpeg($tmp, $path, 100);
                    break;

                    case 'image/png':
                        $image = imagecreatefrompng($files['tmp_name']);
                        $tmp = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmp, $image,
                        0, 0,
                        0, 0,
                        $newWidth, $newHeight,
                        $w, $h);
                        imagepng($tmp, $path, 0);
                    break;

                    case 'image/gif':
                        $image = imagecreatefromgif($files['tmp_name']);
                        $tmp = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($tmp, $image,
                        0, 0,
                        0, 0,
                        $newWidth, $newHeight,
                        $w, $h);
                        imagegif($tmp, $path);
                    break;

                    default:
                    exit;
                    break;
                }
            } else {
                return false;
            } 
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

    public static function ImageUploader(array $infoArray)
    {
        $file = (new self)->query("INSERT INTO `media`(`filepath`, `filename`, `mime`) VALUES (:filepath, :filename, :mime)", [':filepath' => $infoArray['filePath'], ':filename' => $infoArray['fileName'], ':mime' => $infoArray['mime']]);
        return (new self)->query("SELECT mediaId FROM media WHERE filename = :FILENAME", [':FILENAME' => $infoArray['fileName']])->fetch();
    }

    public static function unlinkImage($mediaId, $delete = false)
    {
        try {
            $infoArray = $this->db->single("SELECT * FROM media WHERE mediaId = :id", [':id' => $mediaId]);
            if($delete == true) {
                $this->db->query("DELETE FROM media WHERE mediaId = :id", [':id' => $mediaId]);
            }
            $files = glob($infoArray->filepath.'/*'.$infoArray->filename.'.'.$infoArray->mime);
            foreach($files as $file) {
                if(file_exists($file)) {
                    unlink($file);
                }
            }
            return true;
        } catch(PDOException $e) {
            return false;
        }
        return false;
    }

    public static function updateImg(array $files, array $options = [])
    {
       $infoArray = $this->imageHandler($files, $options);

        //  if($this->unlinkImage($options['mediaId']) == true) {
           try {
            $this->db->query("UPDATE `media` SET `filepath`=:path, `filename`=:name, `mime`=:mime WHERE mediaId = :id", 
            [
                ':path' => $infoArray['filePath'],
                ':name' => $infoArray['fileName'],
                ':mime' => $infoArray['mime'],
                ':id' => $options['mediaId']
            ]);
            return true;
           } catch(PDOExcetption $e) {
               return false;
           }
           return false;
    //    }
    }
}