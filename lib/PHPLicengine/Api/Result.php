<?php

// Result.php
#################################################
## PHPLicengine
##
## Homepage: http://www.phplicengine.com
#################################################
## COPYRIGHT NOTICE
## Copyright 2007-{current_year} PHPLicengine.com. All Rights Reserved.
##
## This script may be only used in accordance to the license agreement
## attached (/docs/license.htm). This copyright notice and the comments
## above and below must remain intact at all times.
##
## Selling the code for this program is expressly forbidden and in violation
## of Domestic and International copyright laws.
#################################################

namespace PHPLicengine\Api;

class Result {

      protected $error;
      protected $message;

      public function __construct($data) {

             $this->data = $data;

     }

     public function isError () {

            return isset($this->getJson()->error) && $this->getJson()->error;

     }

     public function getErrorMessage () {

            return $this->getJson()->message;

     }

     public function getBody()

     {

            return $this->data;

     }

     public function getJson () {

            return json_decode($this->data);

     }

     public function getJsonAsArray () {

            return json_decode($this->data, true);

     }

}

