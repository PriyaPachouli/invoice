<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
$sd =mktime();
$invoiceList = $invoice->getInvoiceNo();
//print_r($invoiceList);
//exit;
$invoice_no = $invoiceList['invoice_no'];
$invoice_no++;
$invoice_number = sprintf('%05d', $invoice_no);
$item_no = 0;
$item_no++;
$productCode = sprintf('%d',$item_no);
if(!empty($_POST['productName']) && $_POST['productName']) {
	print_r($_POST);
	if($_POST['user']!='' &&  $_POST['email']!=''){
       echo"<br />";
	echo $userId =  $invoice->saveUser($_POST);

		echo"<br />";

		$_POST['user-drop'] = $userId;
		
	}
	if($_POST['client_name']!='' &&  $_POST['client_email']!=''){
		echo"<br />";
	 echo $clientId =  $invoice->saveClient($_POST);
 
		 echo"<br />";
 
		 $_POST['client-drop'] = $clientId;
		 
	 }

	$invoiceid = $invoice->saveInvoice($_POST);
	header("Location:bankdetails.php?inv=".$invoiceid);
}
$invoiceUser = $invoice->getUserList();
$invoiceClient = $invoice->getClientList();
//print_r($invoiceUser);
//exit;
?>
<html>
<title>Invoice</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
h2 {
  text-align: center;
}
.close-icon {
            position: absolute;
            bottom: 0;
            border-radius: 5px;
            right: 18px;
            z-index: 2;
            border: none;
            bottom: 16px;
            height: 30px;
            cursor: pointer;
            color: white;
            background-color: #1e90ff;
            transform: translateX(2px);
        }
.terms {
  outline: 0;
  border-width: 0 0 2px;
  border-color: gray
}
</style>
<body>
<div class="container content-invoice" id="dataInvoice" data-user="" data-client="">
	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" onsubmit="return checkReqFields()"> 
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h2 class="title">Invoice</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4">
				<div class="form-group">
						<label for="invoice_no">Invoice No:</label>
						<input type="text" class="form-control" name="invoice_no" id="invoice_no" value="<?php echo $invoice_number ?>" autocomplete="off">
				</div>
				</div>
				<div class="col-xs-4">
				<div class="form-group">
					<label for="invoice_date">Invoice Date:</label>
               		<input type='text' class="form-control" id="datepicker1" name="datepicker1" />
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
					
						$('#datepicker1').datepicker('setDate', today);
					});
				</script>
				<div class="col-xs-4">
				<div class="form-group">
					<label for="due_date">Due Date:</label>
					<input type='text' class="form-control" id="datepicker2" name="datepicker2" />
				</div>
				</div>
				<script type="text/javascript">
					$("#datepicker2").datepicker( {
					autoclose: true,
					});
					var date = new Date();
					var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
					var orderDate = new Date(date);
					orderDate.setDate(orderDate.getDate()+15)
					$('#datepicker2').datepicker('update', new Date(Date.parse(orderDate)));
				</script>
			</div>
			<div class="row">
				<div class="col-xs-4">
				<div class="form-group">
				<div class="input-group control-group after-add-more">
				<div class="input-group-btn"> 
            		<button class="btn btn-success add-more" type="button"><span class="fa fa-plus-circle"></span></button>
          		</div>
				</div>
				</div>
				</div>
				<div class="copy hide">
					<div class="row">
          			<div class="control-group input-group" style="margin-top:10px">
					<div class="col-xs-4">
            			<input type="text" name="addmore1[]" class="form-control" placeholder="Field Name">
					</div>
					<div class="col-xs-4">
						<input type="text" name="addmore2[]" class="form-control" placeholder="Value">
					</div>
					<div class="col-xs-4">
            		<div class="input-group-btn"> 
              			<button class="btn btn-danger remove" type="button"><span class="fa fa-minus-circle"></span></button>
            		</div>
					</div>
					  </div>
					</div>
        		</div>
				<script type="text/javascript">

					$(document).ready(function() {

					$(".add-more").click(function(){ 
						var html = $(".copy").html();
						$(".after-add-more").after(html);
					});

					$("body").on("click",".remove",function(){ 
						$(this).parents(".control-group").remove();
					});

					});
				</script>
				<script>
				function changeFunction(){
    		const el = document.getElementById('chkbx');
       		el.value = 'checked';
		}
				</script>
		</div>
			<input value="<?php echo $sd ?>" type="hidden" id="invoice_insert" name="invoice_insert" >
			<input value="<?php echo $sd ?>" type="hidden" id="invoice_update" name="invoice_update" >
			<input value="<?php echo $sd ?>" type="hidden" id="user_insert" name="user_insert" >
			<input value="<?php echo $sd ?>" type="hidden" id="user_update" name="user_update" >
			<input value="<?php echo $sd ?>" type="hidden" id="client_insert" name="client_insert" >
			<input value="<?php echo $sd ?>" type="hidden" id="client_update" name="client_update" >
			<input value="<?php echo $sd ?>" type="hidden" id="service_insert" name="service_insert" >
			<input value="<?php echo $sd ?>" type="hidden" id="service_update" name="service_update" >
			<div class="row">
				<div class="col-xs-4" style="background-color:#d5f4e6;">
						<h3>Billed By (Your Details)</h3>
						<div class="form-group">
							<select class="form-control" name="user-drop" id="user-drop" autocomplete="off" onchange="userInV(this.value)">
								<?php
								foreach($invoiceUser as $invoiceUsers) { 
									 $gst = 0;
									 if(!empty($invoiceUsers['gstin'])){
										$gst = 1;
									 }
									?>
									<option value="<?= $invoiceUsers['order_id'] ?>" data-id="<?php echo $gst; ?>" data-city="<?php echo $invoiceUsers['gst_state']; ?>"><?= $invoiceUsers['user'] ?></option>
								<?php
								} ?>			
							</select>
						</div>
					<div class="form-group">
							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Business</button>
						<!-- Modal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Legal Details</h4>
									</div>
									<div class="modal-body">
										<select id="country" class="form-control" name="country">
													<option>Select Country</option>
													<option value="Afghanistan">Afghanistan</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
													<option value="American Samoa">American Samoa</option>
													<option value="Andorra">Andorra</option>
													<option value="Angola">Angola</option>
													<option value="Anguilla">Anguilla</option>
													<option value="Antartica">Antarctica</option>
													<option value="Antigua and Barbuda">Antigua and Barbuda</option>
													<option value="Argentina">Argentina</option>
													<option value="Armenia">Armenia</option>
													<option value="Aruba">Aruba</option>
													<option value="Australia">Australia</option>
													<option value="Austria">Austria</option>
													<option value="Azerbaijan">Azerbaijan</option>
													<option value="Bahamas">Bahamas</option>
													<option value="Bahrain">Bahrain</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Barbados">Barbados</option>
													<option value="Belarus">Belarus</option>
													<option value="Belgium">Belgium</option>
													<option value="Belize">Belize</option>
													<option value="Benin">Benin</option>
													<option value="Bermuda">Bermuda</option>
													<option value="Bhutan">Bhutan</option>
													<option value="Bolivia">Bolivia</option>
													<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
													<option value="Botswana">Botswana</option>
													<option value="Bouvet Island">Bouvet Island</option>
													<option value="Brazil">Brazil</option>
													<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
													<option value="Brunei Darussalam">Brunei Darussalam</option>
													<option value="Bulgaria">Bulgaria</option>
													<option value="Burkina Faso">Burkina Faso</option>
													<option value="Burundi">Burundi</option>
													<option value="Cambodia">Cambodia</option>
													<option value="Cameroon">Cameroon</option>
													<option value="Canada">Canada</option>
													<option value="Cape Verde">Cape Verde</option>
													<option value="Cayman Islands">Cayman Islands</option>
													<option value="Central African Republic">Central African Republic</option>
													<option value="Chad">Chad</option>
													<option value="Chile">Chile</option>
													<option value="China">China</option>
													<option value="Christmas Island">Christmas Island</option>
													<option value="Cocos Islands">Cocos (Keeling) Islands</option>
													<option value="Colombia">Colombia</option>
													<option value="Comoros">Comoros</option>
													<option value="Congo">Congo</option>
													<option value="Congo">Congo, the Democratic Republic of the</option>
													<option value="Cook Islands">Cook Islands</option>
													<option value="Costa Rica">Costa Rica</option>
													<option value="Cota D'Ivoire">Cote d'Ivoire</option>
													<option value="Croatia">Croatia (Hrvatska)</option>
													<option value="Cuba">Cuba</option>
													<option value="Cyprus">Cyprus</option>
													<option value="Czech Republic">Czech Republic</option>
													<option value="Denmark">Denmark</option>
													<option value="Djibouti">Djibouti</option>
													<option value="Dominica">Dominica</option>
													<option value="Dominican Republic">Dominican Republic</option>
													<option value="East Timor">East Timor</option>
													<option value="Ecuador">Ecuador</option>
													<option value="Egypt">Egypt</option>
													<option value="El Salvador">El Salvador</option>
													<option value="Equatorial Guinea">Equatorial Guinea</option>
													<option value="Eritrea">Eritrea</option>
													<option value="Estonia">Estonia</option>
													<option value="Ethiopia">Ethiopia</option>
													<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
													<option value="Faroe Islands">Faroe Islands</option>
													<option value="Fiji">Fiji</option>
													<option value="Finland">Finland</option>
													<option value="France">France</option>
													<option value="France Metropolitan">France, Metropolitan</option>
													<option value="French Guiana">French Guiana</option>
													<option value="French Polynesia">French Polynesia</option>
													<option value="French Southern Territories">French Southern Territories</option>
													<option value="Gabon">Gabon</option>
													<option value="Gambia">Gambia</option>
													<option value="Georgia">Georgia</option>
													<option value="Germany">Germany</option>
													<option value="Ghana">Ghana</option>
													<option value="Gibraltar">Gibraltar</option>
													<option value="Greece">Greece</option>
													<option value="Greenland">Greenland</option>
													<option value="Grenada">Grenada</option>
													<option value="Guadeloupe">Guadeloupe</option>
													<option value="Guam">Guam</option>
													<option value="Guatemala">Guatemala</option>
													<option value="Guinea">Guinea</option>
													<option value="Guinea-Bissau">Guinea-Bissau</option>
													<option value="Guyana">Guyana</option>
													<option value="Haiti">Haiti</option>
													<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
													<option value="Holy See">Holy See (Vatican City State)</option>
													<option value="Honduras">Honduras</option>
													<option value="Hong Kong">Hong Kong</option>
													<option value="Hungary">Hungary</option>
													<option value="Iceland">Iceland</option>
													<option value="India" selected>India</option>
													<option value="Indonesia">Indonesia</option>
													<option value="Iran">Iran (Islamic Republic of)</option>
													<option value="Iraq">Iraq</option>
													<option value="Ireland">Ireland</option>
													<option value="Israel">Israel</option>
													<option value="Italy">Italy</option>
													<option value="Jamaica">Jamaica</option>
													<option value="Japan">Japan</option>
													<option value="Jordan">Jordan</option>
													<option value="Kazakhstan">Kazakhstan</option>
													<option value="Kenya">Kenya</option>
													<option value="Kiribati">Kiribati</option>
													<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
													<option value="Korea">Korea, Republic of</option>
													<option value="Kuwait">Kuwait</option>
													<option value="Kyrgyzstan">Kyrgyzstan</option>
													<option value="Lao">Lao People's Democratic Republic</option>
													<option value="Latvia">Latvia</option>
													<option value="Lebanon">Lebanon</option>
													<option value="Lesotho">Lesotho</option>
													<option value="Liberia">Liberia</option>
													<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
													<option value="Liechtenstein">Liechtenstein</option>
													<option value="Lithuania">Lithuania</option>
													<option value="Luxembourg">Luxembourg</option>
													<option value="Macau">Macau</option>
													<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
													<option value="Madagascar">Madagascar</option>
													<option value="Malawi">Malawi</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Maldives">Maldives</option>
													<option value="Mali">Mali</option>
													<option value="Malta">Malta</option>
													<option value="Marshall Islands">Marshall Islands</option>
													<option value="Martinique">Martinique</option>
													<option value="Mauritania">Mauritania</option>
													<option value="Mauritius">Mauritius</option>
													<option value="Mayotte">Mayotte</option>
													<option value="Mexico">Mexico</option>
													<option value="Micronesia">Micronesia, Federated States of</option>
													<option value="Moldova">Moldova, Republic of</option>
													<option value="Monaco">Monaco</option>
													<option value="Mongolia">Mongolia</option>
													<option value="Montserrat">Montserrat</option>
													<option value="Morocco">Morocco</option>
													<option value="Mozambique">Mozambique</option>
													<option value="Myanmar">Myanmar</option>
													<option value="Namibia">Namibia</option>
													<option value="Nauru">Nauru</option>
													<option value="Nepal">Nepal</option>
													<option value="Netherlands">Netherlands</option>
													<option value="Netherlands Antilles">Netherlands Antilles</option>
													<option value="New Caledonia">New Caledonia</option>
													<option value="New Zealand">New Zealand</option>
													<option value="Nicaragua">Nicaragua</option>
													<option value="Niger">Niger</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Niue">Niue</option>
													<option value="Norfolk Island">Norfolk Island</option>
													<option value="Northern Mariana Islands">Northern Mariana Islands</option>
													<option value="Norway">Norway</option>
													<option value="Oman">Oman</option>
													<option value="Pakistan">Pakistan</option>
													<option value="Palau">Palau</option>
													<option value="Panama">Panama</option>
													<option value="Papua New Guinea">Papua New Guinea</option>
													<option value="Paraguay">Paraguay</option>
													<option value="Peru">Peru</option>
													<option value="Philippines">Philippines</option>
													<option value="Pitcairn">Pitcairn</option>
													<option value="Poland">Poland</option>
													<option value="Portugal">Portugal</option>
													<option value="Puerto Rico">Puerto Rico</option>
													<option value="Qatar">Qatar</option>
													<option value="Reunion">Reunion</option>
													<option value="Romania">Romania</option>
													<option value="Russia">Russian Federation</option>
													<option value="Rwanda">Rwanda</option>
													<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
													<option value="Saint LUCIA">Saint LUCIA</option>
													<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
													<option value="Samoa">Samoa</option>
													<option value="San Marino">San Marino</option>
													<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
													<option value="Saudi Arabia">Saudi Arabia</option>
													<option value="Senegal">Senegal</option>
													<option value="Seychelles">Seychelles</option>
													<option value="Sierra">Sierra Leone</option>
													<option value="Singapore">Singapore</option>
													<option value="Slovakia">Slovakia (Slovak Republic)</option>
													<option value="Slovenia">Slovenia</option>
													<option value="Solomon Islands">Solomon Islands</option>
													<option value="Somalia">Somalia</option>
													<option value="South Africa">South Africa</option>
													<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
													<option value="Span">Spain</option>
													<option value="SriLanka">Sri Lanka</option>
													<option value="St. Helena">St. Helena</option>
													<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
													<option value="Sudan">Sudan</option>
													<option value="Suriname">Suriname</option>
													<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
													<option value="Swaziland">Swaziland</option>
													<option value="Sweden">Sweden</option>
													<option value="Switzerland">Switzerland</option>
													<option value="Syria">Syrian Arab Republic</option>
													<option value="Taiwan">Taiwan, Province of China</option>
													<option value="Tajikistan">Tajikistan</option>
													<option value="Tanzania">Tanzania, United Republic of</option>
													<option value="Thailand">Thailand</option>
													<option value="Togo">Togo</option>
													<option value="Tokelau">Tokelau</option>
													<option value="Tonga">Tonga</option>
													<option value="Trinidad and Tobago">Trinidad and Tobago</option>
													<option value="Tunisia">Tunisia</option>
													<option value="Turkey">Turkey</option>
													<option value="Turkmenistan">Turkmenistan</option>
													<option value="Turks and Caicos">Turks and Caicos Islands</option>
													<option value="Tuvalu">Tuvalu</option>
													<option value="Uganda">Uganda</option>
													<option value="Ukraine">Ukraine</option>
													<option value="United Arab Emirates">United Arab Emirates</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="United States">United States</option>
													<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
													<option value="Uruguay">Uruguay</option>
													<option value="Uzbekistan">Uzbekistan</option>
													<option value="Vanuatu">Vanuatu</option>
													<option value="Venezuela">Venezuela</option>
													<option value="Vietnam">Viet Nam</option>
													<option value="Virgin Islands (British)">Virgin Islands (British)</option>
													<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
													<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
													<option value="Western Sahara">Western Sahara</option>
													<option value="Yemen">Yemen</option>
													<option value="Serbia">Serbia</option>
													<option value="Zambia">Zambia</option>
													<option value="Zimbabwe">Zimbabwe</option>
												</select></br>
											<input type="text" class="form-control" name="user" id="user" placeholder="Legal Name" autocomplete="off" ></br>
											<input type="text" class="form-control" name="email" id="email" placeholder="Your Email" autocomplete="off" ></br>
											<input type="number" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile" autocomplete="off" ></br>
											<input type="text" class="form-control" name="gstin" id="gstin" placeholder="Legal GSTIN (Optional)" autocomplete="off" ></br>
											<input type="text" class="form-control" name="pan_no" id="pan_no" placeholder="Legal PAN Number(Optional)" autocomplete="off" ></br>
											<textarea class="form-control" name="street_address" id="street_address" placeholder="Street Address"></textarea></br>
											<select name="gst_state" id="gst_state" class="form-control" >
													<option>Select State</option>
													<option value="Andhra Pradesh">Andhra Pradesh</option>
													<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
													<option value="Arunachal Pradesh">Arunachal Pradesh</option>
													<option value="Assam">Assam</option>
													<option value="Bihar">Bihar</option>
													<option value="Chandigarh">Chandigarh</option>
													<option value="Chhattisgarh">Chhattisgarh</option>
													<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
													<option value="Daman and Diu">Daman and Diu</option>
													<option value="Delhi">Delhi</option>
													<option value="Lakshadweep">Lakshadweep</option>
													<option value="Puducherry">Puducherry</option>
													<option value="Goa">Goa</option>
													<option value="Gujarat">Gujarat</option>
													<option value="Haryana">Haryana</option>
													<option value="Himachal Pradesh">Himachal Pradesh</option>
													<option value="Jammu and Kashmir">Jammu and Kashmir</option>
													<option value="Jharkhand">Jharkhand</option>
													<option value="Karnataka">Karnataka</option>
													<option value="Kerala">Kerala</option>
													<option value="Madhya Pradesh">Madhya Pradesh</option>
													<option value="Maharashtra">Maharashtra</option>
													<option value="Manipur">Manipur</option>
													<option value="Meghalaya">Meghalaya</option>
													<option value="Mizoram">Mizoram</option>
													<option value="Nagaland">Nagaland</option>
													<option value="Odisha">Odisha</option>
													<option value="Punjab">Punjab</option>
													<option value="Rajasthan">Rajasthan</option>
													<option value="Sikkim">Sikkim</option>
													<option value="Tamil Nadu">Tamil Nadu</option>
													<option value="Telangana">Telangana</option>
													<option value="Tripura">Tripura</option>
													<option value="Uttar Pradesh">Uttar Pradesh</option>
													<option value="Uttarakhand">Uttarakhand</option>
													<option value="West Bengal">West Bengal</option>
													</select></br>
												<input type="text" class="form-control" name="city" id="city" placeholder="City" autocomplete="off"></br>
												<input type="number" class="form-control" name="zip_code" id="zip_code" placeholder="Postal Code/Zip Code" autocomplete="off" ><br>
												<div class="input-group control-group after-add-more-user">
														<div class="input-group-btn"> 
															<button class="btn btn-success add-more-user" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
														</div>
													</div>
												<div class="copy hide">
													<div class="control-group input-group" style="margin-top:10px">
														<input type="text" name="addmore-user" class="form-control" placeholder="Enter Your Label">
													<div class="input-group-btn"> 
														<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
													</div>
													</div>
												</div>
												<script type="text/javascript">
												var stc;
												function userInV(val){
												 	stc = $('#user-drop option:selected').data('city');
													alert(stc);
													//user-drop
													$("#chkbx").prop("checked", false);
													var gsti = $('#user-drop option:selected').data('id');
													//alert(gsti);
													if(parseInt(gsti)==1){
														$("#chkbx").prop("checked", true);
													}
													 $('#user').val('');
													
													 resetradio ();
													 $('#street_address').val('');
														 $('#city').val('');
														 $('#gst_state').val('');
														 $('#zip_code').val('');
													 $('#email').val('');
													$('[id^=user-details_]').hide();
													$('#user-details_'+val).show();
												}
												var st;
													$(document).ready(function() {

														$("#save-user").click(function(){ 
														var user = $('#user').val();
														var address = $('#street_address').val();
														var city = $('#city').val();
														var gst = $('#gstin').val();
														if(gst!=''){
															$("#chkbx").prop("checked", true);
															resetradio ();
														}
														var state = $('#gst_state').val();
														st=document.getElementById('gst_state').value;
														//alert(st);
														var zip = $('#zip_code').val();
														var mail = $('#email').val();
														var lived = '<h4>User Legal Details</h4><label>Legal Name</label>  '+user+' <br /> <label>Address</label> '+address+', '+city+', '+state+', '+zip+' <br /> <label>mail</label> '+mail+' ';
															$('[id^=user-details_]').hide();
															$('#user-details_fm').show();

															$('#user-details_fm').html(lived);
														//alert(checkbox);
													});


													$(".add-more-user").click(function(){ 
														var html = $(".copy").html();
														$(".after-add-more-user").after(html);
													});

													$("body").on("click",".remove",function(){ 
														$(this).parents(".control-group").remove();
													});

													});
												</script>
									</div>
												<div class="modal-footer">
												<input type="button" class="btn btn-success submit_btn invoice-save-btm" name="save" value="Save" id="save-user" data-dismiss="modal">
												<!--<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save & Next" class="btn btn-success submit_btn invoice-save-btm" data-dismiss="modal">-->
												</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" style="background-color:white" id="user-details">

					<?php
					$n=0;
								foreach($invoiceUser as $invoiceUsers) { ?>
							<div id="user-details_<?php  echo $invoiceUsers['order_id'] ?>" style="display:<?php if($n==0){ echo"block";}else{ echo"none";} ?>">		 
							<h4>Legal Details</h4>
							<label>Legal Name</label>   <?php echo  $invoiceUsers['user']?> <br />
							<label> Address</label> <?php echo $invoiceUsers['street_address']?>,<?php echo $invoiceUsers['city']?>,<?php echo $invoiceUsers['gst_state']?>,<?php echo $invoiceUsers['zip_code']?> <br />
							<label> Email</label> <?php echo $invoiceUsers['email']?>
							</div>
							<?php $n++; } ?> 

							<div id="user-details_fm" style="display:none;"></div>
							
					</div>
				</div>
					<div class="col-xs-4 pull-right" style="background-color: #d5f4e6;">
						<h3>Billed To (Client Details)</h3>
						<div class="form-group">
						<select class="form-control" name="client-drop" id="client-drop" autocomplete="off" onchange="clientInV(this.value)">
						<?php
						foreach($invoiceClient as $invoiceClients) {
									?>
							<option value="<?= $invoiceClients['order_id'] ?>" data-ccity="<?php echo $invoiceClients['client_state']; ?>"><?= $invoiceClients['client_name'] ?></option>
						<?php
						} ?>
								
							</select>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-1">Add New Client</button>

								<!-- Modal -->
								<div class="modal fade" id="myModal-1" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Legal Details</h4>
											</div>
											<div class="modal-body">
											<select id="client_country" class="form-control" name="client_country" >
														<option>Select Country</option>
														<option value="Afghanistan">Afghanistan</option>
														<option value="Albania">Albania</option>
														<option value="Algeria">Algeria</option>
														<option value="American Samoa">American Samoa</option>
														<option value="Andorra">Andorra</option>
														<option value="Angola">Angola</option>
														<option value="Anguilla">Anguilla</option>
														<option value="Antartica">Antarctica</option>
														<option value="Antigua and Barbuda">Antigua and Barbuda</option>
														<option value="Argentina">Argentina</option>
														<option value="Armenia">Armenia</option>
														<option value="Aruba">Aruba</option>
														<option value="Australia">Australia</option>
														<option value="Austria">Austria</option>
														<option value="Azerbaijan">Azerbaijan</option>
														<option value="Bahamas">Bahamas</option>
														<option value="Bahrain">Bahrain</option>
														<option value="Bangladesh">Bangladesh</option>
														<option value="Barbados">Barbados</option>
														<option value="Belarus">Belarus</option>
														<option value="Belgium">Belgium</option>
														<option value="Belize">Belize</option>
														<option value="Benin">Benin</option>
														<option value="Bermuda">Bermuda</option>
														<option value="Bhutan">Bhutan</option>
														<option value="Bolivia">Bolivia</option>
														<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
														<option value="Botswana">Botswana</option>
														<option value="Bouvet Island">Bouvet Island</option>
														<option value="Brazil">Brazil</option>
														<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
														<option value="Brunei Darussalam">Brunei Darussalam</option>
														<option value="Bulgaria">Bulgaria</option>
														<option value="Burkina Faso">Burkina Faso</option>
														<option value="Burundi">Burundi</option>
														<option value="Cambodia">Cambodia</option>
														<option value="Cameroon">Cameroon</option>
														<option value="Canada">Canada</option>
														<option value="Cape Verde">Cape Verde</option>
														<option value="Cayman Islands">Cayman Islands</option>
														<option value="Central African Republic">Central African Republic</option>
														<option value="Chad">Chad</option>
														<option value="Chile">Chile</option>
														<option value="China">China</option>
														<option value="Christmas Island">Christmas Island</option>
														<option value="Cocos Islands">Cocos (Keeling) Islands</option>
														<option value="Colombia">Colombia</option>
														<option value="Comoros">Comoros</option>
														<option value="Congo">Congo</option>
														<option value="Congo">Congo, the Democratic Republic of the</option>
														<option value="Cook Islands">Cook Islands</option>
														<option value="Costa Rica">Costa Rica</option>
														<option value="Cota D'Ivoire">Cote d'Ivoire</option>
														<option value="Croatia">Croatia (Hrvatska)</option>
														<option value="Cuba">Cuba</option>
														<option value="Cyprus">Cyprus</option>
														<option value="Czech Republic">Czech Republic</option>
														<option value="Denmark">Denmark</option>
														<option value="Djibouti">Djibouti</option>
														<option value="Dominica">Dominica</option>
														<option value="Dominican Republic">Dominican Republic</option>
														<option value="East Timor">East Timor</option>
														<option value="Ecuador">Ecuador</option>
														<option value="Egypt">Egypt</option>
														<option value="El Salvador">El Salvador</option>
														<option value="Equatorial Guinea">Equatorial Guinea</option>
														<option value="Eritrea">Eritrea</option>
														<option value="Estonia">Estonia</option>
														<option value="Ethiopia">Ethiopia</option>
														<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
														<option value="Faroe Islands">Faroe Islands</option>
														<option value="Fiji">Fiji</option>
														<option value="Finland">Finland</option>
														<option value="France">France</option>
														<option value="France Metropolitan">France, Metropolitan</option>
														<option value="French Guiana">French Guiana</option>
														<option value="French Polynesia">French Polynesia</option>
														<option value="French Southern Territories">French Southern Territories</option>
														<option value="Gabon">Gabon</option>
														<option value="Gambia">Gambia</option>
														<option value="Georgia">Georgia</option>
														<option value="Germany">Germany</option>
														<option value="Ghana">Ghana</option>
														<option value="Gibraltar">Gibraltar</option>
														<option value="Greece">Greece</option>
														<option value="Greenland">Greenland</option>
														<option value="Grenada">Grenada</option>
														<option value="Guadeloupe">Guadeloupe</option>
														<option value="Guam">Guam</option>
														<option value="Guatemala">Guatemala</option>
														<option value="Guinea">Guinea</option>
														<option value="Guinea-Bissau">Guinea-Bissau</option>
														<option value="Guyana">Guyana</option>
														<option value="Haiti">Haiti</option>
														<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
														<option value="Holy See">Holy See (Vatican City State)</option>
														<option value="Honduras">Honduras</option>
														<option value="Hong Kong">Hong Kong</option>
														<option value="Hungary">Hungary</option>
														<option value="Iceland">Iceland</option>
														<option value="India" selected>India</option>
														<option value="Indonesia">Indonesia</option>
														<option value="Iran">Iran (Islamic Republic of)</option>
														<option value="Iraq">Iraq</option>
														<option value="Ireland">Ireland</option>
														<option value="Israel">Israel</option>
														<option value="Italy">Italy</option>
														<option value="Jamaica">Jamaica</option>
														<option value="Japan">Japan</option>
														<option value="Jordan">Jordan</option>
														<option value="Kazakhstan">Kazakhstan</option>
														<option value="Kenya">Kenya</option>
														<option value="Kiribati">Kiribati</option>
														<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
														<option value="Korea">Korea, Republic of</option>
														<option value="Kuwait">Kuwait</option>
														<option value="Kyrgyzstan">Kyrgyzstan</option>
														<option value="Lao">Lao People's Democratic Republic</option>
														<option value="Latvia">Latvia</option>
														<option value="Lebanon">Lebanon</option>
														<option value="Lesotho">Lesotho</option>
														<option value="Liberia">Liberia</option>
														<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
														<option value="Liechtenstein">Liechtenstein</option>
														<option value="Lithuania">Lithuania</option>
														<option value="Luxembourg">Luxembourg</option>
														<option value="Macau">Macau</option>
														<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
														<option value="Madagascar">Madagascar</option>
														<option value="Malawi">Malawi</option>
														<option value="Malaysia">Malaysia</option>
														<option value="Maldives">Maldives</option>
														<option value="Mali">Mali</option>
														<option value="Malta">Malta</option>
														<option value="Marshall Islands">Marshall Islands</option>
														<option value="Martinique">Martinique</option>
														<option value="Mauritania">Mauritania</option>
														<option value="Mauritius">Mauritius</option>
														<option value="Mayotte">Mayotte</option>
														<option value="Mexico">Mexico</option>
														<option value="Micronesia">Micronesia, Federated States of</option>
														<option value="Moldova">Moldova, Republic of</option>
														<option value="Monaco">Monaco</option>
														<option value="Mongolia">Mongolia</option>
														<option value="Montserrat">Montserrat</option>
														<option value="Morocco">Morocco</option>
														<option value="Mozambique">Mozambique</option>
														<option value="Myanmar">Myanmar</option>
														<option value="Namibia">Namibia</option>
														<option value="Nauru">Nauru</option>
														<option value="Nepal">Nepal</option>
														<option value="Netherlands">Netherlands</option>
														<option value="Netherlands Antilles">Netherlands Antilles</option>
														<option value="New Caledonia">New Caledonia</option>
														<option value="New Zealand">New Zealand</option>
														<option value="Nicaragua">Nicaragua</option>
														<option value="Niger">Niger</option>
														<option value="Nigeria">Nigeria</option>
														<option value="Niue">Niue</option>
														<option value="Norfolk Island">Norfolk Island</option>
														<option value="Northern Mariana Islands">Northern Mariana Islands</option>
														<option value="Norway">Norway</option>
														<option value="Oman">Oman</option>
														<option value="Pakistan">Pakistan</option>
														<option value="Palau">Palau</option>
														<option value="Panama">Panama</option>
														<option value="Papua New Guinea">Papua New Guinea</option>
														<option value="Paraguay">Paraguay</option>
														<option value="Peru">Peru</option>
														<option value="Philippines">Philippines</option>
														<option value="Pitcairn">Pitcairn</option>
														<option value="Poland">Poland</option>
														<option value="Portugal">Portugal</option>
														<option value="Puerto Rico">Puerto Rico</option>
														<option value="Qatar">Qatar</option>
														<option value="Reunion">Reunion</option>
														<option value="Romania">Romania</option>
														<option value="Russia">Russian Federation</option>
														<option value="Rwanda">Rwanda</option>
														<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
														<option value="Saint LUCIA">Saint LUCIA</option>
														<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
														<option value="Samoa">Samoa</option>
														<option value="San Marino">San Marino</option>
														<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
														<option value="Saudi Arabia">Saudi Arabia</option>
														<option value="Senegal">Senegal</option>
														<option value="Seychelles">Seychelles</option>
														<option value="Sierra">Sierra Leone</option>
														<option value="Singapore">Singapore</option>
														<option value="Slovakia">Slovakia (Slovak Republic)</option>
														<option value="Slovenia">Slovenia</option>
														<option value="Solomon Islands">Solomon Islands</option>
														<option value="Somalia">Somalia</option>
														<option value="South Africa">South Africa</option>
														<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
														<option value="Span">Spain</option>
														<option value="SriLanka">Sri Lanka</option>
														<option value="St. Helena">St. Helena</option>
														<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
														<option value="Sudan">Sudan</option>
														<option value="Suriname">Suriname</option>
														<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
														<option value="Swaziland">Swaziland</option>
														<option value="Sweden">Sweden</option>
														<option value="Switzerland">Switzerland</option>
														<option value="Syria">Syrian Arab Republic</option>
														<option value="Taiwan">Taiwan, Province of China</option>
														<option value="Tajikistan">Tajikistan</option>
														<option value="Tanzania">Tanzania, United Republic of</option>
														<option value="Thailand">Thailand</option>
														<option value="Togo">Togo</option>
														<option value="Tokelau">Tokelau</option>
														<option value="Tonga">Tonga</option>
														<option value="Trinidad and Tobago">Trinidad and Tobago</option>
														<option value="Tunisia">Tunisia</option>
														<option value="Turkey">Turkey</option>
														<option value="Turkmenistan">Turkmenistan</option>
														<option value="Turks and Caicos">Turks and Caicos Islands</option>
														<option value="Tuvalu">Tuvalu</option>
														<option value="Uganda">Uganda</option>
														<option value="Ukraine">Ukraine</option>
														<option value="United Arab Emirates">United Arab Emirates</option>
														<option value="United Kingdom">United Kingdom</option>
														<option value="United States">United States</option>
														<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
														<option value="Uruguay">Uruguay</option>
														<option value="Uzbekistan">Uzbekistan</option>
														<option value="Vanuatu">Vanuatu</option>
														<option value="Venezuela">Venezuela</option>
														<option value="Vietnam">Viet Nam</option>
														<option value="Virgin Islands (British)">Virgin Islands (British)</option>
														<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
														<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
														<option value="Western Sahara">Western Sahara</option>
														<option value="Yemen">Yemen</option>
														<option value="Serbia">Serbia</option>
														<option value="Zambia">Zambia</option>
														<option value="Zimbabwe">Zimbabwe</option>
													</select></br>
											<input type="text" class="form-control" name="client_name" id="client_name" placeholder="Legal Name" autocomplete="off"></br>
											<input type="text" class="form-control" name="client_email" id="client_email" placeholder="Your Email" autocomplete="off" onblur1="validateEmail(this.value);"></br>
											<input type="number" class="form-control" name="client_mobile" id="client_mobile" placeholder="Your Mobile" autocomplete="off" onblur1="validateMobile(this.value);"></br>
											<input type="text" class="form-control" name="client_gstin" id="client_gstin" placeholder="Legal GSTIN (Optional)" autocomplete="off" onblur1="validateGst(this.value);"></br>
											<input type="text" class="form-control" name="client_pan_no" id="client_pan_no" placeholder="Legal PAN Number(Optional)" autocomplete="off" onblur1="validatePan(this.value);"></br>
											<textarea class="form-control" name="client_street_address" id="client_street_address" placeholder="Street Address"></textarea></br>
											<select name="client_state" id="client_state" class="form-control" >
													<option>Select State</option>
													<option value="Andhra Pradesh">Andhra Pradesh</option>
													<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
													<option value="Arunachal Pradesh">Arunachal Pradesh</option>
													<option value="Assam">Assam</option>
													<option value="Bihar">Bihar</option>
													<option value="Chandigarh">Chandigarh</option>
													<option value="Chhattisgarh">Chhattisgarh</option>
													<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
													<option value="Daman and Diu">Daman and Diu</option>
													<option value="Delhi">Delhi</option>
													<option value="Lakshadweep">Lakshadweep</option>
													<option value="Puducherry">Puducherry</option>
													<option value="Goa">Goa</option>
													<option value="Gujarat">Gujarat</option>
													<option value="Haryana">Haryana</option>
													<option value="Himachal Pradesh">Himachal Pradesh</option>
													<option value="Jammu and Kashmir">Jammu and Kashmir</option>
													<option value="Jharkhand">Jharkhand</option>
													<option value="Karnataka">Karnataka</option>
													<option value="Kerala">Kerala</option>
													<option value="Madhya Pradesh">Madhya Pradesh</option>
													<option value="Maharashtra">Maharashtra</option>
													<option value="Manipur">Manipur</option>
													<option value="Meghalaya">Meghalaya</option>
													<option value="Mizoram">Mizoram</option>
													<option value="Nagaland">Nagaland</option>
													<option value="Odisha">Odisha</option>
													<option value="Punjab">Punjab</option>
													<option value="Rajasthan">Rajasthan</option>
													<option value="Sikkim">Sikkim</option>
													<option value="Tamil Nadu">Tamil Nadu</option>
													<option value="Telangana">Telangana</option>
													<option value="Tripura">Tripura</option>
													<option value="Uttar Pradesh">Uttar Pradesh</option>
													<option value="Uttarakhand">Uttarakhand</option>
													<option value="West Bengal">West Bengal</option>
													</select></br>
												<input type="text" class="form-control" name="client_city" id="client_city" placeholder="City" autocomplete="off"></br>
												<input type="number" class="form-control" name="client_zip_code" id="client_zip_code" placeholder="Postal Code/Zip Code" autocomplete="off" onblur1="validateZip(this.value);"><br>
												<div class="input-group control-group after-add-more-user">
														<div class="input-group-btn"> 
															<button class="btn btn-success add-more-client" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
														</div>
													</div>
												<div class="copy hide">
													<div class="control-group input-group" style="margin-top:10px">
														<input type="text" name="addmore-client" class="form-control" placeholder="Enter Your Label">
													<div class="input-group-btn"> 
														<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
													</div>
													</div>
												</div>
												<script type="text/javascript">
												function clientInV(val){
													var ustc = stc;
													var cstc = $('#client-drop option:selected').data('ccity');
													alert(cstc);
													if(cstc==ustc){
														$("#flexRadioDefault1").prop("checked",true);
													}
													if(cstc!=ustc){
														$("#flexRadioDefault2").prop("checked",true);
													}
													if(document.getElementById('flexRadioDefault1').checked) { 
                										document.getElementById("gstrad").innerHTML = document.getElementById("flexRadioDefault1").value;
														}
														if(document.getElementById('flexRadioDefault2').checked) { 
                										document.getElementById("gstrad").innerHTML = document.getElementById("flexRadioDefault2").value;
														}
													 $('#client_name').val('');
													 $('#client_street_address').val('');
														 $('#client_city').val('');
														 $('#client_state').val('');
														 $('#client_zip_code').val('');
													 $('#client_email').val('');
													$('[id^=client-details_]').hide();
													$('#client-details_'+val).show();
												}

													$(document).ready(function() {

														$("#save-client").click(function(){ 
														var client = $('#client_name').val();
														var client_address = $('#client_street_address').val();
														var client_city = $('#client_city').val();
														var client_state = $('#client_state').val();
														var x = st;
														if(client_state==x){
															$("#flexRadioDefault1").prop("checked",true);
														}
														else{
															$("#flexRadioDefault2").prop("checked",true);
														}
														if(document.getElementById('flexRadioDefault1').checked) { 
                										document.getElementById("gstrad").innerHTML = document.getElementById("flexRadioDefault1").value;
														}
														if(document.getElementById('flexRadioDefault2').checked) { 
                										document.getElementById("gstrad").innerHTML = document.getElementById("flexRadioDefault2").value;
														}
														var client_zip = $('#client_zip_code').val();
														var client_mail = $('#client_email').val();
														var live = '<h4>Client Legal Details</h4><label>Legal Name</label>  '+client+' <br /> <label>Address</label> '+client_address+', '+client_city+', '+client_state+', '+client_zip+' <br /> <label>Email</label> '+client_mail+' ';
														$('[id^=client-details_]').hide();
															$('#client-details_fm').show();

															$('#client-details_fm').html(live);
														alert(client);
													});

													$(".add-more-client").click(function(){ 
														var html = $(".copy").html();
														$(".after-add-more-user").after(html);
													});

													$("body").on("click",".remove",function(){ 
														$(this).parents(".control-group").remove();
													});

													});

													/*function validateEmail(emailField){
														var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

														if (reg.test(emailField.value) == false) 
														{
															alert('Invalid Email Address');
															return false;
														}

														return true;

												}

												function validateMobile(mobileField){
														var mobile = /^[0-9]{10}$/;

														if (mobile.test(mobileField.value) == false) 
														{
															alert('Please enter a valid Phone number!');
															return false;
														}

														return true;

												}*/
function validateEmail(sEmail) {
  var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

  if(!sEmail.match(reEmail)) {
    alert("Invalid email address");
    return false;
  }

  return true;

}
function validateMobile(sMobile) {

  var reMobile = /^[0-9]{10}$/

  if(!sMobile.match(reMobile)) {
    alert("Invalid Mobile Number");
    return false;
  }

  return true;

}
function validateGst(sGst) {

var reGst = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;

if(!sGst.match(reGst)) {
  alert("Invalid Gst number");
  return false;
}

return true;

}
function validatePan(sPan) {

var rePan = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

if(!sPan.match(rePan)) {
  alert("Invalid Pan Number");
  return false;
}

return true;

}
function validateZip(sZip) {

var reZip = /^[0-9]{6}$/;

if(!sZip.match(reZip)) {
  alert("Invalid Zip Code");
  return false;
}

return true;

}
														
														/*function validateGst(gstField){
														var gstj = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;

														if (gstj.test(gstField.value) == false) 
														{
															alert('Invalid GSTIN');
															return false;
														}

														return true;

												}

												function validatePan(panField){
														var pan = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

														if (pan.test(panField.value) == false) 
														{
															alert('Invalid PAN');
															return false;
														}

														return true;

												}

												function validateZip(zipField){
														var zip = /^[0-9]{6}$/;

														if (zip.test(zipField.value) == false) 
														{
															alert('Invalid Zip Code');
															return false;
														}

														return true;

												}*/
												</script>
											</div>
											<div class="modal-footer">
											<input type="button" class="btn btn-success submit_btn invoice-save-btm" name="save-client" id="save-client" value="Save" data-dismiss="modal">
											</div>
										</div>

									</div>
								</div>

								<div class="form-group" style="background-color:white" id="client-details">
								<?php
								$i=0;
								foreach($invoiceClient as $invoiceClients) { ?>
							<div id="client-details_<?php  echo $invoiceClients['order_id'] ?>" style="display:<?php if($i==0){ echo"block";}else{ echo"none";} ?>">		 
							<h4>Client Legal Details</h4>
							<label>Legal Name</label>   <?php echo  $invoiceClients['client_name']?> <br />
							<label> Address</label> <?php echo $invoiceClients['client_street_address']?>,<?php echo $invoiceClients['client_city']?>,<?php echo $invoiceClients['client_state']?>,<?php echo $invoiceClients['client_zip_code']?> <br />
							<label> Email</label> <?php echo $invoiceClients['client_email']?>
							</div>
							<?php $i++; } ?> 

							<div id="client-details_fm" style="display:none;"></div>
						</div>
						</div>
				</div>
			</div>		
					<div class="row">
						<div class="col-xs-4" >
						<div class="form-group">
								<label for="currency">Currency</label>
								<select name="currency" id="currency" class="form-control" onclick="myFunction()">
									<option value="&#8377">Indian Rupee(INR, <span>&#8377;</span>)</option>
									<option value="&#36">US Dollar(USD, <span>&#36;</span>)</option>
									<option value="&#163">British Pound Strling(GBP, <span>&#163;</span>)</option>
									<option value="&#8364">EURO(EUR, <span>&#8364;</span>)</option>
									<option value="&#165">Japanese Yen(JPY, <span>&#165;</span>)</option>
								</select>
						</div>
						</div>
						<script type="text/javascript">
					function myFunction() {
					var x = document.getElementById("currency").value;
					document.getElementById("symbl1").innerHTML = x;
					document.getElementById("symbl2").innerHTML = x;
					document.getElementById("symbl3").innerHTML = x;
					document.getElementById("symbl4").innerHTML = x;
					document.getElementById("symbl5").innerHTML = x;
					}
				</script>
					</div>
						<!--<script type="text/javascript"> 
						$(document).ready(function(){ 
							$("#chkbx").change(function(){ 
								if($(this).prop("checked") == true){ 
									$("#taxRate").val("18");
								} 
								else if($(this).prop("checked") == false){ 
									$("#taxRate").val(""); 
								} 
							}); 
						}); 
						</script>-->
						<style>
							.buttons {
							display: none;
						}
						</style>
						<script type="text/javascript">
								function resetradio () {
							var buttons = document.querySelector('.buttons');
							var radios = document.getElementsByName('flexRadioDefault');
							//radios[0].checked = true;
							if ($("#chkbx").is(':checked')) {
								buttons.style.display = 'block';
								$("#taxRate").val("18");
							}
							else {
								buttons.style.display = 'none';
								$("#taxRate").val("");
							}
						}

						/*function setcheckbox () {
							var checkbox = document.getElementsByName('chkbx')[0];
							if (checkbox.checked == false) {
								checkbox.checked = true;
							}
						}*/

						</script>
					<div class="row">
									<div class="col-xs-4">
									<div class="form-group">
									<label>Add GST</label>
										<input type="checkbox" id="chkbx" value="GST" name="chkbx" onclick="resetradio(this)">
									</div>
									</div>
									<div class="buttons">
									<div class="col-xs-4">
									<div class="form-group">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="CGST&IGST" onclick="setcheckbox()"> CGST & SGST
									</div>
									</div>
									<div class="col-xs-4">
									<div class="form-group">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="IGST" onclick="setcheckbox()"> IGST
									</div>
									</div>
									</div>
			</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<table class="table table-bordered table-hover" id="invoiceItem">	
							<tr style="background-color: #80ced6;">
								<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
								<th width="10%">Service No</th>
								<th width="20%">Platform Name</th>
								<th width="10%">Quantity</th>
								<th width="10%">Price</th>							
								<th width="10%">Total</th>
								<th width="38%">Service Description</th>
							</tr>							
							<tr style="background-color: #d5f4e6;">
								<td><input class="itemRow" type="checkbox"></td>
								<td><input type="text" name="productCode[]" id="productCode_1" class="form-control" value="<?php echo $productCode ?>" autocomplete="off"></td>
								<td><select name="productName[]" id="productName_1" class="select2 form-control" required>
								<option>Select Service</option>
								<option value="Instagram">Instagram</option>
								<option value="Youtube">Youtube</option>
								<option value="Twitter">Twitter</option>
								<option value="Other">Other</option>
								</select>
								</td>
								<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off" required></td>
								<td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
								<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
								<td><input type="text" name="serviceDes[]" id="serviceDes_1" class="form-control des" autocomplete="off"></td>
							</tr>						
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
				<div class="col-12">
				<div class="form-group" style="background-color:#d5f4e6;">
					<h3>Terms and Conditions</h3>
						<textarea class="form-control" rows="5" type="text" name="condition_desc" id="condition_desc">
1.Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.&#013;2.Please quote invoice number when remitting funds.&#013;</textarea>
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="form-group">
            		<input type="button" class="btn btn-success add-notes" onclick="showDiv()" name="note_btn" id="note_btn" value="Add Notes" type="button">
					</div>
          			<div class="form-group" id="notes-div" style="display:none">
						<textarea class="form-control" rows="5" type="text" name="notes" id="notes" ></textarea>
						<input type="button" id="clear" value="close" class="close-icon" onclick="hideDiv()">
          			</div>
				<script type="text/javascript">
					function showDiv() {
  						 document.getElementById('notes-div').style.display = "block";
						}

					function hideDiv() {
						var button = document.querySelector('#clear');
  						 document.getElementById('notes-div').style.display = "none";
						   button.addEventListener('click', () => {
            				document.querySelector('#notes').value = "";
							});
						}

				</script>
					</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">
						<div class="form-group">
							<label>Subtotal: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency"><p id="symbl1"></p></div>
								<input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
							</div>
						</div>
						<div class="form-group">
							<label id="gstrad"></label>
							<div class="input-group">
								<input type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="form-group">
							<label>Tax Amount: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency"><p id="symbl2"></p></div>
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount" step="any">
							</div>
						</div>							
						<div class="form-group">
							<label>Total: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency"><p id="symbl3"></p></div>
								<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total" step="any">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Paid: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency"><p id="symbl4"></p></div>
								<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid" step="any">
							</div>
						</div>
						<div class="form-group">
							<label>Amount Due: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency"><p id="symbl5"></p></div>
								<input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due" step="any">
							</div>
						</div>
					</span>
				</div>
			</div>
			<div class="row">
					<div class="form-group">
					<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
						<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save & Next" class="btn btn-success submit_btn invoice-save-btm">
					</div>
			</div>
				<div class="clearfix"></div>		      	
			</div>
		</form>
</div>
</body>
</html>
<?php include('footer.php');?>