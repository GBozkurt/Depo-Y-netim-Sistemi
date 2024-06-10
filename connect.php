<?php
$hostname="localhost";
$username="root";
$password="usbw";
$database="webprojesiy";
$conn = new mysqli($hostname, $username, $password, $database);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


?>