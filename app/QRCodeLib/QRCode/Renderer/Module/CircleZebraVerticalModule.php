<?php
declare(strict_types = 1);

namespace App\QRCodeLib\QRCode\Renderer\Module;

use App\QRCodeLib\QRCode\Encoder\ByteMatrix;
use App\QRCodeLib\QRCode\Exception\InvalidArgumentException;
use App\QRCodeLib\QRCode\Renderer\Module\EdgeIterator\EdgeIterator;
use App\QRCodeLib\QRCode\Renderer\Path\Path;

/**
 * Renders individual modules as dots.
 */
final class CircleZebraVerticalModule implements ModuleInterface
{
    public const LARGE = 1;
    public const MEDIUM = .8;
    public const SMALL = .6;

    /**
     * @var float
     */
    private $size;
    private $intensity;
    private $issetLogo;
    private $imgScalePercent = 0.4;

    public function __construct(float $size, $issetLogo, $imgScalePercent = 0.4)
    {
        $this->issetLogo = $issetLogo;
        $this->imgScalePercent = $imgScalePercent;
        if ($size <= 0 || $size > 1) {
            throw new InvalidArgumentException('Size must between 0 (exclusive) and 1 (inclusive)');
        }

        $this->size = $size;
        $this->intensity = $size;
    }

    public function createPath(ByteMatrix $matrix) : Path
    {
        $width = $matrix->getWidth();
        $height = $matrix->getHeight();
        $img_width_point = (int)((($width * $this->imgScalePercent) / 2) + 1);
        $img_height_point = (int)((($height * $this->imgScalePercent) / 2) + 1);

        $widthHalf = (int)($width / 2);
        $heightHalf = (int)($height / 2);

        $path = new Path();
        $halfSize = $this->size / 2;
        $margin = (1 - $this->size) / 2;

        $startPoint = [];
        $endPoint = [];
        $space = true;
        for ($x = 0; $x < $width; ++$x) {

            for ($y = 0; $y < $height; ++$y) {
                if (! $matrix->get($x, $y)) {
                    continue;
                }

                if((($x > ($widthHalf - $img_width_point) && $x < ($widthHalf + $img_width_point)) && ($y > ($heightHalf - $img_height_point) && $y < ($heightHalf + $img_height_point))) && $this->issetLogo){
                    $startPoint = [];
                    $endPoint = [];
                    continue;
                }

                $nextY = false;
                $prevY = false;

                if ($y < ($height - 1) && $matrix->get($x, $y + 1)
                    && !(($x > ($widthHalf - $img_width_point) && $x < ($widthHalf + $img_width_point)) && ($y > ($heightHalf - ($img_height_point + 1)) && $y < ($heightHalf + $img_height_point)))
                    && $this->issetLogo) {
                    $nextY = true;
                }elseif ($y < ($height - 1) && $matrix->get($x, $y + 1) && !$this->issetLogo){
                    $nextY = true;
                }
                if ( $y > 0 && $matrix->get($x, $y - 1)
                    && !(($x > ($widthHalf - $img_width_point) && $x < ($widthHalf + $img_width_point)) && ($y > ($heightHalf - $img_height_point) && $y < ($heightHalf + ($img_height_point + 1))))
                    && $this->issetLogo) {
                    $prevY = true;
                }elseif ($y > 0 && $matrix->get($x, $y - 1) && !$this->issetLogo){
                    $prevY = true;
                }

                $pathX = $x + $margin;
                $pathY = $y + $margin;

                if(!$nextY && !$prevY){
                    $path = $path
                        ->move($pathX + $this->size, $pathY + $halfSize)
                        ->ellipticArc($halfSize, $halfSize, 0, false, true, $pathX + $halfSize, $pathY + $this->size)
                        ->ellipticArc($halfSize, $halfSize, 0, false, true, $pathX, $pathY + $halfSize)
                        ->ellipticArc($halfSize, $halfSize, 0, false, true, $pathX + $halfSize, $pathY)
                        ->ellipticArc($halfSize, $halfSize, 0, false, true, $pathX + $this->size, $pathY + $halfSize)
                        ->close()
                    ;
                }else{
                    if($nextY && !$prevY){
                        $startPoint[0] = $pathX;
                        $startPoint[1] = $pathY;
                        $path = $path
                            ->move($pathX + $this->size, $pathY + $halfSize)
                            ->ellipticArc($halfSize, $halfSize, 0, false, false, $pathX , $pathY + $halfSize)
                            ->close()
                        ;
                    }elseif(!$nextY && $prevY){
                        $endPoint[0] = $pathX;
                        $endPoint[1] = $pathY;
                        $path = $path
                            ->move($pathX + $this->size, $pathY + $halfSize)
                            ->ellipticArc($halfSize, $halfSize, 0, false, true, $pathX , $pathY + $halfSize)
                            ->close()
                        ;

                        if(!empty($startPoint) && !empty($endPoint)){
                            $path = $path
                                ->move($pathX + $this->size, $pathY + $halfSize)
                                ->line($startPoint[0], $startPoint[1] + $halfSize)
                                ->line($endPoint[0], $endPoint[1] + $halfSize)
                                ->line($endPoint[0] + $this->size, $endPoint[1]  + $halfSize)
                                ->line($startPoint[0] + $this->size, $startPoint[1]  + $halfSize)
                                ->line($startPoint[0], $startPoint[1]  + $halfSize)
                                ->close();
                        }
                    }
                }

            }
        }

        return $path;
    }

}
