<?php
//session_start();

include ('model/userModel.php');
class userController 
{
    function InsertUser()
    {
        $Name = $_POST["signupname"];
        $Username = $_POST["signupuser"];
        $Email = $_POST["email"];
        $Password= $_POST["resignuppass"];
        $Admin = "false";
        
        $user = new userEntity($Name,$Username,$Email,$Password, $Admin);
        $userModel = new userModel();
        $userModel->InsertUser($user); 
    }
    
    function UpdateUser($Email)
    {
        $Name = $_POST["name"];
        $Username = $_POST["username"];
        //$Email = $_POST["email"];
        $Password= $_POST["password"];
        $Admin = $_POST["admin"];
        
        $user = new userEntity($Name,$Username,$Email,$Password, $Admin);
        $userModel = new userModel();
        $userModel->UpdateUser($user);
    }
    
    
    function GetuserByuserName($username)
    {
        $usermodel = new usermodel();
        return $usermodel->GetuserByname($username);
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
