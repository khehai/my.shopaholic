<?php 

namespace Core\Traits;
 
trait Uploader 
{
    private function generateRandomString($length = 10) 
    {
        return substr(str_shuffle(str_repeat
        ($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 
        ceil($length/strlen($x)) )),1,$length);
    }

    private function fileName()
    {
        return sha1(mt_rand(1, 9999).$this->generateRandomString().uniqid()).time();
    }

    public function upload($image, $path='', $type=IMAGETYPE_JPEG, $quality=80)
    {
        $filename = $this->fileName();
        $filepath = STORAGE.$path.$filename;

        if($type == IMAGETYPE_JPEG)
            imagejpeg($image, $filepath, $quality);
        elseif($type == IMAGETYPE_PNG)
            imagepng($image, $filepath);
        elseif($type == IMAGETYPE_GIF)
            imagegif($image, $filepath);

        return "http://".$_SERVER['HTTP_HOST'].MEDIA.$path.$filename;
    }

    
}

