<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$sd =mktime();

if (!empty($_POST['username']) && !empty($_POST['password'])) {
	$selectuser = $invoice->loginUsers($_POST['username'], $_POST['password']);
	if(!empty($selectuser)) {
		$_SESSION['userid'] = $selectuser[0]['id'];
		$_SESSION['username'] = $selectuser[0]['username'];
		$_SESSION['password'] = $selectuser[0]['password'];
		header("Location:invoice_details.php");
	}

elseif(!empty($_POST['username']) && $_POST['username']) {	
	$invoice->saveLoginUsers($_POST);
    //print_r($_POST['username']);
    //exit;
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $_POST['username'];
    $_SESSION["password"] = $_POST['password'];
    echo('User created Successfully! Please Login Again!');
}
}

?>
<title>Invoice</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<style>
h2{
    text-align: center;
}
</style>
<div class="container">
    <div class="wrapper">	
	  <h2 class="title">Invoice Login</h2>
      <form action="" id="invoice-form" method="post" class="invoice-form" role="form">
      <input value="<?php echo $sd ?>" type="hidden" id="users_insert" name="users_insert" >
			<input value="<?php echo $sd ?>" type="hidden" id="users_update" name="users_update" >
        <div class="row">
            <div class="col-xs-4">
      <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
      </div>
      <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
      </div>
      <div class="form-group">
			<input data-loading-text="Saving User..." type="submit" name="login" id="login" value="Login" class="btn btn-success submit_btn invoice-save-btm">
	    </div>
            </div>
        </div>
      </form>
    </div>
</div>
<?php include('footer.php');?>