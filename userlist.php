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
            <th>User Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Country</th>
            <th>Edit</th>
          </tr>
        </thead>
        <?php		
		//$userList = $invoice->getInvoiceUserAll();
    $userList = $invoice->getUserList();
        foreach($userList as $userDetails){
            echo '
              <tr>
                <td>'.$userDetails["order_id"].'</td>
                <td>'.$userDetails["user"].'</td>
                <td>'.$userDetails["email"].'</td>
                <td>'.$userDetails["city"].'</td>
                <td>'.$userDetails["country"].'</td>
                <td><a href="edit_user.php?update_id='.$userDetails["order_id"].'"  title="Edit Invoice"><span class="glyphicon glyphicon-edit"></span></a></td>
                <!--<td><a href="#" id="'.$userDetails["order_id"].'" class="deleteInvoice"  title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>-->
              </tr>
            ';
        }       
        ?>
      </table>
</div>
<?php include('footer.php');?>