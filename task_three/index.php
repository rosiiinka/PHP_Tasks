<?php

include_once '../vendor/bigcommerce/api/src/Bigcommerce/Api/Client.php';
include_once '../vendor/bigcommerce/api/src/Bigcommerce/Api/Connection.php';
include_once '../vendor/bigcommerce/api/src/Bigcommerce/Api/Filter.php';

use Bigcommerce\Api\Client as Bigcommerce;

$object = new \stdClass();
$object->client_id = '123456';
$object->client_secret = 'P$ssword123';
$object->redirect_uri = 'localhost/PHP-tasks/task_three/';
$object->code = $_REQUEST['code'];
$object->context = $_REQUEST['context'];
$object->scope = $_REQUEST['scope'];

$authTokenResponse = Bigcommerce::getAuthToken($object);

Bigcommerce::configure(array(
    'client_id' => '123456',
    'auth_token' => "test", //$authTokenResponse->access_token,
    'store_hash' => '5h79jw'
));

$customers = Bigcommerce::getCustomers(["email:in" => "@gmail.com"]);
print_r($customers);




//curl
$headers = array(
    "Content-Type: application/json",
    "Accept: application/json",
    "X-Auth-Client:123456",
    "X-Auth-Token: test"
);
$ch = curl_init("https://api.bigcommerce.com/stores/5h79jw/v2/customers?email:in=@gmail.com");
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$result = curl_exec($ch);
$http_status =  (string) curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "<pre>";
print_r($http_status);
print_r($result);


