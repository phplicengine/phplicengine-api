[![Latest Stable Version](https://poser.pugx.org/phplicengine/phplicengine-api/v/stable)](https://packagist.org/packages/phplicengine/phplicengine-api)
[![Total Downloads](https://poser.pugx.org/phplicengine/phplicengine-api/downloads)](https://packagist.org/packages/phplicengine/phplicengine-api)

# API
PHPLicengine API

You can use this API library for any needs, not necessarily for PHPLicengine API. With PHPLicengine API library you can contact with any RESTApi server and receive response as json/xml and parse them.

## Contents
* [Usage](#usage)
* [Installation](#installation)
* [Sample](#sample)
* [Manual](#manual)
* [Changelog](#changelog)
* [License](#license)

## Usage
You can use this API library for any needs, not necessarily for PHPLicengine API. To do so, you should call Api class directly or implement your own service class. You can call [setApiKeyVar() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Api.php#L67) of Api class to change the Api key header variable according to requirements of your Api server, and [setValidResponseHeader() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L106) of Result class, if your Api server returns a response Api header, and you need to get it. You can get it with [getReference() method] (https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L116). By default these are setup according to requirements of PHPLicengine API.

You can directly call Api class for your PHPLicengine API, but for your convenience we've created service classes that you can call them instead of Api class, for example see [Client service](https://github.com/phplicengine/phplicengine-api/blob/master/examples/client.md) class. 

## Installation
Versioning is the same as PHPLicengine. For general usage you can install any version as desired. But if you want to use PHPLicengine service classes, you should install the same version as your PHPLicengine or lower if there is not the same version.

```
composer require phplicengine/phplicengine-api x.x.x
```

## Sample
```php

use PHPLicengine\Api\Api;

$api = new Api();

// If your RESTApi server requires an Api key header, you can pass it to constructor of Api class:
// $api = new Api("API key goes here.");
// $api->setApiKeyVar("X-RESTAapi-Key");

// SSL verification is enabled by default. You can use below to disable it.
// $api->disableSslVerification();
// You can use below to enable it again.
// $api->enableSslVerification();

// timeout is set to 30 by default. You can use below to change it if needed.
// $api->setTimeout(60);

// Sets the host:port of a proxy to be used by cURL. If this is not set,  
// no proxy is used. For example, $api->setCurlProxy('proxy.example.com:3128');  
// $api->setCurlProxy($proxy);  

// get(), post(), delete(), put(), patch() methods are available.
// first parameter is url, second is query as array, third is header as array.
// Only first parameter (i.e. $url) is required.
$response = $api->get($url, null, null);

// For debug purposes only:
// print_r($api->getCurlInfo());
// print_r($response->getHeaders());
// print($response->getBody());
// exit;

// for logging purposes only:
// print($api->getResponse());
// print_r($api->getRequest());
// print_r($response->getHeaders());
// print($response->getBody());

if (!$api->isCurlError()) { // checks for cURL error

    if ($response->isOk()) { // checks for Code:200
    
        // If your RESTApi server returns a particular header as a valid response, 
        // you can set here:
        $response->setValidResponseHeader("X-ApiServer-Response");
        
        // This checks if the valid response header above is available or not.
        if ($response->isValidResponse()) {

            if ($response->isError()) { // if response of api has error
                print($response->getErrorMessage());
            } else {
                // $dataAsObject = $response->getDecodedJson();
                // echo $dataAsObject->username;
                // echo $response->getContentType();
                // You can get X-ApiServer-Response header value like below:
                // echo $response->getReference();
                print("<pre>");
                print_r($response->getJsonAsArray());
            }

        } else {
            print("Invalid server response.");
        }

    } else { // response code is not 200:Ok
        die("Error ".$response->getResponseCode()." : ".$response->getReasonPhrase());
    }
    
} else { // api curl Error occurs.
    die("Curl Connection: ".$api->getCurlErrno()." : ".$api->getCurlError());
}
```

NOTE: Usually RESTApi servers return a json response with 'error' and ' message' elements if an error occurs.
If your RESTApi server returns another format, you'd need to customize [isError()](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L121) and [getErrorMessage()](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L126) methods in Result class.

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

## Changelog
New methods: (v2.x.x)
```php
// for logging purposes only:
print($api->getResponse());
print_r($api->getRequest());

// Sets the host:port of a proxy to be used by cURL. If this is not set,  
// no proxy is used. For example, $api->setCurlProxy('proxy.example.com:3128');  
$api->setCurlProxy($proxy); 
```
New methods: (v2.2.2)

Added `patch()` method.

## License
PHPLicengine Api is distributed under the Apache License. See [License](https://github.com/phplicengine/phplicengine-api/blob/master/LICENSE).

