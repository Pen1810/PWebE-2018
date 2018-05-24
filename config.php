<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'shoppers');
define('DB_PASSWORD', 'shoppers169');
define('DB_NAME', 'pweb_shop');

$usrconn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$usrconn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}