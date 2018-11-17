<?php

$config['database_host'] = "jeffrey.gq";
$config['database_username'] = "jeffreym_hackathon";
$config['database_password'] = "lehman2018";
$config['database_db'] = "jeffreym_hackathon";
$config['database_port'] = 3306;
$config['database_table'] = "Task";

$connection = mysqli_connect($config['database_host'],$config['database_username'],$config['database_password'],$config['database_db'],$config['database_port']);

//Error Checking
if($connection == false){
    die("oops, we died... will get back to you");
}
?>