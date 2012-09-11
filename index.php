<?php
@include_once("config.inc.php");

$appid = "";                                                                                                              
$appsecret = '';                                                                                         
$canvas_page = "";                                                                                    
require 'fb/facebook.php';                                                                                                               
$facebook = new Facebook(array(                                                                                                          
			       'appId'  => '',                                                                             
			       'secret' => '', 																 ));                                                                                                        





function loginFB() {
  if(!$facebook->getUser()) header("Location:".$facebook->getLoginUrl(array(
									    'scope' => 'publish_stream'
                                                                            )));
}

function postOnWallWithoutAccess($link,$message) {
  
  try {                                                                                                                                   
    $ret_obj = $facebook->api('/me/feed', 'POST',                                                                                            			      array(                                                                                                         				    'link' => $link,                                                               
				 'message' => $message                                                                             
				 ));
  } catch(FacebookApiException $e) {                                                                                                          $login_url = $facebook->getLoginUrl( array(                                                                                                             'scope' => 'publish_stream'                                                                                         
			      ));                                                                                           
    echo 'Please <a href="' . $login_url . '">login.</a>';                                                                                    error_log($e->getType());                                                                                                                 error_log($e->getMessage());                                                                                                                                                                                                                           
  }                                                                                                                                        




}

function init() {
  if(!$facebook->getUser()) loginFB();    
  

} 