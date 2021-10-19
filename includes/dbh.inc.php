<?php

$servername ="mars.iuk.hdm-stuttgart.de/";
$dBUsername = "mp168";
$dBPassword = "aid6so9Ges";
$dBName = "u-mp168";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
