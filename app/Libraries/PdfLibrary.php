<?php

namespace App\Libraries;

use TCPDF;

/**
 * Description of Pdf Library
 *
 * @author https://roytuts.com
 */
class PdfLibrary extends TCPDF
{

    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

    public function Header()
    {
        // For invoice PDFs, do not add custom header
        // InvoicePdfGenerator handles its own header
    }

    // Page footer
    public function Footer()
    {
        // For invoice PDFs, do not add custom footer
        // InvoicePdfGenerator handles its own footer if needed
    }
}
