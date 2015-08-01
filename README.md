# API
PHPLicengine API

This code is still draft and not yet ready to use. Please do not download it yet.

## Usage

```php

use PHPLicengine\Api;

$request = new Api("API key goes here");

// SSL verification is enabled by default. You can use below to disable it.
// $request->disableSslVerification();
// You can use below to enable it again.
// $request->enableSslVerification();

// timeout is set to 30 by default. You can use below to change it if needed.
// $request->setTimeout(60);

// first parameter is url, second is query as array, third is header as array, fourth is method
// valid methods: PUT, DELETE, POST, GET. default value is GET.
// Only first parameter (i.e. $url) is required.
$result = $request->call($url, null, null, "GET");

// For debug purposes only:
// print($request->getHeaders());
// print_r($request->getCurlInfo());
// print($result->getBody());
// exit;

if ($request->isOk()) { //checks for Code:200

    if($result->isError()) { // if response of api has error
        print($result->getErrorMessage());
    } else {
        // $dataAsObject = $result->getJson();
        // echo $dataAsObject->username;
        // echo $request->getContentType();
        
        print("<pre>");
        print_r($result->getJsonAsArray());
    }

} else { // api responseCode is not 200:OK

    if ($request->isCurlError()) {
        die("Curl Connection: ".$request->getCurlErrno()." : ".$request->getCurlError());
    } else {
        die("Error ".$request->getResponseCode()." : ".$request->getReasonPhrase());
    }

}
```
