#### * Get Client Info by id

To get client info send a GET request to /client/{id}

e.g.

$url = "http://www.mysite.com/phplicengine/api/client/11";

Sample:

```php
use PHPLicengine\Service\Client;
$client = new Client ($base_url, $api_key);
$response = $client->getClientById(1);

if ($response->getApi()->isOk()) { //checks for Code:200

    if ($response->isValidResponse()) {
    
        if ($response->isError()) { // if response of api has error
            print($response->getErrorMessage());
        } else {
            // $dataAsObject = $response->getJson();
            // echo $dataAsObject->username;
            // echo $response->getApi()->getContentType();
            print("<pre>");
            print_r($response->getJsonAsArray());
        }
    
    } else {
        print("Invalid PHPLicengine response.");
    }
    
} else { // api responseCode is not 200:OK

    if ($response->getApi()->isCurlError()) {
        die("Curl Connection: ".$response->getApi()->getCurlErrno()." : ".$response->getApi()->getCurlError());
    } else {
        die("Error ".$response->getApi()->getResponseCode()." : ".$response->getApi()->getReasonPhrase());
    }

}

```

#### * Get Client Info by email

#### * Get Client Info by username
