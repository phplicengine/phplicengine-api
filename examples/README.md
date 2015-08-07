# API

## Contents
* [Client service](https://github.com/phplicengine/phplicengine-api/edit/master/examples/Client.md)
* [File upload](https://github.com/phplicengine/phplicengine-api/edit/master/examples/FileUpload.md)

## Usage
You can directly call Api class for your PHPLicengine api, but for your convenience we've created service classes that you can call them instead of Api class, for example see [Client service](https://github.com/phplicengine/phplicengine-api/edit/master/examples/Client.md) class. 

You can use this API library for any needs, not necessarily for PHPLicengine API. To do so, you should call Api class directly or implement your own service class. You can call [setApiKeyVar() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Api.php#L67) of Api class to change the api key header variable according to requirements of your Api server, and [setValidResponseHeader() method](https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L106) of Result class, if your api server returns a response api header, and you need to get it. You can get it with [getReference() method] (https://github.com/phplicengine/phplicengine-api/blob/master/lib/PHPLicengine/Api/Result.php#L116). By default these are setup according to requirements of PHPLicengine Api.

