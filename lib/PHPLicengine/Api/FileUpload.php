<?php

// FileUpload.php
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

class FileUpload {

      protected $_file;

      public function __construct($filename)
      {
             $this->_filename = $filename;
      }

      public function getCurlFileObject() 
      {
             if (!file_exists($this->_filename) || !is_readable($this->_filename)) {
                 throw new \Exception ("Could not read $this->_filename to upload.");
             }
             return new \CURLFile($this->getFilename(), $this->getType());
      } 

      public function getFilename()
      {
             if (strpos($this->_filename, '/') !== false || strpos($this->_filename, '\\') !== false) {
                 return basename($this->_filename);
             } else {
                return $this->_filename;
             }
      }

      public function getType()
      {
             $finfo = new \finfo(FILEINFO_MIME_TYPE);
             return $finfo->file($this->_filename);
      }

}

