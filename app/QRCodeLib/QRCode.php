<?php
namespace App\QRCodeLib;

use App\QRCodeLib\QRCode\Renderer\ImageRenderer;
use App\QRCodeLib\QRCode\Renderer\Image\SvgImageBackEnd;
use App\QRCodeLib\QRCode\Renderer\Image\ImagickImageBackEnd;
use App\QRCodeLib\QRCode\Renderer\RendererStyle\RendererStyle;
use App\QRCodeLib\QRCode\Renderer\RendererStyle\Fill;
use App\QRCodeLib\QRCode\Renderer\RendererStyle\EyeFill;
use App\QRCodeLib\QRCode\Renderer\Module\RoundnessModuleInner;
use App\QRCodeLib\QRCode\Renderer\Module\RoundnessModuleOuter;
use App\QRCodeLib\QRCode\Renderer\Module\CircleZebraVerticalModule;
use App\QRCodeLib\QRCode\Renderer\Eye\ModuleEye;
use App\QRCodeLib\QRCode\Renderer\Eye\CompositeEye;
use App\QRCodeLib\QRCode\Renderer\Color\Rgb;
use App\QRCodeLib\QRCode\Renderer\Image\LogoImage;
use App\QRCodeLib\QRCode\Common\ErrorCorrectionLevel;
use App\QRCodeLib\QRCode\Encoder\Encoder;
use App\QRCodeLib\QRCode\Writer;

class QRCode{

    private $logoPath;
    private $data;
    private $size;

    private $LogoImage;
    private $issetLogo;
    private $BackgroundRgb;
    private $SingleRgb;
    private $OutEyeRgb;
    private $InnerEyeRgb;

    public function __construct($data, $logoPath, $isLogoData, $size = 600, $backgroundColor = "", $singleColor = "", $outEyeColor = "", $innerEyeColor = "")
    {
        $this->data = $data;
        $this->size = $size;
        $this->issetLogo = false;
        if(!empty($logoPath)){
            $this->LogoImage = new LogoImage($logoPath, $isLogoData);
            $this->issetLogo = true;
        }

        if(empty($backgroundColor)){
            $this->BackgroundRgb = new Rgb(255,255,255);
        }else{
            $this->BackgroundRgb = $this->hexToRGB($backgroundColor);
        }

        if(empty($singleColor)){
            $this->SingleRgb = new Rgb(0,0,0);
        }else{
            $this->SingleRgb = $this->hexToRGB($singleColor);
        }

        if(empty($outEyeColor)){
            $this->OutEyeRgb = new Rgb(0,0,0);
//            if($this->issetLogo){
//                $this->OutEyeRgb = $this->LogoImage->getRGBAverageFromLogo();
//            }else{
//                $this->OutEyeRgb = new Rgb(0,0,0);
//            }
        }else{
            $this->OutEyeRgb = $this->hexToRGB($outEyeColor);
        }

        if(empty($innerEyeColor)){
            $this->InnerEyeRgb = new Rgb(0,0,0);
//            if($this->issetLogo){
//                $this->InnerEyeRgb = $this->LogoImage->getRGBAverageFromLogo();
//            }else{
//                $this->InnerEyeRgb = new Rgb(0,0,0);
//            }
        }else{
            $this->InnerEyeRgb = $this->hexToRGB($innerEyeColor);
        }
    }

    public function getRendererPng(){

        $rgb = $this->LogoImage->getRGBAverageFromLogo();
        $fill =  Fill::withForegroundColor(
            new Rgb(255,255,255),
            new Rgb(0,0,0),
            new EyeFill($rgb, $rgb),
            new EyeFill($rgb, $rgb),
            new EyeFill($rgb, $rgb)
        );


        $module = new CircleZebraVerticalModule(0.9, $this->issetLogo);
        $eye = new CompositeEye(new ModuleEye(new RoundnessModuleOuter(2.2, 1.0)), new ModuleEye(new RoundnessModuleInner(0.8)));


        $renderer = new ImageRenderer(new RendererStyle($this->size, 0, $module, $eye, $fill), new ImagickImageBackEnd(), $this->LogoImage);
        $writer = new Writer($renderer);
        return $writer->writeString($this->data, Encoder::DEFAULT_BYTE_MODE_ECODING, ErrorCorrectionLevel::H());

    }

    public function getRendererSvg(){


        $fill =  Fill::withForegroundColor(
            $this->BackgroundRgb,
            $this->SingleRgb,
            new EyeFill($this->OutEyeRgb, $this->InnerEyeRgb),
            new EyeFill($this->OutEyeRgb, $this->InnerEyeRgb),
            new EyeFill($this->OutEyeRgb, $this->InnerEyeRgb)
        );


        $module = new CircleZebraVerticalModule(0.9, $this->issetLogo);
        $eye = new CompositeEye(new ModuleEye(new RoundnessModuleOuter(2.2, 1.0)), new ModuleEye(new RoundnessModuleInner(0.8)));


        $renderer = new ImageRenderer(new RendererStyle($this->size, 0, $module, $eye, $fill), new SvgImageBackEnd(), $this->LogoImage);
        $writer = new Writer($renderer);
        return $writer->writeString($this->data, Encoder::DEFAULT_BYTE_MODE_ECODING, ErrorCorrectionLevel::H());

    }

    public function fileRendererSvg($file_path){

        $rgb = $this->LogoImage->getRGBAverageFromLogo();
        $fill =  Fill::withForegroundColor(
            new Rgb(255,255,255),
            new Rgb(0,0,0),
            new EyeFill($rgb, $rgb),
            new EyeFill($rgb, $rgb),
            new EyeFill($rgb, $rgb)
        );


        $module = new CircleZebraVerticalModule(0.9, $this->issetLogo);
        $eye = new CompositeEye(new ModuleEye(new RoundnessModuleOuter(2.2, 1.0)), new ModuleEye(new RoundnessModuleInner(0.8)));


        $renderer = new ImageRenderer(new RendererStyle($this->size, 0, $module, $eye, $fill), new SvgImageBackEnd(), $this->LogoImage);
        $writer = new Writer($renderer);
        $writer->writeFile($this->data, $file_path, Encoder::DEFAULT_BYTE_MODE_ECODING, ErrorCorrectionLevel::H());
    }

    public function hexToRGB($hexStr){
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
        $rgbArray = array();
        if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false; //Invalid hex color code
        }
        return new Rgb($rgbArray['red'], $rgbArray['green'], $rgbArray['blue']);
    }

    public function RGBToHex(Rgb $color){

        $R = dechex($color->getRed());
        if (strlen($R)<2)
            $R = '0'.$R;

        $G = dechex($color->getGreen());
        if (strlen($G)<2)
            $G = '0'.$G;

        $B = dechex($color->getBlue());
        if (strlen($B)<2)
            $B = '0'.$B;

        return $R . $G . $B;
    }

    public function getOutEyeHex(){
        return $this->RGBToHex($this->OutEyeRgb);
    }

    public function getInnerEyeHex(){
        return $this->RGBToHex($this->InnerEyeRgb);
    }

    public function getBackgroundHex(){
        return $this->RGBToHex($this->BackgroundRgb);
    }

    public function getSingleHex(){
        return $this->RGBToHex($this->SingleRgb);
    }

    public function getLogoData(){
        return $this->LogoImage->getData();
    }

}