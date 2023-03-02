<?php
include ('controller/movieController.php');
$movieController= new movieController();

if(isset($_POST['catagorys']))
{
    //fill page with movie of the selected type
    $movietables =$movieController->CreateMovieTabels($_POST['catagorys']);
    
}
else
{
    // page is loaded for the first time ,no type selected ->fetch all
    $movietables =$movieController->CreateMovieTabels("%%");
}
$title ='main';
$content=$movieController->CreateMovieDropDownList().$movietables;

include 'template.php';


?> 