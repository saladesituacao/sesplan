<?php
include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/include.php");
 
if ($_SERVER['SERVER_NAME'] == "localhost") {
  $con_string = "host= port= dbname= user= password="; 
}
else {
  $con_string = "host= ".getenv('HOST')." port= ".getenv('PORT')." dbname= ".getenv('DBNAME')." user= ".getenv('USER')." password= ".getenv('PASSWORD');
}
 
$dbcon = pg_connect($con_string);
pg_query("SET search_path TO sesplan");

?>