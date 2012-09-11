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
  if(!$facebook->getUser()) header("Location:".$facebook->getLoginUrl(array('scope' => 'publish_stream')));
  exit();

}

function postOnWall()
{
  global $facebook;
  
}

function postOnWallWithoutAccess($link,$message) {
  global $facebook;
 
  try {                                                                                                                                   
    $ret_obj = $facebook->api('/me/feed', 'POST',   
			      array(
				    'description' => "I am batman",
				    'link' => $link,
				    'message' => $message                                                                             
				    ));
  } catch(FacebookApiException $e) 
      { 
	$login_url = $facebook->getLoginUrl(array('scope' => 'publish_stream' )); 
	echo 'Please <a href="' . $login_url . '">login.</a>';  error_log($e->getType()); error_log($e->getMessage());
      }
}

//Email Not fixed
function insertUserDetails()
{
  global $facebook;
  $userProfile = $facebook->api('/me');  
  print_r($userProfile);
  $FBid=$userProfile['id'];
  $FBUserName=$userProfile['name'];
  $FBEmail=$userProfile['username'];
  $checkExistQuery="SELECT * FROM `fb_user_detail` WHERE `fb_id`={$userProfile['id']}";
  
  $checkExistRes=mysql_query($checkExistQuery);
  if(mysql_num_rows($checkExistRes)) return true;
  $insertUserDetailQuery="INSERT INTO `fb_user_detail` (`fb_id`,`fb_user_name`,`fb_email`) VALUES ({$FBid},'{$FBUserName}','{$FBEmail}')";
  $insertUserDetailRes=mysql_query($insertUserDetailQuery);
  echo "success";
  return true;
  
}



function init() {
  global $facebook;
  $data=array();
  if(!$facebook->getUser()) loginFB();
  if(!$facebook->getUser())
    {
      $data["error"]="Access Denied";
      echo json_encode($data);
      exit();
    }
  $userId=insertUserDetails();
  
  exit();
  header("Location: http://delta.nitt.edu");
}

init();
//postOnWallWithoutAccess("delta.nitt.edu","festi game");

