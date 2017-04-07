<?php
$passs_1 = MySQL_Query("SELECT * FROM adminspass where id = '0'");
$heslo_1 = MySQL_Fetch_Array($passs_1);
$aheslo  = $heslo_1['heslo'];
$passs_2 = MySQL_Query("SELECT * FROM adminspass where id = '1'");
$heslo_2 = MySQL_Fetch_Array($passs_2);
$bheslo  = $heslo_2['heslo'];
