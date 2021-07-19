<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	$invoiceD = $invoice->getInvoice($_GET['invoice_id']);
//print_r($invoice);
  //exit;
}
?>
<style>
h2 {
  text-align: center;
}
</style>
<title>Invoice Print</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
	<div class="container">	
	  <h2 class="title">Choose Invoice Options</h2>			  
      <table id="data-table" class="table table-condensed table-striped">
        <thead>
          <tr>
            
          </tr>
        </thead>
        <?php
            echo '
              <tr>
                <td><a href="print_invoiceb.php?invoice_id='.$invoiceD["order_id"].'" title="Print Invoice" target="_blank"><img src="images/pdfblue.jpeg"></a></td>
                <td><a href="print_invoicer.php?invoice_id='.$invoiceD["order_id"].'" title="Print Invoice" target="_blank"><img src="images/pdfred.jpeg"></a></td>
                <td><a href="print_invoiceg.php?invoice_id='.$invoiceD["order_id"].'" title="Print Invoice" target="_blank"><img src="images/pdfgreen.jpeg"></a></td>
              </tr>
            ';
        ?>
      </table>
</div>
<?php include('footer.php');?>