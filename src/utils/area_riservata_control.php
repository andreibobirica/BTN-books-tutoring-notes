<?php
require_once 'imports.php';
require_once './utils/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './utils/listings_list.php';

//Logout
if (isset($_GET["logout"])) {
  session_destroy();
  header("location:./index.php");
  exit();
}

?>