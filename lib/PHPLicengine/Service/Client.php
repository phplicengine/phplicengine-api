<?php

// Client.php
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

class Client extends \PHPLicengine\Api\Api {
 
      private $url;
      
      public function __construct ($base_url, $api_key = null)
      {
             parent::__construct($api_key);
             $this->url = $base_url.'/api';       

             if ($this->get($this->url.'/')->isValidResponse()) {
                 throw new ResponseException ("Invalid PHPLicengine URL.");
             }
      }
      
      public function getClientById ($clientId) 
      {
             return $this->get($this->url . '/client/' . intval($clientId));
      }

      public function getClientByUsername ($username) 
      {
             return $this->get($this->url . '/client/username/' . $username);
      }

      public function getClientByEmail ($email) 
      {
             return $this->get($this->url . '/client/email/' . $email);
      }
      
}
