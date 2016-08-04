All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$api = new \PHPLicengine\Service\Product($base_url, $api_key);
```

#### GET /product/{product_id} - Get Product Info by id (v2.?.?)

e.g. http://www.mysite.com/phplicengine/api/product/1

Service method:
```php
$response = $api->getProductById(1);
```

Sample:

```php
use PHPLicengine\Service\Product;
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api_key = "API key goes here";
try {
     $api = new Product ($base_url, $api_key);
     $response = $api->getProductById(1);
     if ($response->isError()) { // if response of api has error
         print($response->getErrorMessage());
     } else {
         // $dataAsObject = $response->getDecodedJson();
         // echo $dataAsObject->username;
         // echo $response->getReference();
         print_r($response->getJsonAsArray());
     }
} catch (\Exception $e) {
     echo $e->getMessage();
}
```

#### GET /product/name/{name} - Get Product Info by name (v2.?.?)

Service method:
```php
$response = $api->getProductByName($name);
```
