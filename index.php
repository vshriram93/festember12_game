<?php
@include_once("config.inc.php");
$canvas_page = "";                                                                                    
require 'fb/facebook.php';                                                                                                               
$facebook = new Facebook(array(                                                                                                          
			       'appId'  => APP_ID,                                                                             
			       'secret' => APP_SECRET, 									
	     	));
require_once("common.lib.php");
if(isset($_POST['game_start'])&&isset($_POST['game_id']))
  {
    init($_POST['game_id']);
    exit();
  }
else if(isset($_POST['game_end'])&&isset($_POST['game_score'])&&isset($_POST['game_id']))
  {
    savescore();
    echo fetchhighscore();
    exit();
  }
else if(isset($_POST['game_highscore']))
  {
    echo fetchhighscore();
    exit();
  }

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  /* respond to ajax here..*/
  $actions = array('saveScore'=>array('method'=>'savescore'),
  					'fetchhighscore'=>array('method'=>'fetchhighscore'));

	if(isset($actions[$_POST['action']])){
		$use_array = $actions[$_POST['action']];
		if(TRUE === $msg=$use_array['method']()){
			exit ;
		}
		else {
			die($msg);
		}
	}
	
} else {
<<<<<<< HEAD
=======

  print_r ($_GET);
>>>>>>> 4264f4d3195a5b48549c921c7bddcf6702c83d77
  
  if(!isset($_GET['page']) || empty($_GET['page'])) {
    @include_once './inc/common/header.inc.php';
    @include_once './inc/common/menu.inc.php';
    echo "<div id='contents'>";
    include_once './pages/home.html';
    echo "</div>";
  }	
  elseif(file_exists('./games/'.$_GET['page'].'/index.html')) {
    generatemetatags($_GET['page']);
    echo "<div id='contents'>";
    include_once './games/'.$_GET['page'].'/index.html';
    include_once './required/activity.php';

    echo "</div>";
  } else {
    @include_once './inc/common/header.inc.php';
    @include_once './inc/common/menu.inc.php';
    echo "<div id='contents'>";
    echo "404, File Not Found";
    echo "</div>";    
  }
  @include_once './inc/common/footer.inc.php';
  
 }
