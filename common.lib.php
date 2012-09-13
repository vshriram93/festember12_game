<?php

function loginFB() {
  global $facebook;
  //  print_r($facebook);
  if(!$facebook->getUser()) header("Location:".$facebook->getLoginUrl(array('scope' => 'publish_stream')));
}
function postOnWall($description,$link,$message) {
  global $facebook;
  try{
    $ret_obj = $facebook->api('/me/feed', 'POST',   
			      array(
				    'description' => $description,
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
  //print_r($userProfile);
  $FBid = $userProfile['id'];
  $FBUserName = $userProfile['name'];
  $FBEmail = $userProfile['username'];
  $checkExistQuery = "SELECT * FROM `fb_user_detail` WHERE `fb_id`={$userProfile['id']}";
  $checkExistRes = mysql_query($checkExistQuery);
  if(mysql_num_rows($checkExistRes)) 
    {
      
      return true;
    }
  $insertUserDetailQuery="INSERT INTO `fb_user_detail` (`fb_id`,`fb_user_name`,`fb_email`) VALUES ({$FBid},'{$FBUserName}','{$FBEmail}')";
  $insertUserDetailRes=mysql_query($insertUserDetailQuery); 
  //  print_r($userProfile);
  postOnWall("Festember Games","festember.in","Testing");
  return true;
  
}

function savescore(){
	$game_id = htmlentities($_POST['game_id']);
	$game_high_score =  htmlentities($_POST['game_score']);
  	global $facebook;
  	$userProfile = $facebook->api('/me');
	
	$query = "INSERT INTO `fb_score_detail` (`fb_user_id`, `game_id`, `game_high_score`, `game_timestamp`) VALUES ('".$userProfile['id']."'', '".$game_id."', '".$game_high_score."', CURRENT_TIMESTAMP)";
	$result = mysql_query($query) or die(mysql_error());
}

function fetchhighscore(){
	$game_id = htmlentities($_POST['game_id']);
	
	$query = "SELECT * FROM `fb_score_detail` LEFT JOIN `fb_user_details` ON `fb_score_detail`.`fb_id`=`fb_user_details`.`fb_user_id` ORDER BY `game_high_score` DESC LIMIT 0,10";
	$result = mysql_query($query) or die(mysql_error());
	
	if($result){
		$list = array();
		while($ans = mysql_fetch_assoc($result)){
			$list[] = $ans;
		}
		return json_encode($list);
	}
	return 0;
}

function generatemetatags($gamePage){
  $appId=APP_ID;
  $title = ucfirst($_GET['page']);
	echo <<< END_TXT
<!DOCTYPE>
<html>	  
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# festember: http://ogp.me/ns/fb/festember#">
  <meta property="fb:app_id" content="{$appId}" />
  <meta property="og:url"    content="{$_SERVER['REDIRECT_SCRIPT_URI']}" />
  <meta property="og:type"   content="festember:game" />
  <meta property="og:title"  content="{$title}" />
  <meta property="og:image"  content="https://s-static.ak.fbcdn.net/images/devsite/attachment_blank.png" />
END_TXT;
	include_once './games/'.$gamePage.'/head';
	echo <<< END_TXT

</head>
<body>
<div id="body">

END_TXT;

	return $head;

}

function init($game_id) {
  global $facebook;
  $data = array();
  
  if(!$facebook->getUser()) loginFB();
  if(!$facebook->getUser())
    {
      $data["error"]="Access Denied";
      echo json_encode($data);
      exit();
    }
  $userId=insertUserDetails();
 // echo "<br/>hello";
  //echo $facebook->getAccessToken()."<br/>";
  exit();
  header("Location: http://delta.nitt.edu");
}

?>