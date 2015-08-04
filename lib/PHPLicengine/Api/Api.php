<?php

// Api.php
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

class Api {

           protected $_api_key_var = 'X-API-Key';
           protected $_timeout = 30;
           protected $_verify_ssl = true;
           protected $_verify_host = 2;
           protected $curlErrno = false;
           protected $curlError = false;

           public function __construct($api_key = null) 
           { 
                  if (!function_exists('curl_init')) 
                  { 
                      throw new Exception("cURL is not available. This API wrapper cannot be used."); 
                  } 
                  $this->setApiKey($api_key);
           }

           public function enableSslVerification() 
           { 
 		  $this->_verify_ssl = true; 
 		  $this->_verify_host = 2; 
           } 
  
           public function disableSslVerification() 
           { 
 	 	  $this->_verify_ssl = false; 
 		  $this->_verify_host = 0; 
           } 

           public function setTimeout($timeout) 
           { 
 	 	  $this->_timeout = $timeout; 
           } 

           public function setApiKey($api_key) 
           { 
                  $this->_api_key = $api_key; 
           } 

           private function _call($url, $params = null, $headers = null, $method = "GET") 
           {
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
                  curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->_verify_ssl);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->_verify_host);
                  curl_setopt($ch, CURLOPT_HEADER, 1);
                  curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
                  switch (strtoupper($method)) { 
                          case 'PUT':
                          case 'DELETE':
                                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
                                      curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                          break;
                          case 'POST':
                                      curl_setopt($ch, CURLOPT_POST, true);
                                      curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                          break;
                          case 'GET':
                                     curl_setopt($ch, CURLOPT_HTTPGET, true);
                                     if (!empty($params)) {
                                         $url .= '?' . http_build_query($params);
                                         curl_setopt($ch, CURLOPT_URL, $url);
                                     }
                          break;
                  }

                  if (!empty($this->_api_key)) {
                      $headers[] = $this->_api_key_var.': '.$this->_api_key;
                  }
                  if (!empty($headers)) {
                      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  }

                  $this->response = curl_exec($ch);
                  if (curl_errno($ch)) {
                      $this->curlErrno = curl_errno($ch);
                      $this->curlError = curl_error($ch);
                      curl_close($ch);
                      return;
                  }
                  $this->curlInfo = curl_getinfo($ch);
                  curl_close($ch);
                  return new Result($this->_getBody(), $this->_getHeaders(), $this->curlInfo);
           }

           private function _parseHeaders($raw_headers) 
           {
                   if (!function_exists('http_parse_headers')) {
                       $headers = array();
                       $key = '';

                       foreach(explode("\n", $raw_headers) as $i => $h) {
                               $h = explode(':', $h, 2);

                               if (isset($h[1])) {
                                   if (!isset($headers[$h[0]]))
                                       $headers[$h[0]] = trim($h[1]);
                                   elseif (is_array($headers[$h[0]])) {
                                           $headers[$h[0]] = array_merge($headers[$h[0]], array(trim($h[1])));
                                   }
                                   else {
                                         $headers[$h[0]] = array_merge(array($headers[$h[0]]), array(trim($h[1])));
                                   }
                                   $key = $h[0];
                               }
                               else { 
                                     if (substr($h[0], 0, 1) == "\t")
                                         $headers[$key] .= "\r\n\t".trim($h[0]);
                                     elseif (!$key) 
                                         $headers[0] = trim($h[0]); 
                               }
                       }
                       return $headers;
                      
                   } else {
                       return http_parse_headers($raw_headers);
                   } 
           }

           private function _getHeaders()
           {
                  return $this->_parseHeaders(substr($this->response, 0, $this->curlInfo['header_size']));
           }

           private function _getBody()
           {
                  return substr($this->response, $this->curlInfo['header_size']);
           }

           public function get($url, $params = null, $headers = null) 
           {
                  return $this->_call($url, $params, $headers, $method = "GET")      
           }
           
           public function post($url, $params = null, $headers = null) 
           {
                  return $this->_call($url, $params, $headers, $method = "POST")      
           }

           public function delete($url, $params = null, $headers = null) 
           {
                  return $this->_call($url, $params, $headers, $method = "DELETE")      
           }

           public function put($url, $params = null, $headers = null) 
           {
                  return $this->_call($url, $params, $headers, $method = "PUT")      
           }

           public function getCurlInfo()
           {
                  return $this->curlInfo;
           }

           public function isCurlError () {
                  return (bool) $this->curlErrno;
           }

           public function getCurlErrno () {
                  return $this->curlErrno;
           }

           public function getCurlError () {
                  return $this->curlError;
           }

}
