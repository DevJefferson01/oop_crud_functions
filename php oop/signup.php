<?php 
include "init.php";
if (count($_POST)> 0) {

	//post was made
	$errors = User::action()->create($_POST);
	if (!is_array($errors)) {

		header("location: login.php");
		die;
		// code...
	}
	// code...
}




?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jefferson oop sign-up</title>
</head>
<body>
	<style type="text/css">
		form{
			margin: auto;
			margin-top: 20px;
			font-family: algerian;
			width: 100%;
			max-width: 300px;
			border-radius: 5px;
			border: solid thin #ccc;
			box-shadow:0px 0px 10px #aaa;
			padding: 10px;
			position: relative;

		}

		.input{
			position: relative;
			margin: auto;
			width: 100%;
			max-width: 280px;
			border-radius: 5px;
			border: solid thin #ccc;
			padding: 10px;
			margin-top: 5px;

		}

		.btn{

			padding: 10px;
			float: right;
			border: none;
			background-color: #0095ff;
			color: white;
			cursor: pointer;
			border-radius: 5px;
		}
	</style>
	<form method="post">
		<h2>Sign up</h2> 
		<div style="color: red; font-size: 15px; text-align: center; font-family: candara;">
			<?php  

    if (isset($errors) && is_array($errors)) {

    	foreach ($errors as $error) {
    		echo $error . "<br>";
    		// code...
    	}
    	// code...
    }




			?>
		</div>
		<input class="input" type="text" name="username" placeholder="username" value="<?=isset($_POST['username']) ? $_POST['username'] : '';?> "><br> 
		<input class="input" type="text" name="email" placeholder="email" value="<?=isset($_POST['email']) ? $_POST['email'] : '';?> "><br> 
		<input class="input" type="password" name="password" placeholder="password"><br>
		<div> 
		<select class="input" name="gender" style="max-width: 300px;">
			<option><?=isset($_POST['gender']) ? $_POST['gender'] : '--select gender--';?> </option>
			<option>Male</option>
			<option>Female</option>	
			
		</select>
		</div>
		<br>
		<input class="btn" type="submit" value="submit">
		<br style="clear: both;">

		<a style="text-decoration: none; font-size: 12px; font-family: tahoma; padding: 4em; " href="login.php">login if you have active account</a>
		
	</form>

</body>
</html>