<?php

// Api.php
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

class Api {

           protected $_timeout = 30;
           protected $_verify_ssl = true;
           protected $_verify_host = 2;
           protected $curlErrno = false;
           protected $curlError = false;

        protected $reasonPhrases = array(
        // INFORMATIONAL CODES
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        // SUCCESS CODES
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-status',
        208 => 'Already Reported',
        // REDIRECTION CODES
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',
        // CLIENT ERROR
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Large',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        // SERVER ERROR
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        511 => 'Network Authentication Required',
    );


           public function __construct($api_key = null) 
 	   { 
                  if (!function_exists('curl_init')) { 
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

           public function call($url, $params = "", $headers = "", $method = "GET") 
           {
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
                  curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->_verify_ssl);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->_verify_host);
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
                      $headers[] = 'X-API-Key: '.$this->_api_key;
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
                  return new Result($this->response);
           }

           public function getResponseCode()
           {
                  return $this->curlInfo['http_code'];
           }

           public function getContentType()
           {
                  return $this->curlInfo['content_type'];
           }

           public function getReasonPhrase()
           {
                  return $this->reasonPhrases[$this->curlInfo['http_code']];
           }

           public function isOk() 
           {
                  return $this->curlInfo['http_code'] == 200;
           }

           public function isCurlError () {
                  return (bool)$this->curlErrno;
           }

           public function getCurlErrno () {
                  return $this->curlErrno;
           }

           public function getCurlError () {
                  return $this->curlError;
           }

           public function getHeaders()
           {
                  return $this->curlInfo['request_header'];
           }

           public function getCurlInfo()
           {
                  return $this->curlInfo;
           }
}

