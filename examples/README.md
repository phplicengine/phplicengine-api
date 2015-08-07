# API

## Contents
* [Client service](https://github.com/phplicengine/phplicengine-api/blob/master/examples/client.md)
* [File upload](https://github.com/phplicengine/phplicengine-api/blob/master/examples/FileUpload.md)

## Usage
You can directly call Api class for your PHPLicengine API, but for your convenience we've created service classes that you can call them instead of Api class, for example see [Client service](https://github.com/phplicengine/phplicengine-api/blob/master/examples/client.md) class. 

You can use this API library for any needs, not necessarily for PHPLicengine API. To do so, you should call Api class directly or implement your own service class. You can call [setApiKeyVar() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Api.php#L67) of Api class to change the Api key header variable according to requirements of your Api server, and [setValidResponseHeader() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L106) of Result class, if your Api server returns a response Api header, and you need to get it. You can get it with [getReference() method] (https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L116). By default these are setup according to requirements of PHPLicengine API.

