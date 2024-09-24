<?php

session_start();

$roomtype = isset($_GET['roomtype']) ? ($_GET['roomtype']) : 'Not specified';
$totalprice = isset($_GET['totalprice']) ? floatval(str_replace('$', '', $_GET['totalprice'])) * 100 : 0; 
$fullname = isset($_GET['fullname']) ? ($_GET['fullname']) : 'Unknown';
$phone = isset($_GET['phone']) ? ($_GET['phone']) : '0000000000';
$noofroom = isset($_GET['numberofrooms']) ? ($_GET['numberofrooms']) : 1;
$referenceNumber = isset($_GET['referenceNumber']) ? ($_GET['referenceNumber']) : uniqid(); 
$address = isset($_GET['address']) ? ($_GET['address']) : 'Unknown';
$checkin = isset($_GET['checkin']) ? ($_GET['checkin']) : 'Unknown';
$checkout = isset($_GET['checkout']) ? ($_GET['checkout']) : 'Unknown';
$purchase_order_id = $referenceNumber;
$email = 'test@gmail.com';

$_SESSION['roomType'] = $roomtype;
$_SESSION['name'] = $fullname;
$_SESSION['noofRoom'] = $noofroom;
$_SESSION['Phone'] = $phone;
$_SESSION['Address'] = $address;
$_SESSION['Checkin'] = $checkin;
$_SESSION['Checkout'] = $checkout;

// echo $_SESSION['roomType'];


if ($totalprice < 1000 || $totalprice > 100000) { 
    echo "Sorry, the total amount must be between Rs 10.0 and Rs 1000.0.<br>";
    echo "Your total price: Rs " . number_format($totalprice / 100, 2) . "<br>";
    echo "Please contact support or use an alternative payment method.";
}
else{


    $postFields = array(
        "return_url" => "http://localhost/hotel/payment-response.php",
        "website_url" => "http://localhost/hotel/",
        "amount" => $totalprice,
        "purchase_order_id" => $purchase_order_id,
        "purchase_order_name" => $roomtype,
        "customer_info" => array(
            "name" => $fullname,
            "email" => $email,
            "phone" => $phone
        )
    );



$jsonData = json_encode($postFields);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => array(
        'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);


if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
} else {
    $responseArray = json_decode($response, true);

    if (isset($responseArray['error'])) {
        echo 'Error: ' . $responseArray['error'];
    } elseif (isset($responseArray['payment_url'])) {
        // Redirect the user to the payment page
        header('Location: ' . $responseArray['payment_url']);
    } else {
        echo 'Unexpected response: ' . $response;
    }
}

curl_close($curl);

}

?>
