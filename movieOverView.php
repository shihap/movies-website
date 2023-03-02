<?php
include ('controller/movieController.php');
$title = "Manage movie objects";
$movieController= new movieController();
$content = $movieController->CreateOverViewTable();

if(isset($_GET["delete"]))
{
    $movieController->DeleteMovie($_GET["delete"]);
}


include './template.php';
?>
