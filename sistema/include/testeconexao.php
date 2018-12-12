<?php
$con_string = "host= ".getenv('HOST')." port= ".getenv('PORT')." dbname= ".getenv('DBNAME')." user= ".getenv('USER')." password= ".getenv('PASSWORD');
//$dbcon = pg_connect($con_string);

echo("DBHOST -> ".getenv('HOST')."<br />");
echo("DBPORT -> ".getenv('PORT')."<br />");
echo("DBNAME -> ".getenv('DBNAME')."<br />");
echo("DBUSER -> ".getenv('USER')."<br />");
echo("DBPASSWORD -> ".getenv('PASSWORD')."<br />");

echo("SESAPI -> ".getenv('SESAPI')."<br />");
echo("LDAPSERVER -> ".getenv('LDAPSERVER')."<br />");
echo("LDAPDOMINIO -> ".getenv('LDAPDOMINIO')."<br />");
echo("LDAPENDERECO -> ".getenv('LDAPENDERECO')."<br />");
echo("LDAPPASS -> ".getenv('LDAPPASS')."<br />");

//@pg_close($dbcon);
?>
