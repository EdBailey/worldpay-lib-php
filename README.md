# Worldpay PHP Library

#### Documentation
https://developer.worldpay.com/docs

#### API Reference
https://developer.worldpay.com/api-reference

### Examples
The examples require editing to support PHP 5.2, please see the note at the end of this readme.  

#### index.html
Uses WorldpayJS to generate a token that is posted to create_order.php.  
**Change your client key on line 142**

#### create_order.php
Creates a Worldpay order with a posted token.  
**Change your service key on line 5**

#### refund.html
Enter your Worldpay order code and posts it to refund_order.php  

#### refund_order.php
Refunds a Worldpay order with a posted order code   
**Change your service key on line 5**  

#### stored_cards.html
Enter your Worldpay reusable token and posts it to stored_cards.php  

#### stored_cards.php
Shows stored card details from posted token  
**Change your service key on line 5** 

#### webhook.php
Processes Worldpay webhooks into an array

### Requirements

PHP 5.2+  
Curl

### PHP 5.2
PHP 5.2 and below do not support extended exceptions. The library will return a standard exception in these versions. This means you will need to change the try catch, to catch on 'Exception' instead of 'WorldpayException'. The methods 'getHttpStatusCode', 'getCustomCode' and 'getDescription' will also not be available.  

If you are using the examples, you will need to edit them, please see the in file comments referencing PHP 5.2.
