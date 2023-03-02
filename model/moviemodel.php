<?php

include ('entites/movieEntity.php');

class moviemodel 
{
    
//get all catagories and return in array
    function  GetALLCatagorys ()
    {
        include 'Credentials.php';        
        /*if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
        }
        if (!$mysqli -> query("INSERT INTO Persons (FirstName) VALUES ('Glenn')")) {
         echo("Error description: " . $mysqli -> error);
        }   
        */
        //new mysqli("localhost","my_user","my_password","my_db");
        $con=new mysqli("$host","$user","$passwd","$database");
        if ($con -> connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
        }
        
        $result ="SELECT DISTINCT Categorize From movies";
        $query = mysqli_Query($con,$result);
        if (!$con -> query($result)) {
         echo("Error description: " . $con -> error);
        }
        $catagorys= array();
        //$row = $query -> fetch_array(MYSQLI_NUM)
        while ($row = $query -> fetch_array(MYSQLI_NUM))
        {
            array_push($catagorys, $row[0]);
        }
        
        //close connection
        $con->close();
        return $catagorys;
                
    }
    
//get all movies with catagory=$catagory
    function GetMovieByCatagory($catagory)
    {
        include 'Credentials.php';
        //open connection and select dp
        $con=new mysqli("$host","$user","$passwd","$database");

            
        $query= "SELECT * FROM movies WHERE Categorize LIKE '$catagory'";
        $result= mysqli_Query($con,$query ) or die (mysqli_error($con));
        $movieArray = array();
        
        //$row = $result -> fetch_array(MYSQLI_NUM);
        while ($row = $result -> fetch_array(MYSQLI_NUM))
        {
            $name=$row[0];
            $actors=$row[1];
            $disc=$row[2];
            $img=$row[3];
            $rate=$row[4];
            $dir = $row[5];
            $catagory=$row[6];
            
           $movie = new movieEntity($name,$actors,$disc,$img, $rate ,$dir ,$catagory);
           array_push($movieArray,$movie);
        }
        
        $con->close();
        return $movieArray;
    }
    
    //get all movies with name=$name
    function GetMovieByname($name)
    {
        include 'Credentials.php';
        //open connection and select dp
        $con=new mysqli("$host","$user","$passwd","$database");
        $query= "SELECT * FROM movies WHERE name LIKE '$name'";
        $result= mysqli_Query($con, $query) or die (mysql_error($con));
        
        //$row = $result -> fetch_array(MYSQLI_NUM);
        while ($row = $result -> fetch_array(MYSQLI_NUM))
        {
            $name=$row[0];
            $actors=$row[1];
            $disc=$row[2];
            $img=$row[3];
            $rate=$row[4];
            $dir = $row[5];
            $catagory=$row[6];
            //create movie
            $movie = new movieEntity($name,$actors,$disc,$img, $rate ,$dir ,$catagory);
           
        }
        //close connection and return result
        $con->close();
        return $movie;
    }
    
    function InsertMovie(movieEntity $movie)
    {
        include 'Credentials.php';
        //open connection and select dp
        $con=new mysqli("$host","$user","$passwd","$database");
        $query= sprintf("INSERT INTO movies
                         (Name,Categorize,Actors,Description,Picture,Rate, Directors)
                         VALUES
                         ('%s','%s','%s','%s','%s','%s', '%s')",
        mysqli_real_escape_string($con,$movie->name),
        mysqli_real_escape_string($con,$movie->catagory),
        mysqli_real_escape_string($con,$movie->actors),
        mysqli_real_escape_string($con,$movie->disc),
        mysqli_real_escape_string($con,"Images/".$movie->img),
        mysqli_real_escape_string($con,$movie->rate),
        mysqli_real_escape_string($con,$movie->dir));
        $this->PerformQuery($query);
        
    }
    function UpdateMovie($name,movieEntity $movie)
    {
        
        include 'Credentials.php';
        //open connection and select dp
        $con=new mysqli("$host","$user","$passwd","$database");
        $query= sprintf("UPDATE movies 
                         SET Name='%s',Categorize='%s',Actors='%s',Description='%s',Picture='%s',Rate='%s',Directors = '%s'
                         WHERE Name LIKE '$name'",
        mysqli_real_escape_string($con,$movie->name),
        mysqli_real_escape_string($con,$movie->catagory),
        mysqli_real_escape_string($con,$movie->actors),
        mysqli_real_escape_string($con,$movie->disc),
        mysqli_real_escape_string($con,"Images/".$movie->img),
        mysqli_real_escape_string($con,$movie->rate),
        mysqli_real_escape_string($con,$movie->dir));
        $this->PerformQuery($query);        
    }
    function DeleteMovie($name)
    {
        include 'Credentials.php';
        $con=new mysqli("$host","$user","$passwd","$database");
        
        $query="DELETE FROM movies WHERE Name LIKE '$name'";
        
        $this->PerformQuery($query);
        
    }
    function PerformQuery($query)
    {
        //open connection and select database
        include 'Credentials.php';
        $con=new mysqli("$host","$user","$passwd","$database") ;
        
        if ($con -> connect_errno) {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
        }
        //perform query and close connection
        mysqli_Query($con,$query);
        /*if (!$con -> query($query)) {
         //echo("Error description: " . $con -> error);
        }*/
        $con->close();      
    }
    
    
}
