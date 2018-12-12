<?php
$con_string = "host= ".getenv('DBHOST')." port= ".getenv('DBPORT')." dbname= ".getenv('DBNAME')." user= ".getenv('DBUSER')." password= ".getenv('DBPASSWORD');
$dbcon = pg_connect($con_string);

echo("DBHOST -> ".getenv('DBHOST')."<br />");
echo("DBPORT -> ".getenv('DBPORT')."<br />");
echo("DBNAME -> ".getenv('DBNAME')."<br />");
echo("DBUSER -> ".getenv('DBUSER')."<br />");
echo("DBPASSWORD -> ".getenv('DBPASSWORD')."<br />");

echo("SESAPI -> ".getenv('SESAPI')."<br />");
echo("LDAPSERVER -> ".getenv('LDAPSERVER')."<br />");
echo("LDAPDOMINIO -> ".getenv('LDAPDOMINIO')."<br />");
echo("LDAPENDERECO -> ".getenv('LDAPENDERECO')."<br />");
echo("LDAPPASS -> ".getenv('LDAPPASS')."<br />");

@pg_close($dbcon);
?>
