<?php
define("MYSQL_SERVER","localhost");                                  
define("MYSQL_USERNAME","");
define("MYSQL_PASSWORD","");
define("MYSQL_DATABASE","");
              
$connect=mysql_connect(MYSQL_SERVER,MYSQL_USERNAME,MYSQL_PASSWORD);
if(!$connect) echo "could not connect to server";
$dbase=mysql_select_db(MYSQL_DATABSE,$connect);
if(!$dbase) echo "could not connect to database";
?>