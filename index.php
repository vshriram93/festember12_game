<?php
@include_once("config.inc.php");

$canvas_page = "";                                                                                    
require 'fb/facebook.php';                                                                                                               
$facebook = new Facebook(array(                                                                                                          
			       'appId'  => APP_ID,                                                                             
			       'secret' => APP_SECRET, 									
	     	));


function loginFB() {
  global $facebook;
  print_r($facebook);
  if(!$facebook->getUser()) header("Location:".$facebook->getLoginUrl(array(
									    'scope' => 'publish_stream'
                                                                            )));
  exit();

}

function postOnWallWithoutAccess($link,$message) {
  global $facebook;
 
  try {                                                                                                                                   
    $ret_obj = $facebook->api('/me/feed', 'POST',   
			      array(
				    'link' => $link,
				    'message' => $message                                                                             
				    ));
  } catch(FacebookApiException $e) 
      { 
	$login_url = $facebook->getLoginUrl(array('scope' => 'publish_stream' )); 
	echo 'Please <a href="' . $login_url . '">login.</a>';  error_log($e->getType()); error_log($e->getMessage());
      }
}

function init() {
  print_r($facebook);
  global $facebook;
  if(!$facebook->getUser()) loginFB();
  postOnWallWithoutAccess("delta.nitt.edu","festi game");
  
  header("Location: http://delta.nitt.edu");
}
init();