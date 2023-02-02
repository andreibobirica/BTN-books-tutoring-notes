<?php

require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './core/header.php';
require_once "imports.php";
require_once './core/listings_list.php';

//Logout
if (isset($_GET["logout"])) {
  session_destroy();
  header("location:./index.php");
  exit();
}

?>