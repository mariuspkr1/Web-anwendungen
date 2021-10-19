<?php
session_start();
$name = $_SESSION['userUid'];
$id = $_SESSION['chatnameid'];

    session_unset();
    session_destroy();
    header("Location: ../index.php");


