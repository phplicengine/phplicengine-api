All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$api = new \PHPLicengine\Service\Client($base_url, $api_key);
```

#### GET /client/{client_id} - Get Client Info by id

e.g. http://www.mysite.com/phplicengine/api/client/1

Service method:
```php
$response = $api->getClientById(1);
```

Sample:

```php
use PHPLicengine\Service\Client;
$base_url = "http://www.mysite.com/phplicengine"; // no trailing slash!
$api_key = "API key goes here";
try {
     $api = new Client ($base_url, $api_key);
     $response = $api->getClientById(1);
     if ($response->isError()) { // if response of api has error
        print($response->getErrorMessage());
     } else {
        // $dataAsObject = $response->getDecodedJson();
        // echo $dataAsObject->username;
        // echo $response->getContentType();
        print("<pre>");
        print_r($response->getJsonAsArray());
     }
} catch (\PHPLicengine\Exception\ResponseException $e) {
    echo $e->getMessage();
}


```

#### GET /client/email/{email} - Get Client Info by email

Service method:
```php
$response = $api->getClientByEmail($email);
```

#### GET /client/username/{username} - Get Client Info by username

Service method:
```php
$response = $api->getClientByUsername($username);
```
