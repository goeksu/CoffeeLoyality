<?php
   define('DB_SERVER', 'us-cdbr-east-04.cleardb.com');
   define('DB_USERNAME', 'b0f9e4927cafac');
   define('DB_PASS', '14706dff');
   define('DB_DATABASE', 'heroku_aa9d4e48d310743');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASS,DB_DATABASE);
   mysqli_set_charset($db, "UTF8");
if(mysqli_connect_errno() > 0){
	die("hata ". mysqli_connect_error());
}
?>