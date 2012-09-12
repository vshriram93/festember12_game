<?php
define("MYSQL_SERVER","localhost");                                  
define("MYSQL_USERNAME","festember12_game");
define("MYSQL_PASSWORD","GetLucky");
define("MYSQL_DATABASE","festember12_games");
define("APP_ID","263593520331172");
define("APP_SECRET","f375faf3a72816923278d367798ce2aa");

              
$connect=mysql_connect(MYSQL_SERVER,MYSQL_USERNAME,MYSQL_PASSWORD);
if(!$connect) {echo "could not connect to  server";exit();}
$dbase=mysql_select_db(MYSQL_DATABASE,$connect);
if(!$dbase) {echo "could not connect to database";exit();}
?>