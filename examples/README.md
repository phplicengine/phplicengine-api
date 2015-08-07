# API

## Contents
* [Client service](https://github.com/phplicengine/phplicengine-api/blob/master/examples/client.md)
* [Upload Files](#upload_files)
* [Custom cURL Options](#custom-curl-options)

## Usage
You can use this API library for any needs, not necessarily for PHPLicengine API. To do so, you should call Api class directly or implement your own service class. You can call [setApiKeyVar() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Api.php#L67) of Api class to change the Api key header variable according to requirements of your Api server, and [setValidResponseHeader() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L106) of Result class, if your Api server returns a response Api header, and you need to get it. You can get it with [getReference() method] (https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L116). By default these are setup according to requirements of PHPLicengine API.

You can directly call Api class for your PHPLicengine API, but for your convenience we've created service classes that you can call them instead of Api class, for example see [Client service](https://github.com/phplicengine/phplicengine-api/blob/master/examples/client.md) class. 

## Custom cURL Options
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

## Upload Files

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
