<?=template_header('Place Order')?>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
// If there are no products in the cart
if (empty($products_in_cart)) {
		//$_SESSION["payment_done"] = "done";
		header('Location: index.php?page=cart');
		exit;
}
date_default_timezone_set('Asia/Hong_Kong'); // Set time zone
$current_month_year = date('Y-m');
$check_current_month_year = date('Y-m' , strtotime( $d . " +1 month")); //add one month for verification

$month = ($_POST['card_exp']);
$temp = new DateTime($month.'-01');
$exp_month_year = $temp->format('Y-m');

// Redirect to the success payment page if finished the checking
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST) and !empty($_POST)){
		$_SESSION["payment_done"] = "done";
		header('Location: index.php?page=success_payment');
	}
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<div class="placeorder content-wrapper">
	<h1>Payment method</h1>
	<p>Thank you for ordering with us, Please input your contact information</p>
	<h2> Please select your payment</h2>
	<div class="row">
	        <div class="col-75">
	                <div class="payment_container">
                                <form action="index.php?page=placeorder" method="post" name="placeorder_validation" id="phpCode" class="row g-3 needs-validation">
                                        <label for="fname" style="font-size: 30px;">Accepted Cards</label>
                                                <div class="icon-container" style="font-size: 30px;">
                                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                                        </div>
                                        <div class="form-group owner">
                                                <label for="fname"><i class="fa fa-user"></i> Contact Name</label>
                                                <!--<input type="text" class="form-control" id="owner" name="owner" placeholder="Chan Tai Man" required>-->
                                                <input type="text" id="owner" name="owner" placeholder="Chan Tai Man" required>
                                                <ul style="list-style-type: none; padding: 0;">
                                                        <li id ="owner_check_result" style="color:red;" ;></li>
                                                </ul>
                                        </div>
                                        <div class="form-group address">
                                                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                                <!--<input type="text" class="form-control" id="adr" name="adr" placeholder="Your delivery address" required>-->
                                                <input type="text" id="address" name="address" placeholder="Your delivery address" required>
                                                <ul style="list-style-type: none; padding: 0;">
                                                        <li id ="address_check_result" style="color:red;";></li>
                                                </ul>
                                        </div>
                                        <div class="form-group" id="card-number-field">
                                                <label for="cardNumber">Card Number</label>
                                                <!--<input type="text" class="form-control" id="cardNumber" placeholder="1111-2222-3333-4444" minlength="16" maxlength="16" required>-->
                                                <input type="text" id="card_number" name="card_number" placeholder="1111-2222-3333-4444" required>
                                                <ul style="list-style-type: none; padding: 0;">
                                                        <li id ="card_number_check_result" style="color:red;";></li>
                                                </ul>
                                        </div>
                                        <div class="form-group CVV">
                                                <label for="cvv">CVV</label>
                                                <!--<input type="text" class="form-control" id="cvv" name="cvv" placeholder="xxx" minlength="3" required>-->
                                                <input type="text" id="cvv" name="cvv" placeholder="xxx">
                                                        <ul style="list-style-type: none; padding: 0;">
                                                                <li id ="cvv_check_result" style="color:red;";></li>
                                                        </ul>
                                        </div>
                                        <div class="form-group Expdate">
                                                <div class="col-100">
                                                        <label for="expdate">Exp month</label>
                                                        <input type="month" id="expdate" name="expdate" min="<?php echo $check_current_month_year;?>" max="2047-12" placeholder="mm-yyyy" required>
                                                        <ul style="list-style-type: none; padding: 0;">
                                                                <li id ="expdate_check_result" style="color:red;";></li>
                                                        </ul>
                                                </div>
                                        </div>
                                        <div class="form-group" id="pay-now">
                                                <button type="submit" class="btn btn-primary" onClick="check(); return false">Confirm</button>
                                        </div>
                                </form>
	                </div>
	        </div>
	</div>
</div>

<!-- Connect to javascript-->
<!--<script src="js/placeorder_validation.js"></script>-->
<script>
function check()
        {
                var check_owner_success = false, check_address_success = false, check_card_number_success = false, check_cvv_success = false, expdate_success = false;
                if(placeorder_validation.owner.value == "") //If owner name is null
                {
                        text = "Please fill in your name";
                        document.getElementById("owner_check_result").innerHTML = text;
                        check_owner_success = false;
                } else {
                        if(placeorder_validation.owner.value.length <= 5)
                        {
                                text = "Not a valid name";
                                document.getElementById("owner_check_result").innerHTML = text;
                                check_owner_success = false;
                        } else {
                                text = "";
                                document.getElementById("owner_check_result").innerHTML = text;
                                check_owner_success = true;
                        }
                }
                if(placeorder_validation.address.value == "")
                {
                        text = "Please fill in your address";
                        document.getElementById("address_check_result").innerHTML = text;
                        check_address_success = false;
                } else {
                        if(placeorder_validation.address.value.length <= 10)
                        {
                                text = "Not a valid address";
                                document.getElementById("address_check_result").innerHTML = text;
                                check_address_success = false;
                        } else {
                                text = "";
                                document.getElementById("address_check_result").innerHTML = text;
                                check_address_success = true;
                        }
                }

                if(placeorder_validation.card_number.value == "")
                {
                        text = "Please fill in your credit card number";
                        document.getElementById("card_number_check_result").innerHTML = text;
                        check_card_number_success = false;
                }
                if (placeorder_validation.cvv.value == "")
                {
                        text = "Please fill in your ccv number";
                        document.getElementById("cvv_check_result").innerHTML = text;
                        check_ccv_success = false;
                } else {
                        text = "";
                        document.getElementById("cvv_check_result").innerHTML = text;
                        check_ccv_success = false;
                }
                if(placeorder_validation.card_number.value != "") 
                {       
                        placeorder_validation.card_number.value = placeorder_validation.card_number.value.replace(/\s+/g, ''); //Remove spaces
                        placeorder_validation.card_number.value = placeorder_validation.card_number.value.replace(/-/g,''); //Remove -
                        var cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/; //For visa card
                        if(placeorder_validation.card_number.value.match(cardno))
                        {       
                                        text = "";
                                        document.getElementById("card_number_check_result").innerHTML = text;
                                        check_card_number_success = true;
                                        var ccv = /^\d{3}$/;
                                        if (placeorder_validation.cvv.value.match(ccv))
                                        {
                                                text = "";
                                                document.getElementById("cvv_check_result").innerHTML = text;
                                                check_cvv_success = true;
                                        } else {
                                                text = "Not a valid CVV number or CVV number is null";
                                                document.getElementById("cvv_check_result").innerHTML = text;
                                                check_cvv_success = false;
                                        }
                        } else {
                                var cardno = /^(?:3[47][0-9]{13})$/; //For AE card
                                if(placeorder_validation.card_number.value.match(cardno))
                                {       
                                        text = "";
                                        document.getElementById("card_number_check_result").innerHTML = text;
                                        check_card_number_success = true;
                                        var ccv = /^\d{4}$/;
                                        if (placeorder_validation.cvv.value.match(ccv))
                                        {
                                                text = "";
                                                document.getElementById("cvv_check_result").innerHTML = text;
                                                check_cvv_success = true;
                                        } else {
                                                text = "Not a valid CVV number or CVV number is null";
                                                document.getElementById("cvv_check_result").innerHTML = text;
                                                check_cvv_success = false;
                                        }
                                } else {
                                        var cardno = /^(?:5[1-5][0-9]{14})$/; //For master card 
                                        if(placeorder_validation.card_number.value.match(cardno)){       
                                                text = "";
                                                document.getElementById("card_number_check_result").innerHTML = text;
                                                check_card_number_success = true;
                                                var ccv = /^\d{3}$/;
                                                if (placeorder_validation.cvv.value.match(ccv))
                                                {
                                                        text = "";
                                                        document.getElementById("cvv_check_result").innerHTML = text;
                                                        check_cvv_success = true;
                                                } else {
                                                        text = "Not a valid CVV number or CVV number is null";
                                                        document.getElementById("cvv_check_result").innerHTML = text;
                                                        check_cvv_success = false;
                                                }
                                        } else {
                                                var cardno = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/; //For discover card
                                                if(placeorder_validation.card_number.value.match(cardno))
                                                {       
                                                        text = "";
                                                        document.getElementById("card_number_check_result").innerHTML = text;
                                                        check_card_number_success = true;
                                                        var ccv = /^\d{3}$/;
                                                        if (placeorder_validation.cvv.value.match(ccv))
                                                        {
                                                                text = "";
                                                                document.getElementById("cvv_check_result").innerHTML = text;
                                                                check_cvv_success = true;
                                                        } else {
                                                                text = "Not a valid CVV number or CVV number is null";
                                                                document.getElementById("cvv_check_result").innerHTML = text;
                                                                check_cvv_success = false;
                                                        }
                                                } else {
                                                        text = "Not a valid card number";
                                                        document.getElementById("card_number_check_result").innerHTML = text;
                                                        check_card_number_success = false;
                                                }
                                        }
                                }

                        }
                }

                if(placeorder_validation.expdate.value == "")
                {
                        text = "Please fill in your credit card expdate";
                        document.getElementById("expdate_check_result").innerHTML = text;
                        expdate_success = false;
                } else {
                        text = "";
                        document.getElementById("expdate_check_result").innerHTML = text;
                        expdate_success = true;
                }
                if (check_owner_success == true && check_address_success == true && check_card_number_success == true && check_cvv_success == true && expdate_success == true)
                {
                        document.getElementById("phpCode")
                        php.submit()
                }
        }
</script>
<?=template_footer()?>