<?php

define('DBHOST', '10.5.0.3');
define('DBUSER', 'user1');
define('DBPASS', 'user1password');
define('DBNAME', 'user1_db');


$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
if ( !$conn ) {
  die("Connection failed : " . mysql_error());
}