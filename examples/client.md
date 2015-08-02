#### * Get Client Info by id

To get client info send a GET request to /client/{id}

e.g.

$url = "http://www.mysite.com/phplicengine/api/client/11";

Sample:

```php
use PHPLicengine\Service\Client;
$api = new Client ($base_url, $api_key);
$response = $api->getClientById(1);

if ($api->isOk()) { //checks for Code:200

    if ($response->isError()) { // if response of api has error
        print($response->getErrorMessage());
    } else {
        // $dataAsObject = $response->getJson();
        // echo $dataAsObject->username;
        // echo $api->getContentType();

        print("<pre>");
        print_r($response->getJsonAsArray());
    }

} else { // api responseCode is not 200:OK

    if ($api->isCurlError()) {
        die("Curl Connection: ".$api->getCurlErrno()." : ".$api->getCurlError());
    } else {
        die("Error ".$api->getResponseCode()." : ".$api->getReasonPhrase());
    }

}

```

#### * Get Client Info by email

#### * Get Client Info by username