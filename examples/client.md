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

#### POST /client/change/status - Change Client Status (v2.2.1)

0 = pending, 1 = active, 2 = cancel, 3 = fraud

Service method:
```php
$response = $api->changeClientStatus($clientId, "active");
```

Respnse:
```
{"message":"success"}
```

#### POST /client/add - Add New Client (v2.2.1)


Service method:
```php
// Required:
$client['username'] = "";
$client['password'] = ""; // might be plain, md5() or password_hash().
$client['email'] = "";
$client['firstName'] = "";
$client['lastName'] = "";
$client['usergroup_id'] = "1";

$client['ip'] = ""; // recommended.

// Followings may or may not be required depending on your Settings -> Form Settings
$client['addr1'] = "";
$client['addr2'] = "";
$client['company'] = "";
$client['stchoice'] = ""; // 1 = US/CA states, 2 = non-US/CA states
$client['state'] = "";
$client['country'] = "us"; // 2-digits ISO
$client['phone'] = "";
$client['countryCode'] = "";
$client['fax'] = "";
$client['zip'] = "";
$client['custom1'] = "";

$response = $api->addClient($client);
```
