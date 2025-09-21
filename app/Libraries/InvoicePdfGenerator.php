<?php
namespace App\Libraries;

use TCPDF;

class InvoicePdfGenerator
{
    protected $pdf;
    protected $invoice;
    protected $computed = [];

    protected $defaults = [
        'seller_gstin' => '33AAPFH8577A1Z7',
        'seller_code'  => '33',
        'buyer_gstin'  => '33AAACW7094D1ZD',
        'buyer_code'   => '33',
        'seller_state' => 'Tamil Nadu',
        'buyer_state'  => 'Tamil Nadu',
        'hsn_default'  => '995418',
        'tax_default'  => 18.0,
        'unit_label'   => 'nos',
    ];

    public function __construct(TCPDF $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Generate the Invoice PDF
     *
     * @param array  $invoice_data
     * @param string $outputMode 'I' (inline), 'D' (download), 'F' (file)
     */
    public function generate(array $invoice_data, $outputMode = 'I')
    {
        $this->invoice = $invoice_data;

        // --- Setup ---
        $this->pdf->SetTitle('Tax Invoice #' . ($invoice_data['order_no'] ?? ''));
        $this->pdf->SetSubject('Tax Invoice');
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);
        $this->pdf->SetMargins(10, 10, 10);
        $this->pdf->SetAutoPageBreak(true, 25);
        $this->pdf->AddPage();

        $this->pdf->SetFont('helvetica', '', 10);

        // --- Sections ---
        $this->renderHeader();
        $this->renderSeller();
        $this->renderInvoiceMeta();
        $this->renderBuyer();
        $this->renderProductsTable();
        $this->renderTaxSummary();
        $this->renderAmountWords();
        $this->renderHsnSummary();
        $this->renderTaxWords();
        $this->renderFooterNote();

        // --- Output ---
        $filename = 'Invoice_' . ($invoice_data['order_no'] ?? time()) . '.pdf';
        $this->pdf->Output($filename, $outputMode);
    }

    /* ------------------------------
       Section render methods
    -------------------------------*/

    protected function renderHeader()
    {
        $this->pdf->SetFont('helvetica', 'B', 12);
        $this->pdf->Cell(0, 10, 'Tax Invoice', 0, 1, 'C');
        $this->pdf->SetFont('helvetica', '', 8);
        $this->pdf->Cell(0, 5, '(ORIGINAL FOR RECIPIENT)', 0, 1, 'C');
    }

    protected function renderSeller()
{
    $inv = $this->invoice;

    $this->pdf->SetFont('helvetica', 'B', 10);
    $this->pdf->Cell(0, 8, 'HI FORCE ENTERPRISES', 0, 1, 'L');
    $this->pdf->SetFont('helvetica', '', 8);

    $sellerAddress = "DOOR NO 1/90 SOUTH STREET\nPUTHAKARAM PANDUR, MAYILADUTHURAI\nTAMIL NADU-609203\nPHONE: 7448667735";
    $this->pdf->MultiCell(0, 4, $sellerAddress, 0, 'L', false, 1);

    // your existing seller line
    $this->pdf->Cell(50, 6, 'GSTIN/UIN: ' . ($inv['seller_gstin'] ?? 'N/A'), 0, 0, 'L');
    $this->pdf->Cell(50, 6, 'State Name: ' . ($inv['seller_state'] ?? 'N/A') . ', Code: ' . ($inv['seller_code'] ?? 'N/A'), 0, 1, 'L');
}


    protected function renderInvoiceMeta()
    {
        $inv = $this->invoice;
        $this->pdf->Ln(2);
        $this->pdf->SetFont('helvetica', '', 8);

        $orderNo = $inv['order_no'] ?? '';
        $dateStr = isset($inv['date']) ? date('d-m-Y', strtotime($inv['date'])) : '';

        $this->pdf->Cell(40, 6, 'Invoice No: ' . $orderNo, 0, 0, 'L');
        $this->pdf->Cell(40, 6, 'Date: ' . $dateStr, 0, 1, 'L');
    }

protected function renderBuyer()
{
    $inv = $this->invoice;

    $this->pdf->Ln(2);
    $this->pdf->SetFont('helvetica', 'B', 9);
    $this->pdf->Cell(0, 6, 'Consignee (Ship to)', 0, 1, 'L');
    $this->pdf->SetFont('helvetica', '', 8);

    $buyer_name = $inv['buyer_name'] ?? trim(($inv['first_name'] ?? '') . ' ' . ($inv['last_name'] ?? ''));
    $buyer_address = $inv['buyer_address'] ?? 'Address not available';
    $buyer_state = $inv['buyer_state'] ?? 'N/A';

    $this->pdf->MultiCell(0, 4, $buyer_name . "\n" . $buyer_address . "\n" . $buyer_state, 0, 'L', false, 1);

    $this->pdf->Cell(0, 6, 'GSTIN/UIN: ' . ($inv['buyer_gstin'] ?? 'N/A'), 0, 1, 'L');
    $this->pdf->Cell(50, 6, 'State name: ' . $buyer_state . ', Code: ' . ($inv['buyer_code'] ?? 'N/A'), 0, 1, 'L');
}


    protected function renderProductsTable()
    {
        $inv = $this->invoice;

        $this->pdf->Ln(5);
        $this->pdf->SetFont('helvetica', 'B', 9);
        $this->pdf->SetFillColor(240, 240, 240);
        $this->pdf->Cell(10, 8, 'SI', 1, 0, 'C', true);
        $this->pdf->Cell(60, 8, 'Description of Goods', 1, 0, 'C', true);
        $this->pdf->Cell(20, 8, 'HSN/SAC', 1, 0, 'C', true);
        $this->pdf->Cell(15, 8, 'GST', 1, 0, 'C', true);
        $this->pdf->Cell(20, 8, 'Quantity', 1, 0, 'C', true);
        $this->pdf->Cell(25, 8, 'Rate', 1, 0, 'C', true);
        $this->pdf->Cell(10, 8, 'Per', 1, 0, 'C', true);
        $this->pdf->Cell(30, 8, 'Amount', 1, 1, 'C', true);

        $this->pdf->SetFont('helvetica', '', 8);

        $total_amount = 0.0;
        $total_tax = 0.0;
        $hsn_codes = [];

        $products = $inv['products'] ?? [];

        $sn = 1;
        foreach ($products as $product) {
            $qty = (float)($product['quantity'] ?? 0);
            $rate = (float)($product['rate'] ?? 0);
            $amount = $qty * $rate;
            $tax_rate = (float)($product['tax_rate'] ?? $this->defaults['tax_default']);
            $tax_amount = $amount * ($tax_rate / 100);

            $total_amount += $amount;
            $total_tax += $tax_amount;

            $product_name = $product['name'] ?? $product['product_name'] ?? 'N/A';
            $hsn_sac = $product['hsn_sac'] ?? $this->defaults['hsn_default'];

            $this->pdf->Cell(10, 8, $sn++, 1, 0, 'C');
            $this->pdf->Cell(60, 8, substr($product_name, 0, 30), 1, 0, 'L');
            $this->pdf->Cell(20, 8, $hsn_sac, 1, 0, 'C');
            $this->pdf->Cell(15, 8, $tax_rate . '%', 1, 0, 'C');
            $this->pdf->Cell(20, 8, $qty, 1, 0, 'C');
            $this->pdf->Cell(25, 8, number_format($rate, 2), 1, 0, 'R');
            $this->pdf->Cell(10, 8, $this->defaults['unit_label'], 1, 0, 'C');
            $this->pdf->Cell(30, 8, number_format($amount, 2), 1, 1, 'R');

            // aggregate HSN
            if (!isset($hsn_codes[$hsn_sac])) {
                $hsn_codes[$hsn_sac] = ['amount' => 0, 'tax' => 0];
            }
            $hsn_codes[$hsn_sac]['amount'] += $amount;
            $hsn_codes[$hsn_sac]['tax'] += $tax_amount;
        }

        $this->computed['total_amount'] = $total_amount;
        $this->computed['total_tax'] = $total_tax;
        $this->computed['hsn_codes'] = $hsn_codes;
    }

    protected function renderTaxSummary()
    {
        $total_amount = $this->computed['total_amount'];
        $total_tax = $this->computed['total_tax'];
        $roundoff = $this->invoice['roundoff'] ?? 0;

        $cgst = $total_tax / 2;
        $sgst = $total_tax / 2;
        $final_total = $total_amount + $total_tax + $roundoff;

        $this->pdf->Ln(5);
        $this->pdf->SetFont('helvetica', '', 8);
        $this->pdf->Cell(150, 6, 'CGST', 0, 0, 'R');
        $this->pdf->Cell(20, 6, '9%', 0, 0, 'R');
        $this->pdf->Cell(20, 6, number_format($cgst, 2), 0, 1, 'R');

        $this->pdf->Cell(150, 6, 'SGST', 0, 0, 'R');
        $this->pdf->Cell(20, 6, '9%', 0, 0, 'R');
        $this->pdf->Cell(20, 6, number_format($sgst, 2), 0, 1, 'R');

        if ($roundoff != 0) {
            $this->pdf->Cell(150, 6, 'Rounded off', 0, 0, 'R');
            $this->pdf->Cell(20, 6, '', 0, 0, 'R');
            $this->pdf->Cell(20, 6, number_format($roundoff, 2), 0, 1, 'R');
        }

        $this->pdf->SetFont('helvetica', 'B', 10);
        $this->pdf->Cell(150, 8, 'TOTAL', 0, 0, 'R');
        $this->pdf->Cell(40, 8, number_format($final_total, 2), 0, 1, 'R');

        $this->computed['final_total'] = $final_total;
        $this->computed['cgst'] = $cgst;
        $this->computed['sgst'] = $sgst;
    }

    protected function renderAmountWords()
    {
        $final_total = $this->computed['final_total'] ?? 0;
        $words = $this->convertNumberToWords($final_total);

        $this->pdf->Ln(5);
        $this->pdf->SetFont('helvetica', '', 8);
        $this->pdf->Cell(0, 6, 'Amount chargeable (in word)', 0, 1, 'L');
        $this->pdf->SetFont('helvetica', 'B', 8);
        $this->pdf->Cell(0, 6, 'INR ' . $words . ' Only', 0, 1, 'L');
    }

    protected function renderHsnSummary()
    {
        $hsn_codes = $this->computed['hsn_codes'];
        $cgst = $this->computed['cgst'];
        $sgst = $this->computed['sgst'];
        $total_amount = $this->computed['total_amount'];

        $this->pdf->Ln(10);
        $this->pdf->SetFont('helvetica', 'B', 9);
        $this->pdf->Cell(40, 8, 'HSN/SAC', 1, 0, 'C', true);
        $this->pdf->Cell(40, 8, 'Taxable', 1, 0, 'C', true);
        $this->pdf->Cell(20, 8, 'Central Tax', 1, 0, 'C', true);
        $this->pdf->Cell(15, 8, 'Rate', 1, 0, 'C', true);
        $this->pdf->Cell(20, 8, 'Amount', 1, 0, 'C', true);
        $this->pdf->Cell(20, 8, 'State Tax', 1, 0, 'C', true);
        $this->pdf->Cell(15, 8, 'Rate', 1, 0, 'C', true);
        $this->pdf->Cell(20, 8, 'Amount', 1, 1, 'C', true);

        $this->pdf->SetFont('helvetica', '', 8);

        foreach ($hsn_codes as $hsn => $data) {
            $taxPerSide = $data['tax'] / 2;
            $this->pdf->Cell(40, 8, $hsn, 1, 0, 'C');
            $this->pdf->Cell(40, 8, number_format($data['amount'], 2), 1, 0, 'R');
            $this->pdf->Cell(20, 8, 'CGST', 1, 0, 'C');
            $this->pdf->Cell(15, 8, '9%', 1, 0, 'C');
            $this->pdf->Cell(20, 8, number_format($taxPerSide, 2), 1, 0, 'R');
            $this->pdf->Cell(20, 8, 'SGST', 1, 0, 'C');
            $this->pdf->Cell(15, 8, '9%', 1, 0, 'C');
            $this->pdf->Cell(20, 8, number_format($taxPerSide, 2), 1, 1, 'R');
        }

        // totals row
        $this->pdf->Cell(120, 6, 'Total', 0, 0, 'R');
        $this->pdf->Cell(15, 6, number_format($total_amount, 2), 0, 0, 'R');
        $this->pdf->Cell(15, 6, '', 0, 0, 'R');
        $this->pdf->Cell(15, 6, '', 0, 0, 'R');
        $this->pdf->Cell(20, 6, number_format($cgst, 2), 0, 0, 'R');
        $this->pdf->Cell(15, 6, '', 0, 0, 'R');
        $this->pdf->Cell(20, 6, number_format($sgst, 2), 0, 1, 'R');
    }

    protected function renderTaxWords()
    {
        $tax = $this->computed['total_tax'] ?? 0;
        $words = $this->convertNumberToWords($tax);

        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 6, 'Tax Amount (in word)', 0, 1, 'L');
        $this->pdf->SetFont('helvetica', 'B', 8);
        $this->pdf->Cell(0, 6, 'INR ' . $words . ' Only', 0, 1, 'L');
    }

    protected function renderFooterNote()
    {
        $this->pdf->Ln(10);
        $this->pdf->SetFont('helvetica', 'B', 9);
        $this->pdf->Cell(0, 6, "Company's Bank Details", 0, 1, 'L');
        $this->pdf->SetFont('helvetica', '', 8);
        $this->pdf->Cell(0, 5, "A/C Holder's Name: HI FORCE ENTERPRISES", 0, 1, 'L');
        $this->pdf->Cell(0, 5, 'Bank Name: KVB-1232135000007052', 0, 1, 'L');
        $this->pdf->Cell(0, 5, 'A/C No: 1232135000007052', 0, 1, 'L');
        $this->pdf->Cell(0, 5, "Company's PAN: AAPFH8577A", 0, 1, 'L');

        $this->pdf->Ln(10);
        $this->pdf->SetFont('helvetica', '', 8);
        $this->pdf->Cell(0, 5, 'Declaration', 0, 1, 'L');
        $this->pdf->MultiCell(0, 4, 'We declare that Invoice shows the actual price of the goods described and that all particulars are true and correct', 0, 'L');

        $this->pdf->Ln(10);
        $this->pdf->Cell(0, 5, 'Authorised Signatory', 0, 1, 'R');
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, 'This is a Computer Generated Invoice', 0, 1, 'C');
    }

    /* ------------------------------
       Helpers
    -------------------------------*/

    protected function convertNumberToWords($number)
    {
        $number = round((float)$number, 2);
        $parts = explode('.', number_format($number, 2, '.', ''));
        $intPart = (int)$parts[0];
        $paise = (int)$parts[1];

        $words = $this->numberToWordsIndian($intPart);
        $result = ucfirst(trim($words . ' Rupees'));

        if ($paise > 0) {
            $paiseWords = $this->numberToWordsIndian($paise);
            $result .= ' And ' . $paiseWords . ' Paise';
        } else {
            $result .= ' And Zero Paisa';
        }

        return $result;
    }

    protected function numberToWordsIndian($num)
    {
        $ones = [
            0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
            5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen',
            14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen',
            18 => 'eighteen', 19 => 'nineteen'
        ];
        $tens = [
            2 => 'twenty', 3 => 'thirty', 4 => 'forty', 5 => 'fifty',
            6 => 'sixty', 7 => 'seventy', 8 => 'eighty', 9 => 'ninety'
        ];

        if ($num == 0) return 'zero';

        $parts = [];

        $crore = intval($num / 10000000);
        if ($crore) {
            $parts[] = $this->numberToWordsIndian($crore) . ' crore';
            $num %= 10000000;
        }

        $lakh = intval($num / 100000);
        if ($lakh) {
            $parts[] = $this->numberToWordsIndian($lakh) . ' lakh';
            $num %= 100000;
        }

        $thousand = intval($num / 1000);
        if ($thousand) {
            $parts[] = $this->numberToWordsIndian($thousand) . ' thousand';
            $num %= 1000;
        }

        $hundred = intval($num / 100);
        if ($hundred) {
            $parts[] = $this->numberToWordsIndian($hundred) . ' hundred';
            $num %= 100;
        }

        if ($num > 0) {
            if ($num < 20) {
                $parts[] = $ones[$num];
            } else {
                $ten = intval($num / 10);
                $one = $num % 10;
                $tensWord = $tens[$ten] ?? '';
                $parts[] = $tensWord . ($one ? ' ' . $ones[$one] : '');
            }
        }

        return implode(' ', $parts);
    }
}
