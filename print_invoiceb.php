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
	//print_r($invoiceUser);
	//exit;
	$invoiceClient = $invoice->getInvoiceDetails($invoiceValues['client_address']);
	$invoiceDetail = $invoice->getInvoiceDetails($invoiceValues['order_id']);
	$bankDetails = $invoice->getBankDetails($invoiceValues['order_id']);
}
$addon= $invoiceValues['add_more'];
$newadd = '';
if(!empty($addon)){
	$addon =unserialize($addon);
	foreach($addon as $listy){
		//print_r($list);
		foreach($listy as $key=>$list){
$newadd .=  $key.' : <b>'.$list.'</b><br />';
		}
	}
}

$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2"> 
	<table width="100%" cellpadding="5" style="color:#000080;">
	<tr>
	<td width="30%" style="font-size:15px"><h2>Invoice</h2></td>
	</tr>
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
	<td width="35%">
	Ivonice No. : <b>'.$invoiceValues['invoice_no'].'</b><br />
	Invoice Date : <b>'.$invoiceValues['invoice_date'].'</b><br />
	Due Date : <b>'.$invoiceValues['due_date'].'</b><br />'.$newadd.'
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5" style="color:#000080;">
	<tr style="background-color:#e6e6fa">
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
	<tr style="background-color:#000080">
	<th style="color:#ffffff" align="left">Sr No.</th>
	<th style="color:#ffffff" align="left">Item Name</th>
	<th style="color:#ffffff" align="left">Quantity</th>
	<th style="color:#ffffff" align="left">Price</th>
	<th style="color:#ffffff" align="left">Actual Amt</th>
	<th style="color:#ffffff" align="left">Service Desc</th>
	</tr>';
$count = 0;   
foreach($invoiceItems as $invoiceItem){
	$count++;
	$output .= '
	<tr style="background-color:#e6e6fa">
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].'</td>
	<td align="left">'.$invoiceItem["order_item_price"].'</td>
	<td align="left">'.$invoiceItem["order_item_final_amount"].'</td>
	<td align="left">'.$invoiceItem["service_description"].'</td>   
	</tr>';
}
$output .= '
	</table>
	<br />
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
		<td>
			<table>
				<tr>
					<td><b>Bank Details</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Account Holder Name:</td>
					<td>'.$bankDetails[0]['account_holder'].'</td>
				</tr>
				<tr>
					<td><b>Account No :</b></td>
					<td>'.$bankDetails[0]['account_no'].'</td>
				</tr>
				<tr>
					<td><b>IFSC :</b></td>
					<td>'.$bankDetails[0]['ifsc'].'</td>
				</tr>
				<tr>
					<td><b>Bank Name :</b></td>
					<td>'.$bankDetails[0]['bank_name'].'</td>
				</tr>
				<tr>
					<td><b>Account Type :</b></td>
					<td>'.$bankDetails[0]['account_type'].'</td>
				</tr>
			</table>
		</td>
	
		<td>
			<table>
				<tr>
					<td><b>Sub Total :</td>
					<td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_before_tax'].'</td>
				</tr>
				<tr>
					<td><b>'.$invoiceValues['gst'].' :</td>
					<td>'.$invoiceValues['order_tax_per'].'<span>%</span></td>
				</tr>
				<tr>
					<td><b>Tax Amount :</b></td>
					<td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_tax'].'</td>
				</tr>
				<tr>
					<td><b>Total :</b></td>
					<td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_after_tax'].'</td>
				</tr>
				<tr>
					<td><b>Amount Paid :</b></td>
					<td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_amount_paid'].'</td>
				</tr>
				<tr>
					<td><b>Amount Due :</b></td>
					<td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> '.$invoiceValues['order_total_amount_due'].'</td>
				</tr>
			</table>
		</td>
	</tr>';
$output .= '
	</table>
	<table width="100%" cellpadding="5" style="color:#000080;">
	<tr>
	<td style="font-size:15px"><h3>Notes</h></td>
	</tr>
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
	<td>
	'.$invoiceValues['note'].' <br />
	</td>
	</tr>
	<table width="100%" cellpadding="5" style="color:#000080;">
	<tr>
	<td style="font-size:18px"><h3>Terms & Conditions</h></td>
	</tr>
	<table width="100%" cellpadding="5" style="color:#000000;">
	<tr>
	<td>
	'.$invoiceValues['condition_desc'].' <br />
	</td>
	</tr>
	</table>';
// create pdf of invoice
//echo $output;
//die();
$invoiceFileName = 'Invoice-'.$invoiceValues['invoice_no'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>