All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api = new \PHPLicengine\Service\License($base_url, $api_key);
```

#### POST /license/add - Add New License (v2.2.1)

e.g. http://www.mysite.com/phplicengine/api/license/add

Service method:
```php
$orderItemId = 2; // required.
$response = $api->addLicense($orderItemId);
```

Sample:

```php
use PHPLicengine\Service\License;
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api_key = "API key goes here";
try {
     $api = new License ($base_url, $api_key);
     $response = $api->addLicense($orderItemId);
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

Response (if license type is remote):

```
Array
(
    [orderId] => 2
    [status] => 0
    [locked] => 0
    [domainName] => 
    [secureDomainName] => 
    [ip] => 
    [hostName] =>
    [serverIp] => 
    [directory] =>
    [licenseKey] => 0E64E718BD11A0A8289843A10ED4C9D8
    [brand] => 0
    [orderedOn] => 1470435858
    [expiryOn] => never
    [optVal1] => foo
    [optVal2] => bar
    [optVal3] => 
    [optVal4] => 
    [optVal5] => 
    [ip] => 
)
```

Response (if license type is ionCube):

```
Array
(
    [orderId] => 2
    [status] => 0
    [locked] => 0
    [domainName] => 
    [secureDomainName] => 
    [macinfo] => 
    [orderedOn] => 1470435945
    [expiryOn] => 1470597052
    [optVal1] => 
    [optVal2] => 
    [optVal3] => 
    [optVal4] => 
    [optVal5] => 
    [ip] => 
)
```

#### POST /license/change/status - Change License Status (v2.2.1)

0 = pending, 1 = active

Service method:
```php
$response = $api->changeLicenseStatus($orderItemId, "active");
```

Respnse:
```
{"message":"success"}
```

#### GET /license/{orderItemId} - Get License Info (v2.2.1)

Service method:
```php
$response = $api->getLicense($orderItemId);
```

Respnse:
```
sample below is for remote license. It will be different for other license types.
(
    [licenseInfo] => Array
        (
            [productId] => 2
            [licFilename] => license.dat
            [brand] => 0
            [licPrefix] => prefix_
            [licAsFile] => 0
            [domain] => 1
            [ip] => 0
            [hostName] => 1
            [serverIp] => 1
            [directory] => 1
            [optVar1] => 
            [optVal1] => 
            [optVar2] => 
            [optVal2] => 
            [optVar3] => 
            [optVal3] => 
            [optVar4] => 
            [optVal4] => 
            [optVar5] => 
            [optVal5] => 
        )
    [license] => Array
        (
            [orderId] => 115
            [status] => 0
            [locked] => 0
            [domainName] => 
            [secureDomainName] => 
            [ip] => 
            [hostName] => 
            [serverIp] => 
            [directory] => 
            [licenseKey] => prefix_5B8FA6E4C94C06D69BEF401DD062D217
            [brand] => 0
            [orderedOn] => 1470435024
            [expiryOn] => never
            [optVal1] => 
            [optVal2] => 
            [optVal3] => 
            [optVal4] => 
            [optVal5] => 
        )
)


```
