<?php

// Result.php
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

namespace PHPLicengine\Api;

class Result {

      protected $error;
      protected $message;
      protected $headers;
      protected $validResponseHeader = 'x-phplicen-response';

      public function __construct($body, $headers) 
      {
             $this->body = $body;
             $this->headers = $headers;
      }

      public function isValidResponse () 
      {
             return isset($this->headers[$this->validResponseHeader]) && (bool) $this->headers[$this->validResponseHeader];
      }

      public function isError () 
      {
             return isset($this->getJson()->error) && $this->getJson()->error;
      }
     
      public function getErrorMessage () 
      {
             return $this->getJson()->message;
      }

      public function getBody()
      {
             return $this->body;
      }

      public function getJson () 
      {
             return json_decode($this->body);
      }

      public function getJsonAsArray () 
      {
             return json_decode($this->body, true);
      }

}
