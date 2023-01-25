<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './core/header.php';
require_once "imports.php";

//LogOut
if (isset($_GET["logout"])) {
  session_destroy(); //destroy the session
  header("location:./index.php"); //to redirect back to "index.php" after logging out
  exit();
}

?>
