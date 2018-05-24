<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'shopadmin');
define('DB_PASSWORD', 'adminturangga');
define('DB_NAME', 'pweb_shop');

$usrconn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$usrconn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}