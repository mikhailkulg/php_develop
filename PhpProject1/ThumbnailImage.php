<?php
class ThumbnailImage{
    private $image;
    private $quality = 100;
    private $mimetype;
    private $imageproperties = array();
    private $initialfilesize;
    function __construct($file, $thumbnailsize = 100) {
        is_file($file) or die("ThumbnailImageText1");
        $this->initialfilesize = filesize($file);
        $this->imageproperties = getimagesize($file) or die("ThumbnailImageText2");
        $this->mimetype = image_type_to_mime_type($this->imageproperties[2]);
        switch ($this->imageproperties[2]) {
            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($file);
                break;
            default:
                die("ThumbnailImageText3");
        }
        $this->createThumb($thumbnailsize);
    }
    function __destruct() {
        if(isset($this->image)){
            imagedestroy($this->image);
        }
    }
    private function createThumb($thumbnailsize){
        $srcW = $this->imageproperties[0];
        $srcH = $this->imageproperties[1];
        //if($srcW > $thumbnailsize || $srcH > $thumbnailsize){
            $reduction = $this->calculateReduction($thumbnailsize);
            //$desW = $srcW/$reduction;
            //$desH = $srcH/$reduction;
            $desW = round($srcW/$reduction);
            $desH = round($srcH/$reduction);
            $copy = imagecreatetruecolor($desW, $desH);
            imagecopyresampled($copy, $this->image, 0, 0, 0, 0, $desW, $desH, $srcW, $srcH) or die("ThumbnailImageText4");
            imagedestroy($this->image);
            $this->image = $copy;
        //}
    }
    private function calculateReduction($thumbnailsize){
        $srcW = $this->imageproperties[0];
        $srcH = $this->imageproperties[1];
        if($srcW < $srcH){
            //$reduction = round($srcH/$thumbnailsize);
            $reduction = $srcH/$thumbnailsize;
        } else {
            //$reduction = round($srcW/$thumbnailsize);
            $reduction = $srcW/$thumbnailsize;
        }
        return $reduction;
    }
    function getImage(){
        header("Content-type: $this->mimetype");
        switch ($this->imageproperties[2]){
            case IMAGETYPE_JPEG:
                imagejpeg($this->image, "", $this->quality);
                break;
            case IMAGETYPE_GIF:
                imagegif($this->image);
                break;
            case IMAGETYPE_PNG:
                imagepng($this->image, "", 9);
                break;
            default:
                die("ThumbnailImageText5");   
        }
    }
    function setQuality($quality){
        if($quality > 100 || $quality < 1) $quality = 75;
        if ($this->imageproperties[2] == IMAGETYPE_JPEG) $this->quality = $quality;
    }
    function getQuality(){
        $quality = null;
        if ($this->imageproperties[2] == IMAGETYPE_JPEG) $quality = $this->quality;
        return  $quality;
    }
    function getInitialFileSize(){
        return $this->initialfilesize;
    }
}
?>
