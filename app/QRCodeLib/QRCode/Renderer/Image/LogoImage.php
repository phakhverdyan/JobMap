<?php


namespace App\QRCodeLib\QRCode\Renderer\Image;

use App\QRCodeLib\QRCode\Renderer\Color\Rgb;

final class LogoImage{


    private $path;
    private $width;
    private $height;
    private $type;
    private $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    private $rootSize;
    private $scale_percent = 35.0;
    private $isData = false;

    public function __construct(string $path, $isData)
    {
        $this->path = $path;
        $this->isData = $isData;
    }

    public function getData(){
        if($this->isData){
            return $this->path;
        }
        $image = file_get_contents($this->path);
        $imageData = base64_encode($image);
        return 'data: '.mime_content_type($this->path).';base64,'.$imageData;
    }

    public function getHeight(){
        return (string)$this->height;
    }

    public function getWidth(){
        return (string)$this->width;
    }

    public function getPositionX(){
        return (string)(($this->rootSize / 2) - ($this->width / 2));
    }

    public function getPositionY(){
        return (string)(($this->rootSize / 2) - ($this->height / 2));
    }

    public function setRootSize(int $size){
        $this->rootSize = $size;
        $this->width = $this->rootSize * ($this->scale_percent / 100);
        $this->height = $this->rootSize * ($this->scale_percent / 100);
    }

    public function imageCreateFromAny() {
        $type = exif_imagetype($this->path); // [] if you don't have exif you could use getImageSize()
        if (!in_array($type, $this->allowedTypes)) {
            return false;
        }
        switch ($type) {
            case 1 :
                $im = imageCreateFromGif($this->path);
                break;
            case 2 :
                $im = imageCreateFromJpeg($this->path);
                break;
            case 3 :
                $im = imageCreateFromPng($this->path);
                break;
            case 6 :
                $im = imageCreateFromBmp($this->path);
                break;
        }
        return $im;
    }

    public function getRGBAverageFromLogo(){
        $img = $this->imageCreateFromAny();
        $w = imagesx($img);
        $h = imagesy($img);
        $r = $g = $b = 0;
        for($y = 0; $y < $h; $y++) {
            for($x = 0; $x < $w; $x++) {
                $rgb = imagecolorat($img, $x, $y);
                $r += $rgb >> 16 & 255;
                $g += $rgb >> 8 & 255;
                $b += $rgb & 255;
            }
        }
        $pxls = $w * $h;
        $r = dechex(round($r / $pxls));
        $g = dechex(round($g / $pxls));
        $b = dechex(round($b / $pxls));
        if(strlen($r) < 2) {
            $r = 0 . $r;
        }
        if(strlen($g) < 2) {
            $g = 0 . $g;
        }
        if(strlen($b) < 2) {
            $b = 0 . $b;
        }
        return new Rgb(hexdec($r), hexdec($g), hexdec($b));
    }



}