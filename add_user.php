<?php 
session_start();
include('header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
$sd =mktime();
if(!empty($_POST['user']) && $_POST['user']) {	
	$invoice->saveUser($_POST);
	header("Location:userlist.php");	
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	$invoiceUser = $invoice->getInvoiceUser($_GET['update_id']);
	$invoiceValues = $invoice->getInvoice($_GET['update_id']);		
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
h3 {
  text-align: center;
}
</style>
<script>
  function clickAlert() {
    alert("User Leagal Profile Created Successfully!");
}
</script>
<div class="container content-invoice">
    <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 	
        <div class="load-animate animated fadeInUp">
		<input value="<?php echo $_SESSION['userid'] ?>" type="hidden" id="user-drop" name="user-drop" >
			<input value="<?php echo $sd ?>" type="hidden" id="user_insert" name="user_insert" >
			<input value="<?php echo $sd ?>" type="hidden" id="user_update" name="user_update" >
            <div class="row">
		      	<div class="col-xs-8" style="background-color: #d5f4e6;">
					  <h3>Create Legal Profile</h3>
					  <div class="form-group">
					  <label>Country</label>
                      <select id="country" class="form-control" name="country" required>
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
					  </div>
					<div class="form-group">
					<label>Legal Name</label>
						<input type="text" class="form-control" name="user" id="user" placeholder="Your Name" autocomplete="off" required>
					</div>
					<div class="form-group">
					<label>Email</label>
						<input type="text" class="form-control" name="email" id="email" placeholder="Your Email" autocomplete="off" required onblur="validateEmail(this);">
					</div>
					<div class="form-group">
					<label>Mobile</label>
						<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile" autocomplete="off" required onblur="validateMobile(this);">
					</div>
					<div class="form-group">
					<label>Legal GSTIN</label>
						<input type="text" class="form-control" name="gstin" id="gstin" placeholder="Legal GSTIN" autocomplete="off" onblur="validateGst(this);">
					</div>
					<div class="form-group">
					<label>PAN</label>
						<input type="text" class="form-control" name="pan_no" id="pan_no" placeholder="Legal PAN Number" autocomplete="off" onblur="validatePan(this);">
					</div>
					<div class="form-group">
					<label>Address</label>
						<input type="text" class="form-control" name="street_address" id="street_address" placeholder="Street Address" required>
					</div>
					<div class="form-group">
					<label>State</label>
                    <select name="gst_state" id="gst_state" class="form-control" required>
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
					  </div>
					<div class="form-group">
					<label>City</label>
						<input type="text" class="form-control" name="city" id="city" placeholder="City" autocomplete="off" required>
					</div>
					<div class="form-group">
					<label>Zip/Postal Code</label>
						<input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Postal Code/Zip Code" autocomplete="off" required onblur="validateZip(this);">
					</div>
                    <div class="form-group">
							<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
							<input type="hidden" value="<?php echo $invoiceValues['order_id']; ?>" class="form-control" name="invoiceId" id="invoiceId">
			      			<input data-loading-text="Save Invoice..." type="submit" name="invoice_btn" value="Add User" class="btn btn-success submit_btn invoice-save-btm" onclick="clickAlert()">
			      	</div>
				</div>
            </div>
        </div>
    </form>
<script type="text/javascript">
function validateEmail(emailField){
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
}
														
function validateGst(gstField){
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
}
</script>
</div>