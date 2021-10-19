<?php

$servername ="mars.iuk.hdm-stuttgart.de";
$dBUsername = "mp168";
$dBPassword = "Wacsyma9dampuzuskizWacsyma9dampuzuskizman";
$dBName = "u-mp168";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
