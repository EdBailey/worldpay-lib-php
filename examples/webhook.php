<?php
/**
 * PHP library version: 1.1
 */
require_once('../lib/worldpay.php');

// This PHP file should be set as a webhook in the Worldpay settings page. It needs to be publicaly accessible
try {
    $notification = Worldpay::processWebhook();
} catch (WorldpayException $e) { // PHP 5.2 - Change to Exception
    // Failed to process the request. Worldpay will retry for up to 24 hours.
    header("HTTP/1.1 500 Internal Server Error");
    exit;
}

$worldpayOrderCode = $notification['orderCode'];
// TODO: Check the order code

if ($notification['paymentStatus'] === 'SUCCESS') {
    // The order is successful
} elseif ($notification['paymentStatus'] === 'REFUNDED') {
    // The order has been refunded
} elseif ($notification['paymentStatus'] === 'FAILED') {
    // The order has failed
} elseif ($notification['paymentStatus'] === 'SETTLED') {
    // The order has been settled
} elseif ($notification['paymentStatus'] === 'CHARGED_BACK') {
    // The order has been charged back
} elseif ($notification['paymentStatus'] === 'INFORMATION_REQUESTED') {
    // Information requested about the order
} elseif ($notification['paymentStatus'] === 'INFORMATION_SUPPLIED') {
    // Information has been supplied about the order
} elseif ($notification['paymentStatus'] === 'CHARGEBACK_REVERSED') {
    // The order's charge back has been reversed
}
