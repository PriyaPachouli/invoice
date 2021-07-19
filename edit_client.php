<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
$ud =mktime();
if(!empty($_POST['client_name']) && $_POST['client_name'] && !empty($_POST['invoiceId']) && $_POST['invoiceId']) {	
	$invoice->updateClient($_POST);	
	header("Location:clientlist.php");	
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	//$invoiceUser = $invoice->getInvoiceUser($_GET['update_id']);
	$invoiceValues = $invoice->getInvoice($_GET['update_id']);
	$invoiceUser = $invoice->getInvoiceUser($invoiceValues['user_address']);	
	$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);
	$invoiceClient = $invoice->getInvoiceDetails($invoiceValues['client_address']);
}
?>
<title>Invoice</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/css/bootstrap-datepicker.min.css" />
<style>
h1 {
  text-align: center;
}
</style>
<script>
  function clickAlert() {
    alert("Invoice Updated Successfully!");
}
</script>
<div class="container content-invoice">
    <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 	
        <div class="load-animate animated fadeInUp">
		<input value="<?php echo $invoiceClient[0]['client_insert'] ?>" type="hidden" id="client_insert" name="client_insert" >
			<input value="<?php echo $ud ?>" type="hidden" id="client_update" name="client_update" >
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color: #d5f4e6;">
					<h3>To,</h3>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_country']; ?>" id="client_country" class="form-control" name="client_country" placeholder="country">
					  </div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_name']; ?>" type="text" class="form-control" name="client_name" id="client_name" placeholder="Client Legal Name" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_email']; ?>" type="text" class="form-control" name="client_email" id="client_email" placeholder="Client Email" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_mobile']; ?>" type="text" class="form-control" name="client_mobile" id="client_mobile" placeholder="Client Mobile" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_gstin']; ?>" type="text" class="form-control" name="client_gstin" id="client_gstin" placeholder="Legal GSTIN" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_pan_no']; ?>" type="text" class="form-control" name="client_pan_no" id="client_pan_no" placeholder="Legal PAN Number" autocomplete="off">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="client_street_address" id="client_street_address" placeholder="Client Street Address"><?php echo $invoiceClient[0]['client_street_address']; ?></textarea>
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_state']; ?>" id="client_state" class="form-control" name="client_state" placeholder="State">
					  </div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_city']; ?>" type="text" class="form-control" name="client_city" id="client_city" placeholder="City" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceClient[0]['client_zip_code']; ?>" type="number" class="form-control" name="client_zip_code" id="client_zip_code" placeholder="Postal Code/Zip Code" autocomplete="off">
					</div>
					<div class="form-group">
							<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
							<input type="hidden" value="<?php echo $invoiceValues['order_id']; ?>" class="form-control" name="invoiceId" id="invoiceId">
			      			<input data-loading-text="Updating Invoice..." type="submit" name="invoice_btn" value="Update Invoice" class="btn btn-success submit_btn invoice-save-btm" onclick="clickAlert()">
			      	</div>
				</div>
			</div>
        </div>
    </form>
</div>
