<?php
declare(strict_types = 1);

namespace App\QRCodeLib\QRCode\Renderer;

use App\QRCodeLib\QRCode\Encoder\QrCode;

interface RendererInterface
{
    public function render(QrCode $qrCode) : string;
}
