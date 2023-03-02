<?php

include ('controller/movieController.php');
$movieController= new movieController();

$title="Add a new movie";

if(isset($_GET["update"]))
{
    $movie = $movieController->GetMovieByname($_GET["update"]);
    
    $content="<form action='' method='post'>
    <fieldset>
        <legend>Add a new movie</legend>
    <label for='name'>Name:</label></br>
    <input type='text' class='inputField' name='txtName' value='$movie->name' /><br/>
    
    
    <label for='catagory'>Catagory:</label></br>
    <select class='inputField'name='ddlcatagory'>
        <option value='%%'>All</option>"
        .$movieController->CreatOptionValues($movieController->GetMovieCatagorys()).
    "</select><br/>
   
    <label for='actors'>Actors:</label></br>
    <input type='text' class='inputField' name='txtActors' value='$movie->actors'/><br/>
    
    <label for='img'>Image:</label></br>
    <select class='inputField' name='ddlImage'>"
     .$movieController->GetImages().
    "</select><br/>

    <label for='rate'>Rate:</label></br>
    <input type='text' class='inputField' name='txtRate' value='$movie->rate'/></br>
    
    <label for='dir'>Director:</label></br>
    <input type='text' class='inputField' name='txtdir' value='$movie->dir'/></br>
    
    <label for='disc'>Description:</label></br>
    <textarea cols='50' rows='4' name='textDisc'> $movie->disc </textarea> </br>
    
    <input type='submit'value='Submit'>
        
    </fieldset>
</form>";    
}
else
{
    $content="<form action='' method='post'>
    <fieldset>
        <legend>Add a new movie</legend>
    <label for='name'>Name:</label></br>
    <input type='text' class='inputField' name='txtName'/><br/>
    
        
    <label for='catagory'>Catagory:</label></br>
    <select class='inputField'name='ddlcatagory'>
        <option value='%%'>All</option>"
        .$movieController->CreatOptionValues($movieController->GetMovieCatagorys()).
    "</select><br/>
   
    <label for='actors'>Actors:</label></br>
    <input type='text' class='inputField' name='txtActors'/><br/>
    
    <label for='img'>Image:</label></br>
    <select class='inputField' name='ddlImage'>"
     .$movieController->GetImages().
    "</select><br/>

    <label for='rate'>Rate:</label></br>
    <input type='text' class='inputField' name='txtRate'/></br>
    
    <label for='dir'>Director:</label></br>
    <input type='text' class='inputField' name='txtdir'/></br>
    </br>
    <label for='disc'>Description:</label></br>
    <textarea cols='50' rows='4' name='textDisc'></textarea></br>
    
    <input type='submit'value='Submit'>
        
    </fieldset>
</form>";    
}
if(isset($_GET["update"]) )
{
    if((isset($_POST["txtName"]))&&(isset($_POST["txtActors"]))&&(isset($_POST["txtRate"]))&&(isset($_POST["textDisc"])))
    {
        $movieController->DeleteMovie($_GET["update"]);
        $movieController->InsertMovie();
    }
}
else
{
    if((isset($_POST["txtName"]))&&(isset($_POST["txtActors"]))&&(isset($_POST["txtRate"]))&&(isset($_POST["textDisc"])))
    {
        $movieController->InsertMovie();
    }
}
include './template.php';
?>

