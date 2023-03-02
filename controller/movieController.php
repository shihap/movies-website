<?php

include ('model/moviemodel.php');//contains non data base related functions
class movieController {
  
    function CreateMovieDropDownList()
    {
        $movieModel = new moviemodel;
        $result ="<form action= '' method= 'post' width = '200px'>
                   Please select a catagory:
                   <select name = 'catagorys'>
                        <option value = '%'> All</option>
                        ".$this->CreatOptionValues($movieModel->GetALLCatagorys()).
                   "</select>
                   <input type = 'submit' value = 'search'/>
                   </form>";
        return $result;
    }
    function CreatOptionValues(array $valueArray)
    {
        $result="";
        foreach ($valueArray as $value)
        {
            $result = $result . "<option value='$value'>$value</option>";
        }
        return $result;
        
    }
    function CreateMovieTabels($catagory)
    {
        $movieModel = new moviemodel();
        $movieArray = $movieModel->GetMovieByCatagory($catagory);
        $result = "";
        foreach ($movieArray as $key =>$movie)
        {
            $result = $result.
                    "<table class = 'movieTable'>
                        <tr>
                            <th rowspan='6' width = '150px'><img runat = 'server' src = '$movie->img'/></th>
                            <th width ='75px'>Name:</th>
                            <td>$movie->name</td>
                        </tr>
                        <tr>
                            <th>Catagory:</th>
                            <td>$movie->catagory</td>
                        </tr>
                        <tr>
                            <th>Actors:</th>
                            <td>$movie->actors</td>
                        </tr>
                        <tr>
                            <th>Disc:</th>
                            <td>$movie->disc</td>
                        </tr>
                        <tr>
                            <th>Director:</th>
                            <td>$movie->dir</td>
                        </tr>
                        <tr>
                            <th>Rate:</th>
                            <td>$movie->rate</td>
                        </tr>
                    </table>";
        }
        return $result;
        
    }
    
    function InsertMovie()
    {
        $name = $_POST["txtName"];
        $catagory = $_POST["ddlcatagory"];
        $actors = $_POST["txtActors"];
        $img= $_POST["ddlImage"];
        $rate = $_POST["txtRate"];
        $disc = $_POST["textDisc"];
        $dir = $_POST["txtdir"];
        $movie = new movieEntity($name,$catagory,$actors,$disc,$img, $rate ,$dir);
        $moviemodel = new moviemodel();
        $moviemodel->InsertMovie($movie);
    }
    
    function UpdateMovie($name)
    {
        $name = $_POST["txtName"];
        $catagory = $_POST["ddlcatagory"];
        $actors = $_POST["txtActors"];
        $img= $_POST["ddlImage"];
        $rate = $_POST["txtRate"];
        $disc = $_POST["textDisc"];
        $dir = $_POST["txtdir"];
        $movie = new movieEntity($name,$catagory,$actors,$disc,$img, $rate ,$dir);
        $moviemodel = new moviemodel();
        $moviemodel->UpdateMovie($name, $movie);
    }
    
    function DeleteMovie($name)
    {
    $moviemodel=new moviemodel();
    $moviemodel->DeleteMovie($name);
    }
    
    function GetMovieByName($name)
    {
        $moviemodel = new moviemodel();
        return $moviemodel->GetMovieByname($name);
    }
    
    function GetMovieByCatagory($catagory)
    {
        $moviemodel = new moviemodel();
        return $moviemodel->GetMovieByCatagory($catagory);
    }
    
    function GetMovieCatagorys()
    {
        $moviemodel = new moviemodel();
        return$moviemodel->GetALLCatagorys();
    }
    
    //return list of files in a folder
    function GetImages()
    {
        //select the folder
        $handle= opendir("images");
        //read all filesand store in array 
        while ($image=readdir($handle))
        {
            $images[]=$image;
        }
        closedir($handle);
        //Exclude all filenames where filename length <3
        $imageArray= array();
        foreach ($images as $image)
        {
            if(strlen($image) > 2)
            {
                array_push($imageArray,$image);   
            }
        }
        //create <select><option> values and return
        $result = $this->CreatOptionValues($imageArray);
        return $result;
    }
    function CreateOverViewTable()
    {
        $result ="
            <table class='overviewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td> Name </td>
                    <td> Catagory </td>
                    <td> Actors </td>
                    <td> Img </td>
                    <td> Rate </td>
                    <td> dir </td>
                    <td> Desc </td>
                    
                </tr>";
        $movieArray = $this->GetMovieByCatagory('%%');
        foreach ($movieArray as $key=> $value)
        {
            $result = $result.
                    "<tr>
                        <td><a href='MovieAdd.php?update=$value->name'>Update</a></td>
                        <td><a href='movieOverView.php?delete=$value->name'>Delete</a></td>
                        <td>$value->name</td>
                        <td>$value->catagory</td>
                        <td>$value->actors</td>
                        <td>$value->img</td>
                        <td>$value->rate</td>
                        <td>$value->dir</td>
                        <td>$value->disc</td>
                        </tr>";
        }
        $result = $result . "</table>"  ;
        return $result;
    }
}
?>