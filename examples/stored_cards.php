<?php
require_once('../lib/worldpay.php');

// Initialise Worldpay class with your SERVICE KEY
$worldpay = new Worldpay('your-service-key');


// Sometimes your SSL doesnt validate locally
// DONT USE IN PRODUCTION
$worldpay->disableSSLCheck(true);

$token = $_POST['token'];

try {
    $cardDetails = $worldpay->getStoredCardDetails($token);
    echo '<pre>' . print_r($cardDetails, true). '</pre>';

} catch (WorldpayException $e) { // PHP 5.2 - Change to Exception, only $e->getMessage() is available
    echo 'Error code: ' . $e->getCustomCode() . '<br/> 
    HTTP status code:' . $e->getHttpStatusCode() . '<br/> 
    Error description: ' . $e->getDescription()  . ' <br/>
    Error message: ' . $e->getMessage();
}
