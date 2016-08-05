All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$api = new \PHPLicengine\Service\Order($base_url, $api_key);
```

#### POST /order/add - Add Order (v2.?.?)

e.g. http://www.mysite.com/phplicengine/api/order/add

Service method:
```php
$order['clientId'] = 1; // required.
$order['orderItems'][]['productId'] = 2; // required.

$postvars['payType'] = "PayPal"; // optional.
$postvars['amount'] = 10.00; // optional. will be set as 00.00 if missing.
$postvars['referer'] = $_COOKIE['jamcom']; // optional'
$postvars['coupon'] = "SOMETHING"; // optional.

$response = $api->addOrder($order);
```

Sample:

```php
use PHPLicengine\Service\Product;
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api_key = "API key goes here";
try {
     $api = new Product ($base_url, $api_key);
     $response = $api->addOrder($order);
     if ($response->isError()) { // if response of api has error
         print($response->getErrorMessage());
     } else {
         // $dataAsObject = $response->getDecodedJson();
         // echo $response->getReference();
         print_r($response->getJsonAsArray());
     }
} catch (\Exception $e) {
     echo $e->getMessage();
}
```

#### POST /order/change/status - Change Order Status (v2.?.?)

Service method:
```php
$response = $api->changeOrderStatus($id, $status);
```
