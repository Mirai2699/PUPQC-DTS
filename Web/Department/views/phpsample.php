<?php

	// Include autoloader
	require_once '../../../resources-web/custom/dompdf/autoload.inc.php';

	// Reference the Dompdf namespace
	use Dompdf\Dompdf;

	// Instantiate and use the dompdf class
	$dompdf = new Dompdf();

	// Load HTML content
	$dompdf->loadHtml(file_get_contents('rep_ipcr_printable.php'));

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();


	// Output the generated PDF (1 = download and 0 = preview)
	$dompdf->stream("codexworld",array("Attachment"=>0));

?>