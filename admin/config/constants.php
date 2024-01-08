<?php
//  start session
session_start();

// define siteurl
define('SITEURL', 'http://localhost/AllChoice/');
$conn = mysqli_connect('localhost','root','','All_choice') or die (mysqli_error());
?>