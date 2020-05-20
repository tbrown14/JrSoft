<!DOCTYPE html>


    <head>
    <?php include '../DBConn/DBCon.php';?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>

    <?php 


    
    $username = $password = "";
    $errors = array();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
             
        if (empty(trim($_POST["Username_ID"]))) {
            $errors["Username_ID"] = $usernameErr = "Username is required";
        } else {
            $username = validate_input($_POST["Username_ID"]);
        }
            
        if (empty(trim($_POST["Password"]))) {
            $errors["Password"] = $passwordErr = "Password is required";
        } else {
            $password = validate_input($_POST["Password"]);
        }
    
        if(count($errors)==0)
        {
            $errors = loginUser($username , $password);
        }
    }
    
    function validate_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    

    if(isset($_POST['register_user'])){
        
        $username = $_POST['username'];
       
    
        
    }
    
    


?>



    <form id='register' action='Login.php' method="post" accept-charset='UTF-8'>
    <fieldset style ="width: 25%; margin:0px auto;">
    <div class="container">
    <legend>Login Form</legend>
    <tr><td>
    <label for="psw"><b>User Name:</b></label>
    <input type='hidden' name='submitted' id='submitted' value='1'/>
    <span class='error'><?php echo isset($errors['login'])?$errors['login']:"";?></span> 
    <input type='text' name='Username_ID' id='username' maxlength="50" style="width:100%" VALUE="<?PHP print $username ; ?>"/>
    <br/><span class="error"><?php echo isset($errors['Username_ID'])?$errors['Username_ID']:"";?></span>
    </td></tr><tr><td>
    <br>
    <label for="psw"><b>Password:</b></label>
    <input type='password' name='Password' id='password' maxlength="50" style="width:100%"/>
    <br/><span class="error"><?php echo isset($errors['Password'])?$errors['Password']:"";?></span>
    </td></tr><tr><td>
    <tr><td>


    </br>
    <input type='submit' name='login_user' value='Submit' style="width: 100%" />
    </td><td>
    <input type="reset" value="Cancel" style="width: 100%" />
    </td></tr>

	 <p>
  		 Not a member yet? <a href="Register.php">Register Now</a>
  	 </p>
    
  </div>

 
</form>
        
       
    </body>
</html>