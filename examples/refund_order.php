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

$worldpayOrderCode = $_POST['orderCode'];
// Try catch 
try {
    // Refund the order using the Worldpay order code
    $worldpay->refundOrder($worldpayOrderCode);
    echo "Order $worldpayOrderCode has been refunded!";
} catch (WorldpayException $e) { // PHP 5.2 - Change to Exception, only $e->getMessage() is available
    // Worldpay has thrown an exception
    echo 'Error code: ' . $e->getCustomCode() . '<br/> 
    HTTP status code:' . $e->getHttpStatusCode() . '<br/> 
    Error description: ' . $e->getDescription()  . ' <br/>
    Error message: ' . $e->getMessage();
}
