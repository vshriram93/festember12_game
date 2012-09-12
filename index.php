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
	@include_once './inc/common/header.inc.php';
	@include_once './inc/common/menu.inc.php';
	echo "<div id='contents'>";
	
	if(isset($_GET['page']) || empty($_GET['page'])):
		include_once './pages/home.html';
	elseif(file_exists('./games/'.$_GET['page'].'/index.html')):
		include_once './games/'.$_GET['page'].'/index.html';
	else:
		echo "404, File Not Found";
	endif;
	
	
	echo "</div>";
	
	@include_once './inc/common/footer.inc.php';
}
