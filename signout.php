<?php

session_start();

$_SESSION["email"]=null;

echo "<script>window.location='login.php';</script>";

