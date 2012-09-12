<?php
define("MYSQL_SERVER","localhost");                                  
define("MYSQL_USERNAME","root");
define("MYSQL_PASSWORD","password");
define("MYSQL_DATABASE","festember12_games");
define("APP_ID","404846332903518");
define("APP_SECRET","394aa73ac78693ffa29eb957a79d3850");

              
$connect=mysql_connect(MYSQL_SERVER,MYSQL_USERNAME,MYSQL_PASSWORD);
if(!$connect) {echo "could not connect to server";exit();}
$dbase=mysql_select_db(MYSQL_DATABASE,$connect);
if(!$dbase) {echo "could not connect to database";exit();}
?>