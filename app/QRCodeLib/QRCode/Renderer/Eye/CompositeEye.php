<?php
declare(strict_types = 1);

namespace App\QRCodeLib\QRCode\Renderer\Eye;

use App\QRCodeLib\QRCode\Renderer\Path\Path;

/**
 * Combines the style of two different eyes.
 */
final class CompositeEye implements EyeInterface
{
    /**
     * @var EyeInterface
     */
    private $externalEye;

    /**
     * @var EyeInterface
     */
    private $internalEye;

    public function __construct(EyeInterface $externalEye, EyeInterface $internalEye)
    {
        $this->externalEye = $externalEye;
        $this->internalEye = $internalEye;
    }

    public function getExternalPath() : Path
    {
        return $this->externalEye->getExternalPath();
    }

    //TODO: bugs externalEye replace in internalEye
    public function getInternalPath() : Path
    {
        return $this->internalEye->getInternalPath();
    }
}
