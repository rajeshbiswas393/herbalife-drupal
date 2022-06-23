<?php
    namespace BPOINT {
        class RequestSender {
            private static $userAgent = "Premier.Billpay.API.BPOINT.PHP-V1.0";
            private static $timeout = 100000;
            
            public static function setUserAgent($userAgent) {
                self::$userAgent = $userAgent;
            }
            
            public static function setTimeout($timeout) {
                self::$timeout = $timeout;
            }
            
            public static function send($url, $authString, $payload, $method) {
                $jsonPayload = NULL;
                $request = NULL;
                
                switch ($method) {
                    case "POST":
                        $request = \Httpful\Request::post($url);
                        break;
                    case "GET":
                        $request = \Httpful\Request::get($url);
                        break;
                    case "PUT":
                        $request = \Httpful\Request::put($url);
                        break;
                    case "DELETE":
                        $request = \Httpful\Request::delete($url);
                        break;
                }
                
                if (NULL !== $payload && TRUE === is_array($payload)) {
                    $jsonPayload = json_encode($payload);
                    $request->sendsJson()->body($jsonPayload);
                }
                
                if (NULL !== self::$userAgent) {
                    $request->addHeader("User-Agent", self::$userAgent);	
                }
                $request->timeout((int) ceil(self::$timeout / 1000));
    
                
                $response = $request->addHeader("Authorization", $authString)->send();
                $responsePayload = $response->body;
                            
                return $responsePayload;
            }
            
            
        }
        
        class URLDirectory {
            private static $uat;
            private static $live;
            public static function setBaseURL($uaturl,$liveurl){
                self::$uat 	= $uaturl;
                self::$live	= $liveurl;
            }
            public static function getBaseURL($mode) {
                $retval = "";
                if (Mode::Live === $mode) {
                    $retval = self::$live;
                } else if (Mode::UAT === $mode) {
                    $retval = self::$uat;
                } else {
                    //Default to live URL
                    $retval = self::$live;
                }
                
                return $retval;
            }
        }
        
        class WebHookConsumer {
            public static function consumeTransaction($hook) {
                $payload = new \stdClass();
                $payload->APIResponse = new \stdClass();
                $payload->APIResponse->ResponseCode = "0";
                $payload->APIResponse->ResponseText = "";
                $payload->TxnResp = json_decode($hook);
                return (new TransactionResponse($payload));
            }
            
            public static function consumeToken($hook) {
                $payload = new \stdClass();
                $payload->APIResponse = new \stdClass();
                $payload->APIResponse->ResponseCode = "0";
                $payload->APIResponse->ResponseText = "";
                $payload->DVTokenResp = json_decode($hook);
                return (new TokenResponse($payload));
            }
        }
    }
