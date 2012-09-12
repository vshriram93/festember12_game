<?php
@include_once("config.inc.php");
$canvas_page = "";                                                                                    
require 'fb/facebook.php';                                                                                                               
$facebook = new Facebook(array(                                                                                                          
			       'appId'  => APP_ID,                                                                             
			       'secret' => APP_SECRET, 									
	     	));
require_once("common.lib.php");



init();
//postOnWallWithoutAccess("delta.nitt.edu","festi game");


//check for db if not add the gameid and user profile
if(isset($_POST['start'])&&isset($_POST['game_id']))
  {
    init();
    
  }