<?php

// Reference.php
#################################################
## PHPLicengine
##
## Homepage: http://www.phplicengine.com
#################################################
## Copyright 2009-{current_year} PHPLicengine
## 
## Licensed under the Apache License, Version 2.0 (the "License");
## you may not use this file except in compliance with the License.
## You may obtain a copy of the License at
##
##    http://www.apache.org/licenses/LICENSE-2.0
##
## Unless required by applicable law or agreed to in writing, software
## distributed under the License is distributed on an "AS IS" BASIS,
## WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
## See the License for the specific language governing permissions and
## limitations under the License.
#################################################

namespace PHPLicengine\Service;
use PHPLicengine\Exception\ResponseException;
use PHPLicengine\Exception\CurlException;

class Reference extends \PHPLicengine\Api\Api {
 
      private $url;
      
      public function __construct ($base_url, $api_key)
      {
             parent::__construct($api_key);
             $this->url = $base_url.'/api';       

             $response = $this->get($this->url.'/index.php');
             if (!$this->isCurlError()) {
                 if ($response->isOk()) {
                     if (!$response->isValidResponse()) {
                         throw new ResponseException ("Invalid PHPLicengine URL.");
                     }
                 } else {
                     throw new ResponseException ("Error ".$response->getResponseCode()." : ".$response->getReasonPhrase());
                 }
             } else {
                 throw new CurlException ("Curl Connection: ".$this->getCurlErrno()." : ".$this->getCurlError());
             }
      }
      
      public function getReference ($reference) 
      {
             return $this->get($this->url . '/reference/'. $reference);
      }
}
