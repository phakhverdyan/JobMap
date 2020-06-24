<?php
declare(strict_types = 1);

namespace App\QRCodeLib\QRCode\Renderer\Image;

use App\QRCodeLib\QRCode\Exception\RuntimeException;
use App\QRCodeLib\QRCode\Renderer\Color\Alpha;
use App\QRCodeLib\QRCode\Renderer\Color\Cmyk;
use App\QRCodeLib\QRCode\Renderer\Color\ColorInterface;
use App\QRCodeLib\QRCode\Renderer\Color\Gray;
use App\QRCodeLib\QRCode\Renderer\Color\Rgb;
use App\QRCodeLib\QRCode\Renderer\Path\Close;
use App\QRCodeLib\QRCode\Renderer\Path\Curve;
use App\QRCodeLib\QRCode\Renderer\Path\EllipticArc;
use App\QRCodeLib\QRCode\Renderer\Path\Line;
use App\QRCodeLib\QRCode\Renderer\Path\Move;
use App\QRCodeLib\QRCode\Renderer\Path\Path;
use App\QRCodeLib\QRCode\Renderer\RendererStyle\Gradient;
use App\QRCodeLib\QRCode\Renderer\RendererStyle\GradientType;
use Imagick;
use ImagickDraw;
use ImagickPixel;

final class ImagickImageBackEnd implements ImageBackEndInterface
{
    /**
     * @var string
     */
    private $imageFormat;

    /**
     * @var int
     */
    private $compressionQuality;

    /**
     * @var Imagick|null
     */
    private $image;

    /**
     * @var ImagickDraw|null
     */
    private $draw;

    /**
     * @var int|null
     */
    private $gradientCount;

    /**
     * @var TransformationMatrix[]|null
     */
    private $matrices;

    /**
     * @var int|null
     */
    private $matrixIndex;

    public function __construct(string $imageFormat = 'png', int $compressionQuality = 100)
    {
        if (! class_exists(Imagick::class)) {
            throw new RuntimeException('You need to install the imagick extension to use this back end');
        }

        $this->imageFormat = $imageFormat;
        $this->compressionQuality = $compressionQuality;
    }

    public function new(int $size, ColorInterface $backgroundColor) : void
    {
        $this->image = new Imagick();
        $this->image->newImage($size, $size, $this->getColorPixel($backgroundColor));
        $this->image->setImageFormat($this->imageFormat);
        $this->image->setCompressionQuality($this->compressionQuality);
        $this->draw = new ImagickDraw();
        $this->gradientCount = 0;
        $this->matrices = [new TransformationMatrix()];
        $this->matrixIndex = 0;
    }

    public function scale(float $size) : void
    {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->draw->scale($size, $size);
        $this->matrices[$this->matrixIndex] = $this->matrices[$this->matrixIndex]
            ->multiply(TransformationMatrix::scale($size));
    }

    public function translate(float $x, float $y) : void
    {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->draw->translate($x, $y);
        $this->matrices[$this->matrixIndex] = $this->matrices[$this->matrixIndex]
            ->multiply(TransformationMatrix::translate($x, $y));
    }

    public function rotate(int $degrees) : void
    {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->draw->rotate($degrees);
        $this->matrices[$this->matrixIndex] = $this->matrices[$this->matrixIndex]
            ->multiply(TransformationMatrix::rotate($degrees));
    }

    public function push() : void
    {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->draw->push();
        $this->matrices[++$this->matrixIndex] = $this->matrices[$this->matrixIndex - 1];
    }

    public function pop() : void
    {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->draw->pop();
        unset($this->matrices[$this->matrixIndex--]);
    }

    public function drawPathWithColor(Path $path, ColorInterface $color) : void
    {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->draw->setFillColor($this->getColorPixel($color));
        $this->drawPath($path);
    }

    public function drawPathWithGradient(
        Path $path,
        Gradient $gradient,
        float $x,
        float $y,
        float $width,
        float $height
    ) : void {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->draw->setFillPatternURL('#' . $this->createGradientFill($gradient, $x, $y, $width, $height));
        $this->drawPath($path);
    }

    public function setLogoImage(LogoImage $logoImage){
        $this->logoImage = $logoImage;
    }

    public function done() : string
    {
        if (null === $this->draw) {
            throw new RuntimeException('No image has been started');
        }

        $this->image->drawImage($this->draw);
        $blob = $this->image->getImageBlob();
        $this->draw->clear();
        $this->image->clear();
        $this->draw = null;
        $this->image = null;
        $this->gradientCount = null;

        return $blob;
    }

    private function drawPath(Path $path) : void
    {
        $this->draw->pathStart();

        foreach ($path as $op) {
            switch (true) {
                case $op instanceof Move:
                    $this->draw->pathMoveToAbsolute($op->getX(), $op->getY());
                    break;

                case $op instanceof Line:
                    $this->draw->pathLineToAbsolute($op->getX(), $op->getY());
                    break;

                case $op instanceof EllipticArc:
                    $this->draw->pathEllipticArcAbsolute(
                        $op->getXRadius(),
                        $op->getYRadius(),
                        $op->getXAxisAngle(),
                        $op->isLargeArc(),
                        $op->isSweep(),
                        $op->getX(),
                        $op->getY()
                    );
                    break;

                case $op instanceof Curve:
                    $this->draw->pathCurveToAbsolute(
                        $op->getX1(),
                        $op->getY1(),
                        $op->getX2(),
                        $op->getY2(),
                        $op->getX3(),
                        $op->getY3()
                    );
                    break;

                case $op instanceof Close:
                    $this->draw->pathClose();
                    break;

                default:
                    throw new RuntimeException('Unexpected draw operation: ' . get_class($op));
            }
        }

        $this->draw->pathFinish();
    }

    private function createGradientFill(Gradient $gradient, float $x, float $y, float $width, float $height) : string
    {
        list($width, $height) = $this->matrices[$this->matrixIndex]->apply($x + $width, $y + $height);
        list($x, $y) = $this->matrices[$this->matrixIndex]->apply($x, $y);
        $width -= $x;
        $height -= $y;

        $startColor = $this->getColorPixel($gradient->getStartColor())->getColorAsString();
        $endColor = $this->getColorPixel($gradient->getEndColor())->getColorAsString();
        $gradientImage = new Imagick();

        switch ($gradient->getType()) {
            case GradientType::HORIZONTAL():
                $gradientImage->newPseudoImage((int) $height, (int) $width, sprintf(
                    'gradient:%s-%s',
                    $startColor,
                    $endColor
                ));
                $gradientImage->rotateImage('transparent', -90);
                break;

            case GradientType::VERTICAL():
                $gradientImage->newPseudoImage((int) $width, (int) $height, sprintf(
                    'gradient:%s-%s',
                    $startColor,
                    $endColor
                ));
                break;

            case GradientType::DIAGONAL():
            case GradientType::INVERSE_DIAGONAL():
                $gradientImage->newPseudoImage((int) ($width * sqrt(2)), (int) ($height * sqrt(2)), sprintf(
                    'gradient:%s-%s',
                    $startColor,
                    $endColor
                ));

                if (GradientType::DIAGONAL() === $gradient->getType()) {
                    $gradientImage->rotateImage('transparent', -45);
                } else {
                    $gradientImage->rotateImage('transparent', -135);
                }

                $rotatedWidth = $gradientImage->getImageWidth();
                $rotatedHeight = $gradientImage->getImageHeight();

                $gradientImage->setImagePage($rotatedWidth, $rotatedHeight, 0, 0);
                $gradientImage->cropImage(
                    intdiv($rotatedWidth, 2) - 2,
                    intdiv($rotatedHeight, 2) - 2,
                    intdiv($rotatedWidth, 4) + 1,
                    intdiv($rotatedWidth, 4) + 1
                );
                break;

            case GradientType::RADIAL():
                $gradientImage->newPseudoImage((int) $width, (int) $height, sprintf(
                    'radial-gradient:%s-%s',
                    $startColor,
                    $endColor
                ));
                break;
        }

        $id = sprintf('g%d', ++$this->gradientCount);
        $this->draw->pushPattern($id, 0, 0, $x + $width, $y + $height);
        $this->draw->composite(Imagick::COMPOSITE_COPY, $x, $y, $width, $height, $gradientImage);
        $this->draw->popPattern();
        return $id;
    }

    private function getColorPixel(ColorInterface $color) : ImagickPixel
    {
        $alpha = 100;

        if ($color instanceof Alpha) {
            $alpha = $color->getAlpha();
            $color = $color->getBaseColor();
        }

        if ($color instanceof Rgb) {
            return new ImagickPixel(sprintf(
                'rgba(%d, %d, %d, %F)',
                $color->getRed(),
                $color->getGreen(),
                $color->getBlue(),
                $alpha / 100
            ));
        }

        if ($color instanceof Cmyk) {
            return new ImagickPixel(sprintf(
                'cmyka(%d, %d, %d, %d, %F)',
                $color->getCyan(),
                $color->getMagenta(),
                $color->getYellow(),
                $color->getBlack(),
                $alpha / 100
            ));
        }

        if ($color instanceof Gray) {
            return new ImagickPixel(sprintf(
                'graya(%d%%, %F)',
                $color->getGray(),
                $alpha / 100
            ));
        }

        return $this->getColorPixel(new Alpha($alpha, $color->toRgb()));
    }
}
