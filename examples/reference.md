All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$api = new \PHPLicengine\Service\Reference($base_url, $api_key);
```

#### GET /reference/{reference} - Get API Log by reference (v2.2.1)

e.g. http://www.mysite.com/phplicengine/api/reference/20160807_04be5tuh

Service method:
```php
$response = $api->getReference($reference);
```

Sample:

```php
use PHPLicengine\Service\Reference;
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api_key = "API key goes here";
try {
     $api = new Reference ($base_url, $api_key);
     $response = $api->getReference($reference);
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
    [timestamp] => 1470597839
    [ip] => 198.20.238.70
    [path] => /client/add
    [request] => a:22:{s:2:"ip";s:13:"127.0.0.1";s:8:"username";s:9:"xxxxxx";s:8:"password";s:8:"password";s:5:"email";s:24:"test@example.com";s:9:"firstName";s:5:"first";s:8:"lastName";s:4:"last";s:5:"addr1";s:4:"last";s:5:"addr2";s:4:"last";s:8:"stchoice";s:1:"2";s:6:"state";s:4:"last";s:7:"country";s:2:"us";s:5:"phone";s:8:"12345678";s:11:"countrYCode";s:1:"1";s:3:"fax";s:8:"12345678";s:3:"zip";s:8:"12345678";s:2:"id";s:2:"92";s:6:"status";s:1:"0";s:12:"usergroup_id";s:1:"1";}
    [response] => {
    "error": true,
    "message": [
        "EMAIL_TAKEN",
        "USERNAME_TAKEN"
    ]
}
)
```
