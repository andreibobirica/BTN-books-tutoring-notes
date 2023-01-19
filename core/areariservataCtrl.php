<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentification.php';
$auth = new Authentification();
require_once './core/RichiesteAnnunci.php';
$rich = new RichiesteAnnunci();

//LogOut
if (isset($_GET["logout"])) {
  session_destroy(); //destroy the session
  header("location:./index.php"); //to redirect back to "index.php" after logging out
  exit();
}
?>
