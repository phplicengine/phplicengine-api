All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$api = new \PHPLicengine\Service\Client($base_url, $api_key);
```

#### GET /client/{client_id} - Get Client Info by id (v2.1.0)

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
         // echo $response->getReference();
         print_r($response->getJsonAsArray());
     }
} catch (\Exception $e) {
     echo $e->getMessage();
}
```

#### GET /client/email/{email} - Get Client Info by email (v2.1.0)

Service method:
```php
$response = $api->getClientByEmail($email);
```

#### GET /client/username/{username} - Get Client Info by username (v2.1.0)

Service method:
```php
$response = $api->getClientByUsername($username);
```

#### GET /client/usergroup/{id} - Get Clients Info by usergroup (v2.1.0)

Service method:
```php
$response = $api->getClientsByUsergroup(1);
```

#### GET /client/status/{id} - Get Clients Info by status (v2.1.0)
0 = pending, 1 = active, 2 = cancel, 3 = fraud

Service method:
```php
$response = $api->getClientsByStatus("fraud");
```
