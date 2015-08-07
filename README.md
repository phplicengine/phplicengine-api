# API
PHPLicengine API

You can use this API library for any needs, not necessarily for PHPLicengine API.

## Contents
* [Installation](#installation)
* [Usage](#usage)
* [Sample](#sample)
* [Manual](#manual)
* [License](#license)

## Installation
Versioning is the same as PHPLicengine. You should install the same version as your PHPLicengine or lower if there is not the same version.
```
composer require phplicengine/phplicengine-api x.x.x
```

## Usage
You can use this API library for any needs, not necessarily for PHPLicengine API. To do so, you should call Api class directly or implement your own service class. You can call [setApiKeyVar() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Api.php#L67) of Api class to change the Api key header variable according to requirements of your Api server, and [setValidResponseHeader() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L106) of Result class, if your Api server returns a response Api header, and you need to get it. You can get it with [getReference() method] (https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L116). By default these are setup according to requirements of PHPLicengine API.

You can directly call Api class for your PHPLicengine API, but for your convenience we've created service classes that you can call them instead of Api class, for example see [Client service](https://github.com/phplicengine/phplicengine-api/blob/master/examples/client.md) class. 

## Sample
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

## Manual

#### Custom cURL Options
If you need to add some CURLOPT_* constants that are not enabled by default, you can call setCurlCallback() method to add them.

```php
use PHPLicengine\Api\Api;
$api = new Api();
$api->setCurlCallback(function($ch, $params, $headers, $method) { 
      curl_setopt($ch, CURLOPT_USERAGENT, 'some agent'); 
      curl_setopt($ch, CURLOPT_COOKIE, 'foo=bar'); 
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
      curl_setopt($ch, CURLOPT_USERPWD, "username:password");
}); 
$api->post($url, $params, $headers);
```

#### Upload Files
You can upload files with POST method and with this array structure as post parameter. Note that 'filename' must be absolute path to file.

```php
Array
(
    [files] => Array
        (
            [0] => Array
                (
                    [filename] => /path/to/file1.txt
                )
            [1] => Array
                (
                    [filename] => /path/to/file2.txt
                )
        )
    [foo] => bar
)
```

#### Service Classes
For service classes usage, See [here](https://github.com/phplicengine/phplicengine-api/tree/master/examples).

## License
PHPLicengine Api is distributed under the Apache License. See [License](https://github.com/phplicengine/phplicengine-api/blob/master/LICENSE).

