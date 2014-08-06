<?php
/**
 * PHP library version: 1.1
 */
require_once('../lib/worldpay.php');

// Initialise Worldpay class with your SERVICE KEY
$worldpay = new Worldpay('your-service-key');

// Sometimes your SSL doesnt validate locally
// DONT USE IN PRODUCTION
$worldpay->disableSSLCheck(true);

$token = $_POST['token'];
$name = $_POST['name'];
$amount = $_POST['amount'];
// Try catch 
try {
    // Customers billing address
    $billing_address = array(
        "address1"=>'123 House Road',
        "address2"=> 'A village',
        "address3"=> '',
        "postalCode"=> 'EC1 1AA',
        "city"=> 'London',
        "state"=> '',
        "countryCode"=> 'GB',
    );
    $response = $worldpay->createOrder(array(
        'token' => $token, // The token from WorldpayJS
        'orderDescription' => 'My test order', // Order description of your choice
        'amount' => $amount*100, // Amount in pence
        'currencyCode' => 'GBP', // Currency code
        'name' => $name, // Customer name
        'billingAddress' => $billing_address, // Billing address array
        'customerIdentifiers' => array( // Custom indentifiers
            'my-customer-ref' => 'customer-ref'
        ),
        'customerOrderCode' => 'A123' // Order code of your choice
    ));
    
    if ($response['paymentStatus'] === 'SUCCESS') {
        // Create order was successful!
        $worldpayOrderCode = $response['orderCode'];
        echo '<pre>' . print_r($response, true). '</pre>';
        // TODO: Store the order code somewhere..
    } else {
        // Something went wrong
        throw new WorldpayException(print_r($response, true));
    }
} catch (WorldpayException $e) { // PHP 5.2 - Change to Exception, only $e->getMessage() is available
    // Worldpay has thrown an exception
    echo 'Error code: ' . $e->getCustomCode() . '<br/> 
    HTTP status code:' . $e->getHttpStatusCode() . '<br/> 
    Error description: ' . $e->getDescription()  . ' <br/>
    Error message: ' . $e->getMessage();
}
