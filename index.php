<?php

require 'vendor/autoload.php';
include 'src/Client.php';
include 'src/Util.php';
use HelmutSchneider\Swish\Client;
use HelmutSchneider\Swish\Util;


// Swish CA root cert
$rootCert = 'ca.crt'; // forwarded to guzzle's "verify" option

// .pem-bundle containing your client cert and it's corresponding private key. forwarded to guzzle's "cert" option
$clientCert = ['cl.pem', 'swish'];

$client = Client::make($rootCert, $clientCert);

$response = $client->createPaymentRequest([
    'callbackUrl' => 'https://localhost/swish',
    'payeePaymentReference' => '12345',
    'payerAlias' => '4671234768',
    'payeeAlias' => '1231181189',
    'amount' => '100',
    'currency' => 'SEK',
]);

$data = Util::decodeResponse($response);
var_dump($data);

//  Array
//  (
//      [errorCode] =>
//      [errorMessage] =>
//      [id] => 3F0CC97D3E7E4308AB357C506BCB0402
//      [payeePaymentReference] => 12345
//      [paymentReference] =>
//      [callbackUrl] => https://localhost/swish
//      [payerAlias] => 4671234768
//      [payeeAlias] => 1231181189
//      [amount] => 100
//      [currency] => SEK
//      [message] =>
//      [status] => CREATED
//      [dateCreated] => 2016-04-10T23:45:27.538Z
//      [datePaid] =>
//  )

?>