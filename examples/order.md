All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api = new \PHPLicengine\Service\Order($base_url, $api_key);
```

#### POST /order/add - Add New Order (v2.2.1)

e.g. http://www.mysite.com/phplicengine/api/order/add

Service method:
```php
$order['clientId'] = 1; // required.
$order['orderItems'][]['productId'] = 2; // required.

$order['payType'] = "PayPal"; // optional.
$order['amount'] = 10.00; // optional. will be set as 00.00 if missing.
$order['referer'] = $_COOKIE['jamcom']; // optional.
$order['coupon'] = "SOMETHING"; // optional.

$response = $api->addOrder($order);
```

Sample:

```php
use PHPLicengine\Service\Order;
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api_key = "API key goes here";
try {
     $api = new Order ($base_url, $api_key);
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

Response:

```
Array
(
    [orderItems] => Array
        (
            [0] => Array
                (
                    [id] => 
                    [orderId] => 
                    [productId] => 
                    [setupFee] => 
                    [amount] => 
                    [tp1] => 
                    [term] => 
                    [supportPeriod] => 
                    [status] => 
                    [lastRenewalDate] => 
                    [nextRenewalDate] => 
                    [nextInvoiceDate] => 
                )
        )
    [order] => Array
        (
            [id] => 
            [orderId] => 
            [clientId] => 
            [orderedOn] => 
            [payType] => 
            [amount] => 
            [status] => 
            [referer] => 
            [coupon] => 
            [note] => 
        )
)
```

#### POST /order/change/status - Change Order Status (v2.2.1)

0 = pending, 1 = active, 2 = expired, 3 = cancel

Service method:
```php
$response = $api->changeOrderStatus($id, "active");
```

#### GET /order/{orderId} - Get Order Info By Id (v2.2.1)

Service method:
```php
$id = 825074690149;
$response = $api->getOrder($id);
```

Response:

```
Array
(
    [id] => 102
    [orderId] => 825074690149
    [clientId] => 1
    [orderedOn] => 1470429003
    [payType] => 
    [amount] => 50.000
    [status] => 0
    [referer] => 
    [coupon] => 
    [note] => 
    [orderItems] => Array
        (
            [0] => Array
                (
                    [id] => 115
                    [orderId] => 102
                    [productId] => 2
                    [setupFee] => 0.00
                    [amount] => 1.000
                    [tp1] => 0
                    [term] => never
                    [supportPeriod] => 1501965004
                    [status] => 0
                    [lastRenewalDate] => 1470429003
                    [nextRenewalDate] => never
                    [nextInvoiceDate] => 
                )
        )
)
```
