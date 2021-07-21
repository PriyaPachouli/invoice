<?php
class Invoice{
	private $host  = 'remotemysql.com';
    private $user  = '8cgpXtxGHT';
    private $password   = "APdRYndJOR";
    private $database  = "8cgpXtxGHT";   

//local db
	/*private $host  = '127.0.0.1';
    private $user  = 'root';
    private $password   = "";
    private $database  = "my_invoice";  */

	private $invoiceUserTable = 'invoice_user_details';	
    private $invoiceClientTable = 'invoice_client_details';
	private $invoiceServiceTable = 'invoice_service_details';
	private $invoiceDetailsTable = 'invoice_details';
	private $bankDetailsTable = 'bank_details';
	private $usersTable = 'users';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error($this->dbConnect));
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	public function getInvoiceNo(){
		$sqlQuery="SELECT invoice_no FROM ".$this->invoiceDetailsTable." where user_id = '".$_SESSION['userid']."' order by order_id DESC LIMIT 1";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}
	/*public function getBankUser(){
		$sqlQuery="SELECT user, mobile FROM ".$this->invoiceUserTable." ORDER BY order_id DESC LIMIT 1";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;	
		}*/
	
	public function saveInvoice($POST) {
		//echo "<pre>";
		//print_r($POST);
		//exit;
		$addmore1 = $_POST['addmore1'];
    	$addmore2 = $_POST['addmore2'];
		$submitKey = array();
		for($i=0;$i<count($addmore1);$i++){
			if(!empty($addmore1[$i])){
			$submitKey[] =array($addmore1[$i]=>$addmore2[$i]);
			}
		}
		$submitKey = serialize($submitKey);

		/*echo '<pre>';
		print_r ($submitKey);
		echo '</pre>';
		exit;*/
		
		$sqlInsertInvoice = "
			INSERT INTO ".$this->invoiceDetailsTable."(user_id, invoice_no, invoice_date, due_date, user_address, client_address, order_total_before_tax, order_total_tax,order_tax_per,order_total_after_tax,order_amount_paid,order_total_amount_due,gst, invoice_insert, invoice_update, condition_desc, note_name, note, add_more)
			VALUES ('".$POST['userId']."', '".$POST['invoice_no']."', '".$POST['datepicker1']."', '".$POST['datepicker2']."', '".$POST['user-drop']."', '".$POST['client-drop']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['taxRate']."', '".$POST['totalAftertax']."', '".$POST['amountPaid']."', '".$POST['amountDue']."', '".$POST['flexRadioDefault']."', '".$POST['invoice_insert']."', '".$POST['invoice_update']."', '".$POST['condition_desc']."', '".$POST['note-btn']."', '".$POST['notes']."', '$submitKey')";
			mysqli_query($this->dbConnect, $sqlInsertInvoice);
			//die(mysqli_error($this->dbConnect));

			$InvoceId= mysqli_insert_id($this->dbConnect);

		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productCode']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceServiceTable."(order_id, user_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount, service_description, service_insert, service_update) 
			VALUES ('".$lastInsertId."', '".$POST['userId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."', '".$POST['serviceDes'][$i]."', '".$POST['service_insert']."', '".$POST['service_update']."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}
		//die(mysqli_error($this->dbConnect)); 
		return $InvoceId;   	
	}
	public function updateInvoice($POST) {
		//echo "<pre>";
		//print_r($POST);
		//exit;
		if($POST['invoiceId']) {	
			$sqlInsert = "
				UPDATE ".$this->invoiceClientTable." 
				SET client_country = '".$POST['client_country']."', client_name= '".$POST['client_name']."', client_email= '".$POST['client_email']."', client_mobile= '".$POST['client_mobile']."', client_gstin= '".$POST['client_gstin']."', client_pan_no= '".$POST['client_pan_no']."', client_street_address= '".$POST['client_street_address']."', client_state= '".$POST['client_state']."', client_city= '".$POST['client_city']."', client_zip_code= '".$POST['client_zip_code']."', note = '".$POST['notes']."', client_insert = '".$POST['client_insert']."', client_update = '".$POST['client_update']."' 
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);

			$sqlInsertUser = "
					UPDATE ".$this->invoiceUserTable."
					SET country = '".$POST['country']."', user= '".$POST['user']."', email= '".$POST['email']."', mobile= '".$POST['mobile']."', gstin= '".$POST['gstin']."', pan_no= '".$POST['pan_no']."', street_address= '".$POST['street_address']."', gst_state= '".$POST['gst_state']."', city= '".$POST['city']."', zip_code= '".$POST['zip_code']."', user_insert = '".$POST['user_insert']."', user_update = '".$POST['user_update']."' 
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsertUser);
			
			$sqlInsertInvoice = "
					UPDATE ".$this->invoiceDetailsTable."
					SET invoice_no = '".$POST['invoice_no']."', invoice_date= '".$POST['datepicker1']."', due_date= '".$POST['datepicker2']."', user_address= '".$POST['user-drop']."', client_address= '".$POST['client-drop']."', order_total_before_tax = '".$POST['subTotal']."', order_total_tax = '".$POST['taxAmount']."', order_tax_per = '".$POST['taxRate']."', order_total_after_tax = '".$POST['totalAftertax']."', order_amount_paid = '".$POST['amountPaid']."', order_total_amount_due = '".$POST['amountDue']."', gst = '".$POST['flexRadioDefault']."', invoice_insert = '".$POST['invoice_insert']."', invoice_update = '".$POST['invoice_update']."'
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."' ";		
			mysqli_query($this->dbConnect, $sqlInsertInvoice);
		}
				
		$this->deleteInvoiceItems($POST['invoiceId']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->invoiceServiceTable."(order_id, user_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount, service_description) 
				VALUES ('".$POST['invoiceId']."', '".$POST['userId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."', '".$POST['serviceDes'][$i]."', service_insert = '".$POST['service_insert']."', service_update = '".$POST['service_update']."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}
		  //die(mysqli_error($this->dbConnect));   	
	}
	public function updateUser($POST) {
		if($POST['invoiceId']) {
			$sqlInsertUser = "
					UPDATE ".$this->invoiceUserTable."
					SET country = '".$POST['country']."', user= '".$POST['user']."', email= '".$POST['email']."', mobile= '".$POST['mobile']."', gstin= '".$POST['gstin']."', pan_no= '".$POST['pan_no']."', street_address= '".$POST['street_address']."', gst_state= '".$POST['gst_state']."', city= '".$POST['city']."', zip_code= '".$POST['zip_code']."', user_insert = '".$POST['user_insert']."', user_update = '".$POST['user_update']."' 
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsertUser);
		}
		//die(mysqli_error($this->dbConnect));
	}
	public function updateClient($POST) {
		if($POST['invoiceId']) {
			$sqlInsert = "
				UPDATE ".$this->invoiceClientTable." 
				SET client_country = '".$POST['client_country']."', client_name= '".$POST['client_name']."', client_email= '".$POST['client_email']."', client_mobile= '".$POST['client_mobile']."', client_gstin= '".$POST['client_gstin']."', client_pan_no= '".$POST['client_pan_no']."', client_street_address= '".$POST['client_street_address']."', client_state= '".$POST['client_state']."', client_city= '".$POST['client_city']."', client_zip_code= '".$POST['client_zip_code']."', note = '".$POST['notes']."', client_insert = '".$POST['client_insert']."', client_update = '".$POST['client_update']."' 
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);
		}
	}
	public function getInvoiceList(){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceDetailsTable."
			WHERE user_id = '".$_SESSION['userid']."' ";
		return  $this->getData($sqlQuery);
	}
	public function getClientList(){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceClientTable." 
			WHERE user_id = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}
	public function getUserList(){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceUserTable." 
			WHERE user_id = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}

		public function getInvoice($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceDetailsTable." 
			WHERE order_id = '$invoiceId'" ;
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getInvoiceUser($invoiceId){
		 $sqlQuery = "
			SELECT * FROM ".$this->invoiceUserTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);
	}
	public function getInvoiceItems($invoiceId){
		 $sqlQuery = "
			SELECT * FROM ".$this->invoiceServiceTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}
	public function getInvoiceDetails($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceClientTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}
	public function deleteInvoiceUser($invoiceId){
		$sqlQuery = "
		DELETE FROM ".$this->invoiceUserTable." 
		WHERE order_id = '".$invoiceId."'";
	mysqli_query($this->dbConnect, $sqlQuery);
	}
	public function deleteInvoiceDetails($invoiceId){
		$sqlQuery = "
		DELETE FROM ".$this->invoiceDetailsTable." 
		WHERE order_id = '".$invoiceId."'";
	mysqli_query($this->dbConnect, $sqlQuery);
	}
	public function deleteInvoiceItems($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->invoiceServiceTable."
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);
						
	}
	public function deleteBankDetails($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->bankDetailsTable." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deleteInvoice($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->invoiceClientTable." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deleteInvoiceItems($invoiceId);
		$this->deleteInvoiceUser($invoiceId);
		$this->deleteInvoiceDetails($invoiceId);
		$this->deleteBankDetails($invoiceId);	
		return 1;
	}
	public function saveBankDetails($POST) {	
		$sqlbank = "		
			INSERT INTO ".$this->bankDetailsTable."(user_id, country, bank_name, account_no, cnfrm_account_no, ifsc, account_type, account_holder, phone, upi_id, paytm_id, invoice_id, bank_insert, bank_update) 
			VALUES ('".$POST['userId']."', '".$POST['country']."', '".$POST['bank_name']."', '".$POST['account_no']."', '".$POST['cnfrm_account_no']."', '".$POST['ifsc']."', '".$POST['account_type']."', '".$POST['account_holder']."', '".$POST['phone']."', '".$POST['upi_id']."', '".$POST['paytm_id']."', '".$POST['invoiceId']."', '".$POST['u_insert']."', '".$POST['u_update']."')";
			mysqli_query($this->dbConnect, $sqlbank);
	}
	public function saveClient($POST) {
		$sqlInsertClients = "
			INSERT INTO ".$this->invoiceClientTable."(user_id, client_country, client_name, client_email, client_mobile, client_gstin, client_pan_no, client_street_address, client_state, client_city, client_zip_code, note_name, note, client_insert, client_update) 
			VALUES ('".$POST['userId']."', '".$POST['client_country']."', '".$POST['client_name']."', '".$POST['client_email']."', '".$POST['client_mobile']."', '".$POST['client_gstin']."', '".$POST['client_pan_no']."', '".$POST['client_street_address']."', '".$POST['client_state']."', '".$POST['client_city']."', '".$POST['client_zip_code']."', '".$POST['note_name']."', '".$POST['notes']."', '".$POST['client_insert']."', '".$POST['client_update']."')";		
		mysqli_query($this->dbConnect, $sqlInsertClients);
		return mysqli_insert_id($this->dbConnect);
	}
	public function saveUser($POST) {
		$sqlInsertUsers = "
			INSERT INTO ".$this->invoiceUserTable."(user_id, country, user, email, mobile, gstin, pan_no, street_address, gst_state, city, zip_code, user_insert,) 
			VALUES ('".$POST['userId']."', '".$POST['country']."', '".$POST['user']."', '".$POST['email']."', '".$POST['mobile']."', '".$POST['gstin']."', '".$POST['pan_no']."', '".$POST['street_address']."', '".$POST['gst_state']."', '".$POST['city']."', '".$POST['zip_code']."', '".$POST['user_insert']."', '".$POST['user_update']."')";		
		mysqli_query($this->dbConnect, $sqlInsertUsers);
	   return mysqli_insert_id($this->dbConnect);
	}
	public function getBankDetails($invoiceId){

	 $sqlQuery = "
			SELECT * FROM ".$this->bankDetailsTable." 
			WHERE user_id = '".$_SESSION['userid']."' AND invoice_id = '$invoiceId' ";
		return  $this->getData($sqlQuery);	
	}
	public function getInvoiceUserAll(){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceUserTable."
			WHERE order_id = '".$_SESSION['userid']."' ";
		return  $this->getData($sqlQuery);
	}
	public function saveLoginUsers($POST) {	
		$sqluser = "		
			INSERT INTO ".$this->usersTable."(username, password, users_insert, users_update) 
			VALUES ('".$POST['username']."', '".$POST['password']."', '".$POST['users_insert']."', '".$POST['users_update']."')";
			mysqli_query($this->dbConnect, $sqluser);
	}
	public function loginUsers($username, $password){
		$sqlQuery = "
			SELECT id, username, password, created_at 
			FROM ".$this->usersTable." 
			WHERE username='".$username."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:login.php");
		}
	}

}
