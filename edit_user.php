<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
$ud =mktime();
if(!empty($_POST['user']) && $_POST['user'] && !empty($_POST['invoiceId']) && $_POST['invoiceId']) {	
	$invoice->updateUser($_POST);	
	header("Location:userlist.php");	
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	$invoiceUser = $invoice->getInvoiceUser($_GET['update_id']);
	$invoiceValues = $invoice->getInvoice($_GET['update_id']);
	//print_r($invoiceValues);
	//exit;
	$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);
	$invoiceDetail = $invoice->getInvoiceDetails($_GET['update_id']);		
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
		<input value="<?php echo $invoiceUser[0]['user_insert'] ?>" type="hidden" id="user_insert" name="user_insert" >
			<input value="<?php echo $ud ?>" type="hidden" id="user_update" name="user_update" >
            <div class="row">
		      	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color: #d5f4e6;">
					  <h3>From,</h3>
					  <div class="form-group">
						<input value="<?php echo $invoiceUser[0]['country']; ?>" id="country" class="form-control" name="country" placeholder="country">
					  </div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['user']; ?>" type="text" class="form-control" name="user" id="user" placeholder="Your Name" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['email']; ?>" type="text" class="form-control" name="email" id="email" placeholder="Your Email" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['mobile']; ?>" type="text" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['gstin']; ?>" type="text" class="form-control" name="gstin" id="gstin" placeholder="Legal GSTIN" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['pan_no']; ?>" type="text" class="form-control" name="pan_no" id="pan_no" placeholder="Legal PAN Number" autocomplete="off">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="street_address" id="street_address" placeholder="Street Address"><?php echo $invoiceUser[0]['street_address']; ?></textarea>
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['gst_state']; ?>" id="gst_state" class="form-control" name="gst_state" placeholder="State">
					  </div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['city']; ?>" type="text" class="form-control" name="city" id="city" placeholder="City" autocomplete="off">
					</div>
					<div class="form-group">
						<input value="<?php echo $invoiceUser[0]['zip_code']; ?>" type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Postal Code/Zip Code" autocomplete="off">
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