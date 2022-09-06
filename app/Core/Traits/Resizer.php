<?php 

namespace Core\Traits;
 
trait Resizer 
{
    private $obj;

    public function load($filename)
    {
        $obj = new \stdClass();

        list($width, $height, $type) = getimagesize($filename);

        if($type == IMAGETYPE_JPEG)
            $obj->image = imagecreatefromjpeg($filename);
        elseif($type == IMAGETYPE_PNG)
            $obj->image = imagecreatefrompng($filename);
        elseif($type == IMAGETYPE_GIF)
            $obj->image = imagecreatefromgif($filename);

        $obj->width = $width;
        $obj->height = $height;
        $obj->type = $type;

        return $obj;
    }

    public function resize($w, $h, $src) {
        $img = imagecreatetruecolor($w, $h);
        imagecopyresampled($img, $src->image, 0, 0, 0, 0, $w, $h, $src->width, $src->height);
        return $img;
    }

    public function resize_width($w, $src) {
        $r = $w / $src->width;
        $h = $src->height * $r;
        return $this->resize($w, $h, $src);
    }
}