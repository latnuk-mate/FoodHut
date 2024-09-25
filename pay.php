<?php
session_start();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_3e6997ec51861572b1105c5c04d",
                  "X-Auth-Token:test_1c252aaea721158078c2b62cd62"));
$payload = Array(
    'purpose' => $_SESSION['productName'],
    'amount' => $_SESSION['productPrice'],
    'phone' => $_SESSION['customerNumber'] ,
    'buyer_name' => $_SESSION['customerName'],
    'redirect_url' => 'http://localhost:5000/thankYou.php',
    'send_email' => true,
    // 'webhook' => 'http://localhost:5000/thankYou.php',
    'send_sms' => true,
    'email' => 'foo@example.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}
curl_close($ch);
// print_r($response);
$res = json_decode($response, true);

$url = $res['payment_request']['longurl'];

header('Location: '.$url);

?>