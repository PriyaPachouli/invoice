<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
?>
<title>Invoice</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
	<div class="container">		
	  <h2 class="title">Invoice List</h2>
	  <?php include('menu.php');?>			  
      <table id="data-table" class="table table-condensed table-striped">
        <thead>
          <tr>
            <th>Sr No.</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Country</th>
            <th>Edit</th>
          </tr>
        </thead>
        <?php		
		$invoiceList = $invoice->getClientList();
        foreach($invoiceList as $invoiceDetails){
            echo '
              <tr>
                <td>'.$invoiceDetails["order_id"].'</td>
                <td>'.$invoiceDetails["client_name"].'</td>
                <td>'.$invoiceDetails["client_email"].'</td>
                <td>'.$invoiceDetails["client_city"].'</td>
                <td>'.$invoiceDetails["client_country"].'</td>
                <td><a href="edit_client.php?update_id='.$invoiceDetails["order_id"].'"  title="Edit Invoice"><span class="glyphicon glyphicon-edit"></span></a></td>
                <!--<td><a href="#" id="'.$invoiceDetails["order_id"].'" class="deleteInvoice"  title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>-->
              </tr>
            ';
        }       
        ?>
      </table>
</div>
<?php include('footer.php');?>