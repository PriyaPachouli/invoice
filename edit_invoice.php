<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
$ud =mktime();
if(!empty($_POST['client_name']) && $_POST['client_name'] && !empty($_POST['invoiceId']) && $_POST['invoiceId']) {	
	$invoice->updateInvoice($_POST);	
	header("Location:index.php");
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	//$invoiceUser = $invoice->getInvoiceUser($_GET['update_id']);
	$invoiceValues = $invoice->getInvoice($_GET['update_id']);
	$invoiceUser = $invoice->getInvoiceUser($invoiceValues['user_address']);	
	$invoiceItems = $invoice->getInvoiceItems($_GET['update_id']);
	$invoiceClient = $invoice->getInvoiceDetails($invoiceValues['client_address']);
	//$invoiceDetail = $invoice->getInvoiceDetails($_GET['update_id']);	
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
			<input value="<?php echo $invoiceValues['invoice_insert'] ?>" type="hidden" id="invoice_insert" name="invoice_insert" >
			<input value="<?php echo $ud ?>" type="hidden" id="invoice_update" name="invoice_update" >
			<input value="<?php echo $invoiceValues['user_insert'] ?>" type="hidden" id="user_insert" name="user_insert" >
			<input value="<?php echo $ud ?>" type="hidden" id="user_update" name="user_update" >
			<input value="<?php echo $invoiceValues['client_insert'] ?>" type="hidden" id="client_insert" name="client_insert" >
			<input value="<?php echo $ud ?>" type="hidden" id="client_update" name="client_update" >
			<input value="<?php echo $invoiceValues['service_insert'] ?>" type="hidden" id="service_insert" name="service_insert" >
			<input value="<?php echo $ud ?>" type="hidden" id="service_update" name="service_update" >
		    	<div class="row">
		    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    			<h1 class="title">Invoice</h1>			
		    		</div>		    		
		    	</div>
				<div class="row">
					<div class="col-xs-4">
					<div class="form-group">
							<label for="invoice_no">Invoice No:</label>
							<input type="text" class="form-control" name="invoice_no" id="invoice_no" value="<?php echo $invoiceValues['invoice_no'] ?>" autocomplete="off">
					</div>
					</div>
					<div class="col-xs-4">
					<div class="form-group">
						<label for="invoice_date">Invoice Date:</label>
						<input value="<?php echo $invoiceValues['invoice_date'] ?>" type='text' class="form-control" id="datepicker1" name="datepicker1" />
					</div>
					</div>
					<div class="col-xs-4">
					<div class="form-group">
						<label for="due_date">Due Date:</label>
						<input value="<?php echo $invoiceValues['due_date'] ?>" type='text' class="form-control" id="datepicker2" name="datepicker2" />
					</div>
					</div>
					<script type="text/javascript">
					$(document).ready(function() {
						var date = new Date();
						var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
						$('#datepicker1').datepicker({
					format: "mm/dd/yyyy",
					todayHighlight: true,
					startDate: today,
					autoclose: true
						});
					
						$('#datepicker1').datepicker();
					});
				</script>
				<script type="text/javascript">
					$("#datepicker2").datepicker( {
					autoclose: true,
					});
					$('#datepicker2').datepicker();
				</script>
				</div>
		      	<input id="currency" type="hidden" value="$">
				<input value="<?php echo $invoiceValues['user_address'] ?>" type="hidden" id="user-drop" name="user-drop" >
				<input value="<?php echo $invoiceValues['client_address'] ?>" type="hidden" id="client-drop" name="client-drop" >
				<input value="<?php echo $invoiceValues['gst'] ?>" type="hidden" id="flexRadioDefault1" name="flexRadioDefault" >
				<input value="<?php echo $invoiceValues['gst'] ?>" type="hidden" id="flexRadioDefault2" name="flexRadioDefault" >
		    	<div class="row">
		      		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="background-color: #d5f4e6;">
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
				</div>      		
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right" style="background-color: #d5f4e6;">
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
						<input value="<?php echo $invoiceClient[0]['client_zip_code']; ?>" type="text" class="form-control" name="client_zip_code" id="client_zip_code" placeholder="Postal Code/Zip Code" autocomplete="off">
					</div>
				</div>
			</div>
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			<table class="table table-bordered table-hover" id="invoiceItem">	
							<tr style="background-color: #80ced6;">
								<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
								<th width="10%">Item No</th>
								<th width="20%">Item Name</th>
								<th width="10%">Quantity</th>
								<th width="10%">Price</th>								
								<th width="10%">Total</th>
								<th width="38%">Service Description</th>
							</tr>
							<?php 
							$count = 0;
							foreach($invoiceItems as $invoiceItem){
								$count++;
							?>								
							<tr style="background-color: #d5f4e6;">
								<td><input class="itemRow" type="checkbox"></td>
								<td><input type="text" value="<?php echo $invoiceItem["item_code"]; ?>" name="productCode[]" id="productCode_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
								<td><input type="text" value="<?php echo $invoiceItem["item_name"]; ?>" name="productName[]" id="productName_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>			
								<td><input type="number" value="<?php echo $invoiceItem["order_item_quantity"]; ?>" name="quantity[]" id="quantity_<?php echo $count; ?>" class="form-control quantity" autocomplete="off"></td>
								<td><input type="number" value="<?php echo $invoiceItem["order_item_price"]; ?>" name="price[]" id="price_<?php echo $count; ?>" class="form-control price" autocomplete="off"></td>
								<td><input type="number" value="<?php echo $invoiceItem["order_item_final_amount"]; ?>" name="total[]" id="total_<?php echo $count; ?>" class="form-control total" autocomplete="off"></td>
								<td><input type="text" value="<?php echo $invoiceItem["service_description"]; ?>" name="serviceDes[]" id="serviceDes_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
								<input type="hidden" value="<?php echo $invoiceItem['order_item_id']; ?>" class="form-control" name="itemId[]">
							</tr>	
							<?php } ?>		
						</table>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		      			<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
		      			<button class="btn btn-success" id="addRows" type="button">+ Add More</button>
		      		</div>
		      	</div>
		      	<div class="row">	
		      		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		      			<h3>Notes: </h3>
		      			<div class="form-group">
							<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"><?php echo $invoiceClient[0]['note']; ?></textarea>
						</div>
						<br>
						<div class="form-group">
							<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
							<input type="hidden" value="<?php echo $invoiceValues['order_id']; ?>" class="form-control" name="invoiceId" id="invoiceId">
			      			<input data-loading-text="Updating Invoice..." type="submit" name="invoice_btn" value="Update Invoice" class="btn btn-success submit_btn invoice-save-btm" onclick="clickAlert()">
			      		</div>
						
		      		</div>
		      		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<span class="form-inline">
							<div class="form-group">
								<label>Subtotal: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency"><span>&#8377;</span></div>
									<input value="<?php echo $invoiceValues['order_total_before_tax']; ?>" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
								</div>
							</div>
							<div class="form-group">
								<label><?php echo $invoiceValues['gst']; ?></label>
								<div class="input-group">
									<input value="<?php echo $invoiceValues['order_tax_per']; ?>" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
									<div class="input-group-addon">%</div>
								</div>
							</div>
							<div class="form-group">
								<label>Tax Amount: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency"><span>&#8377;</span></div>
									<input value="<?php echo $invoiceValues['order_total_tax']; ?>" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
								</div>
							</div>							
							<div class="form-group">
								<label>Total: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency"><span>&#8377;</span></div>
									<input value="<?php echo $invoiceValues['order_total_after_tax']; ?>" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Paid: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency"><span>&#8377;</span></div>
									<input value="<?php echo $invoiceValues['order_amount_paid']; ?>" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Due: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency"><span>&#8377;</span></div>
									<input value="<?php echo $invoiceValues['order_total_amount_due']; ?>" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
								</div>
							</div>
						</span>
					</div>
		      	</div>
		      	<div class="clearfix"></div>		      	
	      	</div>
		</form>			
    </div>
</div>	
<?php include('footer.php');?>