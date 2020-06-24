<?php
declare(strict_types = 1);

namespace App\QRCodeLib\QRCode;

use App\QRCodeLib\QRCode\Common\ErrorCorrectionLevel;
use App\QRCodeLib\QRCode\Encoder\Encoder;
use App\QRCodeLib\QRCode\Exception\InvalidArgumentException;
use App\QRCodeLib\QRCode\Renderer\RendererInterface;

/**
 * QR code writer.
 */
final class Writer
{
    /**
     * Renderer instance.
     *
     * @var RendererInterface
     */
    private $renderer;

    /**
     * Creates a new writer with a specific renderer.
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Writes QR code and returns it as string.
     *
     * Content is a string which *should* be encoded in UTF-8, in case there are
     * non ASCII-characters present.
     *
     * @throws InvalidArgumentException if the content is empty
     */
    public function writeString(
        string $content,
        string $encoding = Encoder::DEFAULT_BYTE_MODE_ECODING,
        ?ErrorCorrectionLevel $ecLevel = null
    ) : string {
        if (strlen($content) === 0) {
            throw new InvalidArgumentException('Found empty contents');
        }

        if (null === $ecLevel) {
            $ecLevel = ErrorCorrectionLevel::L();
        }

        return $this->renderer->render(Encoder::encode($content, $ecLevel, $encoding));
    }

    /**
     * Writes QR code to a file.
     *
     * @see Writer::writeString()
     */
    public function writeFile(
        string $content,
        string $filename,
        string $encoding = Encoder::DEFAULT_BYTE_MODE_ECODING,
        ?ErrorCorrectionLevel $ecLevel = null
    ) : void {
        file_put_contents($filename, $this->writeString($content, $encoding, $ecLevel));
    }
}