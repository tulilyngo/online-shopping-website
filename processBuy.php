<?php

require('functions.php');

//Get all post data
extract($_POST);



$name_first = $_POST["name_first"];
$name_last = $_POST["name_last"];
$email = $_POST["email"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$country = $_POST["country"];
$phone = $_POST["phone"];
$fax = $_POST["fax"];
$mail_list = $_POST["check"];
$cc_no = $_POST["cc_no"];
$expMonth = $_POST["expMonth"];
$expYear = $_POST["expYear"];



// validate fields
$expMonth = (int)$expMonth;
$expYear = (int)$expYear;

if ($address2 == "") {
    $address2 = "NULL";
}

$zip = (int)$zip;

if ($fax == "") {
    $fax = "NULL";
}

if ($mail_list == "true") {
    $mail_list = 1;
} else {
    $mail_list = 0;
}

//Open the database
$data = openDB();

// insert data into customer
//setCustomer($cc_no, $exp_mo, $exp_yr, $name_first, $name_last, $email, $address1, $address2, $city, $state, $zip, $country, $phone, $fax, $mail_list);
// if customer is in database, then update
$res = getCustomer($cc_no);
if ($res->num_rows != 0) {
    $query = "update customer set exp_mo = $expMonth, exp_yr = $expYear, name_first = '$name_first', name_last= '$name_last', email = '$email', address1 = '$address1', address2 = '$address2', city = '$city', state = '$state', zip = $zip, country = '$country', phone = '$phone', fax = '$fax', mail_list = $mail_list where cc_no = '$cc_no';";
} else {
    $query = "insert into customer values('$cc_no',$expMonth,$expYear,'$name_first','$name_last','$email','$address1','$address2','$city',
                                            '$state',$zip,'$country','$phone','$fax',$mail_list);";
}

//Invoke the query
$res = mysqli_query($data, $query);

//Check the result
if ($res == false)
{
    exit("Customer Error");
}

// insert data into orders
$product = explode(",", $_POST['product']);
$item_no = $product[0];
$quantity = $product[1];

$query = "insert into orders values($quantity, now(), $item_no, '$cc_no');";

//Invoke the query
$res = mysqli_query($data, $query);

//Check the result
if ($res == false)
{
    exit("Orders Error");
}

// update inventory
$inventory = getInventory($item_no);

$query = "update product set inventory = $inventory - $quantity where item_no = $item_no;";

//Invoke the query
$res = mysqli_query($data, $query );

//Check the result
if ($res == false)
{
    exit("Product Error");
}

// succesful message
print('Form is processed successfully.');

?>

