<?php
$HOST =  'lt';
$USER =  's5';
$PASS =  'wz';
$BASE =  'd5';
        
$db = mysql_connect($HOST, $USER, $PASS);
if (!$db) die('SERVER ERROR: ' . mysql_error());
mysql_select_db($BASE) or die("DATABASE ERROR");
mysql_query("SET NAMES cp1251");


?>
