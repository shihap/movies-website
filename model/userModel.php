<?php

include ('entites/userEntity.php');

class userModel 
{
    
//get all catagories and return in array
    function GetALLUsers()
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
        
        $result ="SELECT * From users";
        $query = mysqli_Query($con,$result);
        if (!$con -> query($result)) {
         echo("Error description: " . $con -> error);
        }
        $users = array();
        //$row = $query -> fetch_array(MYSQLI_NUM)
        while ($row = $query -> fetch_array(MYSQLI_NUM))
        {
            array_push($users, $row[0]);
        }
        
        //close connection
        $con->close();
        return $users;
                
    }
    function makeAdmins($email)
    {
        include 'Credentials.php';
        $con=new mysqli("$host","$user","$passwd","$database");
        $query= "UPDATE * FROM users WHERE Email LIKE '$email'";
        $query= "UPDATE users SET Admin='TRUE'
                 WHERE Email LIKE '$email'";
    }
//get all movies with catagory=$catagory
    function GetuserbyuserName($username)
    {
        include 'Credentials.php';
        //open connection and select dp
        $con=new mysqli("$host","$user","$passwd","$database");

            
        $query= "SELECT * FROM users WHERE Username LIKE '$username'";
        $result= mysqli_Query($con,$query );
        
        //$row = $result -> fetch_array(MYSQLI_NUM);
        while ($row = $result -> fetch_array(MYSQLI_NUM))
        {
            $Name=$row[0];
            $Username1=$row[1];
            $Email=$row[2];
            $Password=$row[3];
            $Admin=$row[4];
            $new_user = new userEntity($Name,$Username,$Email,$Password, $Admin);
        }
        
        $con->close();
        return $new_user;
    }
    
    
    function InsertUser(userEntity $user_)
    {
        include 'Credentials.php';
        //open connection and select dp
        $con=new mysqli("$host","$user","$passwd","$database");
        $query= sprintf("INSERT INTO users
                         (Name,Username,Email,Password,Admin)
                         VALUES
                         ('%s','%s','%s','%s','%s')",
        mysqli_real_escape_string($con,$user_->Name),
        mysqli_real_escape_string($con,$user_->Username),
        mysqli_real_escape_string($con,$user_->Email),
        mysqli_real_escape_string($con,$user_->Password),
        mysqli_real_escape_string($con,$user_->Admin));
        
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
        mysqli_Query($con,$query);

        $con->close();      
    }
}
