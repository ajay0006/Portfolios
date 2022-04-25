<?php
session_start();


$_SESSION['ActivePage'] = "out";
$_SESSION['user'] = null;

//unset($_SESSION['ActivePage']);
unset($_SESSION['user']);
//session_abort();


header("Location: /Aisha/index.php");
