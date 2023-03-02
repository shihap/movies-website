
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyle2.css">
		<style>

		</style>
		
		<script>
	    function check_signin()
		{
			var user = document.getElementById(user1);
			var pass = document.getElementById(pass1);
			console.log("this text is printed in console by js");
			if(user1.value==""||pass1.value=="")
			   alert("please enter username and password");
			else
			   alert("success");
		}
		
		function check_signup()
		{
			var name = document.getElementById(name2);
			var user = document.getElementById(user2);
			var pass = document.getElementById(pass2);
			var repass = document.getElementById(repass2);
			var email = document.getElementById(email2);
			console.log("this text is printed in console by js");
			if(name2.value==""|pass2.value==""|user2.value==""|repass2.value==""|email2.value=="")
			   alert("please enter all the fields");
			else if(pass2.value!=repass2.value)
			   alert("check that the passwords are equal");
			else
			   alert("success");
		}
		
		</script>
        
        
	</head>
	<body>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
            <form action='' method='post'>
				<div class="group">
					<label for="user" class="label" >Username</label>
					<input id="user1" type="text" class="input" name="usertxt">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass1" type="password" class="input" data-type="password" name="passtxt">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" onclick="check_signin();">      
				</div>
                </form>
			</div>
			<div class="sign-up-htm">
                <form action='' method='post'>
				<div class="group">
					<label for="name" class="label">name</label>
					<input id="name2" type="text" class="input" name="signupname">
				</div>
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user2" type="text" class="input" name="signupuser">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass2" type="password" class="input" data-type="password" name="signuppass">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="repass2" type="password" class="input" data-type="password" name="resignuppass">
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="email2" type="text" class="input" name="email">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up" onclick="check_signup();">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
                </form>
				</div>
			</div>
		</div>
	</div>
</div>


<!--
   <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
           $(function(){
           $(".button").submit(function() {  
                if(($("#user").val()=="")||($("#pass").val()==""))
                 alert("failed");
                 
                else
                 alert("success");
                });
           });
        </script>

-->




	</body>
</html>

<?php
    include ('controller/userController.php');
    $usercontroller= new userController ();
    //insert into data pase since success
	$username=$_POST["signupuser"];
	echo($user);
	//$usernamelog=$_POST["usertxt"];
	//$loginpass=$_POST["passtxt"];
	//sign up if u wnna
	// has to be a new account
	$user=$usercontroller->GetuserByuserName($username);
	
		
			$usercontroller->InsertUser();	
	?>