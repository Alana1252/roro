<?php

namespace App\Controllers;

use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeController extends BaseController
{
    public function generate()
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode('123456789', $generator::TYPE_CODE_128);

        // Gunakan barcode sesuai kebutuhan Anda
        echo $barcode;
    }
}
