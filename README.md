# API
PHPLicengine API

This code is still draft and not yet ready to use. Please do not download it yet.

## Usage

```php

use PHPLicengine\Api;

$api = new Api("API key goes here");

// SSL verification is enabled by default. You can use below to disable it.
// $api->disableSslVerification();
// You can use below to enable it again.
// $api->enableSslVerification();

// timeout is set to 30 by default. You can use below to change it if needed.
// $api->setTimeout(60);

// first parameter is url, second is query as array, third is header as array.
// Only first parameter (i.e. $url) is required.
// get(), post(), delete(), put() methods are available.
$response = $api->get($url, null, null);

// For debug purposes only:
// print_r($api->getCurlInfo());
// print_r($response->getHeaders());
// print($response->getBody());
// exit;

if ($api->isOk()) { // checks for Code:200

    if ($result->isValidResponse()) {

        if ($response->isError()) { // if response of api has error
            print($response->getErrorMessage());
        } else {
            // $dataAsObject = $response->getDecodedJson();
            // echo $dataAsObject->username;
            // echo $api->getContentType();
            print("<pre>");
            print_r($response->getJsonAsArray());
        }

    } else {
            print("Invalid PHPLicengine response.");
    }
    
} else { // api responseCode is not 200:OK

    if ($api->isCurlError()) {
        die("Curl Connection: ".$api->getCurlErrno()." : ".$api->getCurlError());
    } else {
        die("Error ".$api->getResponseCode()." : ".$api->getReasonPhrase());
    }
}
```
