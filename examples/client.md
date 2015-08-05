All API URLs listed here must be prefixed by the root API URL, such as http://www.mysite.com/phplicengine/api

Service class:
```php
$api = new \PHPLicengine\Service\Client($base_url, $api_key);
```

#### * GET /client/{client_id} - Get Client Info by id

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
$api = new Client ($base_url, $api_key);
$response = $api->getClientById(1);

if (!$api->isCurlError()) { // checks for cURL error

    if ($response->isOk()) { // checks for Code:200

        if ($response->isValidResponse()) {

            if ($response->isError()) { // if response of api has error
                print($response->getErrorMessage());
            } else {
                // $dataAsObject = $response->getDecodedJson();
                // echo $dataAsObject->username;
                // echo $response->getContentType();
                print("<pre>");
                print_r($response->getJsonAsArray());
            }

        } else {
            print("Invalid PHPLicengine response.");
        }

    } else { // response code is not 200:Ok
        die("Error ".$response->getResponseCode()." : ".$response->getReasonPhrase());
    }
    
} else { // api curl Error happens.
    
        die("Curl Connection: ".$api->getCurlErrno()." : ".$api->getCurlError());
}

```

#### * GET /client/email/{email} - Get Client Info by email

Service method:
```php
$response = $api->getClientByEmail($email);
```

#### * GET /client/username/{username} - Get Client Info by username

Service method:
```php
$response = $api->getClientByUsername($username);
```
