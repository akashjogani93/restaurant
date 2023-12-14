<?php
// Include the main TCPDF library
require_once('TCPDF/tcpdf.php');

// Retrieve the HTML table data from the POST request
$table_data = $_POST['table_data'];

// Create a new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set the document metadata
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('HTML Table to PDF');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$date = date('m/d/Y');

// Set header text and date
$pdf->SetHeaderData('', 0, 'New Header Text' . ' | ' . $date, '', '', false);
// Set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// // Set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set header font (family, style, size)
$pdf->setHeaderFont(Array('helvetica', 'B', 12));

// Set footer font (family, style, size)
$pdf->setFooterFont(Array('helvetica', 'B', 12));
// Set default monospaced font

// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetDefaultMonospacedFont('courier');
// Set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetMargins(10, 20, 10);

// Set header margin
$pdf->SetHeaderMargin(5);

// Set footer margin
$pdf->SetFooterMargin(10);

// Set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->SetAutoPageBreak(TRUE, 15);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();
    $additionalStyles = 
    '<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
        thead {
            background-color: grey;
            color: white;
        }
    </style>';
// Print the HTML table data
// $pdf->writeHTML($table_data, true, false, true, false, '');
$pdf->writeHTML($additionalStyles . $table_data, true, false, true, false, '');

// Close and output the PDF document
$pdf->Output('your_file_name.pdf', 'D');
?>