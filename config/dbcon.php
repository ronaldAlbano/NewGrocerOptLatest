<?php

define('DB_SERVER',"localhost");
define('DB_USERNAME',"u744732095_pos");
define('DB_PASSWORD',"9sU~D3#D7_Xq");
define('DB_DATABASE',"u744732095_pos");

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(!$conn){
    die("Connection Failed: ". mysqli_connect_error());
}



?>