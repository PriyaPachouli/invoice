<ul class="nav navbar-nav">
<li class="dropdown">
	<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Invoice
	<span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a href="invoice_details.php">Invoice List</a></li>
		<li><a href="create_invoice.php">Create Invoice</a></li>				  
	</ul>
</li>
</ul>
<ul class="nav navbar-nav">
<li class="dropdown">
<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" >User
	<span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a href="userlist.php">User List</a></li>
		<li><a href="add_user.php">Add User</a></li>				  
	</ul>
</li>
</ul>
<ul class="nav navbar-nav">
<li class="dropdown">
<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" >Client
	<span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a href="clientlist.php">Client List</a></li>
		<li><a href="add_client.php">Add Client</a></li>			  
	</ul>
</li>
</ul>
<?php 
if($_SESSION['userid']) { ?>
<ul class="nav navbar-nav pull-right">
<a href="logout.php">
<button class="btn btn-info" type="button" value="LogOut">LogOut</button></a>
</li>
<?php } ?>
</ul>
<br /><br /><br /><br />