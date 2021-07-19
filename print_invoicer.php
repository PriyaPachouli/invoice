<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	$_GET['invoice_id'];
   $invoiceValues = $invoice->getInvoice($_GET['invoice_id']);
   $invoiceItems = $invoice->getInvoiceItems($invoiceValues['order_id']);
   $invoiceUser = $invoice->getInvoiceUser($invoiceValues['user_address']);
   $invoiceClient = $invoice->getInvoiceDetails($invoiceValues['client_address']);
   $invoiceDetail = $invoice->getInvoiceDetails($invoiceValues['order_id']);
   $bankDetails = $invoice->getBankDetails($invoiceValues['order_id']);
}

$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2"> 
	<table width="100%" cellpadding="5" style="color:#ff4500;">
	<tr>
	<td width="30%" style="font-size:15px"><h2>Invoice</h2></td>
	</tr>
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
	<td width="35%">
	Ivonice No. : <b>'.$invoiceValues['invoice_no'].'</b><br />
	Invoice Date : <b>'.$invoiceValues['invoice_date'].'</b><br />
	Due Date : <b>'.$invoiceValues['due_date'].'</b><br />
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5" style="color:#ff4500;">
	<tr style="background-color:#ffa07a">
	<td width="50%">
	<b>BILLED BY</b><br />
	<b>'.$invoiceUser[0]['user'].'</b><br /> 
	'.$invoiceUser[0]['street_address'].'<br />
	'.$invoiceUser[0]['city'].'<br />
	'.$invoiceUser[0]['gst_state'].',
	'.$invoiceUser[0]['country'].'-
	'.$invoiceUser[0]['zip_code'].'<br />
	</td>
	<td width="50%">
	<b>BILL TO</b><br />
	<b>'.$invoiceClient[0]['client_name'].'</b><br />
	'.$invoiceClient[0]['client_street_address'].'<br />
	'.$invoiceClient[0]['client_city'].'<br />
	'.$invoiceClient[0]['client_state'].',
	'.$invoiceClient[0]['client_country'].'-
	'.$invoiceClient[0]['client_zip_code'].'<br />
	<b>Email:</b>'.$invoiceClient[0]['client_email'].'<br />
	</td>
	</tr>
	</table>
	<table width="100%" cellpadding="5"">
	<tr>
	<td width="50%">
	<b>Country of Supply: </b>'.$invoiceClient[0]['client_country'].'<br />
	</td>
	<td width="50%">
	<b>Place of Supply: </b>'.$invoiceClient[0]['client_state'].'<br />
	</td>
	</tr>
	</table>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr style="background-color:#ff4500">
	<th style="color:#ffffff" align="left">Sr No.</th>
	<th style="color:#ffffff" align="left">Item Code</th>
	<th style="color:#ffffff" align="left">Item Name</th>
	<th style="color:#ffffff" align="left">Quantity</th>
	<th style="color:#ffffff" align="left">Price</th>
	<th style="color:#ffffff" align="left">Actual Amt.</th> 
	</tr>';
$count = 0;   
foreach($invoiceItems as $invoiceItem){
	$count++;
	$output .= '
	<tr style="background-color:#ffa07a">
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["item_code"].'</td>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].'</td>
	<td align="left">'.$invoiceItem["order_item_price"].'</td>
	<td align="left">'.$invoiceItem["order_item_final_amount"].'</td>   
	</tr>';
}
$output .= '
	</table>
	<br />
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
	<td width="65%">
	<b>Bank Details</b><br />
	<b>Account Holder Name:</b> '.$bankDetails[0]['account_holder'].'<br />
	<b>Account No. :</b> '.$bankDetails[0]['account_no'].'<br />
	<b>IFSC :</b> '.$bankDetails[0]['ifsc'].'<br />
	<b>Bank Name :</b> '.$bankDetails[0]['bank_name'].'<br />
	<b>Account Type :</b> '.$bankDetails[0]['account_type'].'<br />
	</td>
	<td width="35%">
	<b>Sub Total :</b> <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_before_tax'].'<br />
	<b>'.$invoiceValues['gst'].' :</b> <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_tax_per'].'<br />
	<b>Tax Amount :</b> <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_tax'].'<br />
	<b>Total :</b> <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_after_tax'].'<br />
	<b>Amount Paid :</b> <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_amount_paid'].'<br />
	<b>Amount Due :</b> <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_amount_due'].'<br />
	</td>
	</tr>';
$output .= '
	</table>
	<table width="100%" cellpadding="5" style="color:#ff4500;">
	<tr>
	<td style="font-size:18px"><h3>Terms & Conditions</h></td>
	</tr>
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
	<td >1. Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.</td>
	</tr>
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
	<td>2. Please quote invoice number when remitting funds.</td>
	</tr>
	</td>
	</tr>
	</table>';
// create pdf of invoice	
$invoiceFileName = 'Invoice-'.$invoiceValues['invoice_no'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));

?>