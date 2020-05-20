
<!DOCTYPE html>
<html>
<!-- 
    //////////////////////////////////// 
    // Course code : CP470 
    // Student Name: Travis Brown
    ////////////////////////////////////
    -->
<?php include '../DBConn/DBCon.php';?>

<title> Registration Page Online Catering Service </title>
<!-- making my error messages turn red to catch the users attention -->
<style>
.error {color:#ff0000;}
</style>
<?php
$fname = $email = $lname = $dob = $sadress = $prov = $postal = $country = $user = $pass = $cpass = "";
// error handlers
$fnameErr = $emailErr = $fnamelengthErr = $lnameErr = $lnamelengthErr = $dobErr = $dobAgeErr = 
$sadressErr = $sadresslengthErr = $provErr = $postalErr = $postalNumErr = $coutnryErr = $userErr = $userlengthErr = 
$usernumErr= $passErr = $passNumErr = $cpassErr ="";




// this is just a basic field required validation to make sure that everything there is suppose to be there, and has certian errors to prevent users error or less then needed information or misinformation.
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['Register']))
{ 

   
//////////////////////////////////////////////////////////////FIRST NAME validating that input was put into the field, and checking that its over 2 characters////////////////////
    if(empty(trim($_POST["First_Name"])))
    {
        $fnameErr ="**First Name is required.**";
    }else{
        $fname = validate_input($_POST["First_Name"]);
        if (strlen($fname) < 2){
            $fnamelengthErr = "Your first name must be greater than 2 characters.";
        }
    }
    
////////////////////////////////////////////////////////////////LAST NAME validating that input was put into the field, and checking that its over 2 characters////////////////////
    if(empty(trim($_POST["Last_Name"])))
    {
        $lnameErr ="**Last Name is required.**";
    }else{
        $lname = validate_input($_POST["Last_Name"]);
        if (strlen($lname) < 2){
            $lnamelengthErr = "Your last name must be greater than 2 characters.";
        }
        
    }
   
/////////////////////////////////////////////////////////DATE OF BIRTRHvalidating that input was put into the field, and checking that its over 18 years of age//////////////////// 
  
    if(empty(trim($_POST["Date_Of_Birth"])))
    {
        $dobErr ="**Date Of Birth is required.**";
    }else{
        $dob = validate_input($_POST["Date_Of_Birth"]);
        
        // if( strtotime("1988/03/23") < (time() - (18 * 60 * 60 * 24 * 365))) {
        //     $dobAgeErr = "Not old nuff to register sorry!";
        //   }
    }
    
    
////////////////////////////////////////////////////////////ADDRESS validating that input was put into the field, and checking that its over 2 characters/////////////////
    if(empty(trim($_POST["Street_Address"])))
    {
        $sadressErr ="**Street adress is required.**";
    }else{
        $sadress = validate_input($_POST["Street_Address"]);
        if (strlen($sadress) < 2){
            $sadresslengthErr = "Your street address must be greater than 2 characters.";
        }
    }
    
//////////////////////////////////////////////////////////PROVINCE validating that input was put into the field///////////////////    
    if(empty(trim($_POST["Prov"])))
    {
        $provErr ="**Province is required.**";
    }else{
        $prov = validate_input($_POST["Prov"]);
    }
/////////////////////////////////////////////////////////POSTALvalidating that input was put into the field, and checking tht it is formatted to canadian postalcodes////////////////////    
    if(empty(trim($_POST["Postal_Code"])))
    {
        $postalErr ="**Postal code is required.**";
    }else{
        $postal = validate_input($_POST["Postal_Code"]);
        if (preg_match('/^(?:[A-Z]\d[A-Z][ -]?\d[A-Z]\d)$/i', $postal))
        {
        
        } else{
            $postalNumErr = "Your Postal code is invalid";
        
        }
    }
    
    
/////////////////////////////////////////////////////COUNTRY validating that input was put into the field////////////////////////    
    if(empty(trim($_POST["Country"])))
    {
        $coutnryErr ="**Country is required.**";
    }else{
        $country = validate_input($_POST["Country"]);
    }
////////////////////////////////////////////////////USERNAME validating that input was put into the field, and checking that its over 2 characters/////////////////////////    
    if(empty(trim($_POST["Username_ID"])))
    {
        $userErr ="**Username is required.**";
    }else{
        $user = validate_input($_POST["Username_ID"]);
        if (strlen($user) < 2){
            $userlengthErr = "Your user name must be greater than 2 characters.";
        }
        if($user == ctype_digit($user[0]))
    {
        $usernumErr = "*Your Username must begin with a letter";
    }
    }
    
    
/////////////////////////////////////////////////////EMAIL validating that input was put into the field, and checking that its a valid email////////////////////////    
    if(empty(trim($_POST["Email"])))
    {
        $emailErr ="**Email is required.**";
    }else if(!filter_var(trim($_POST["Email"]), FILTER_VALIDATE_EMAIL))
    {
        $emailErr ="**Invalid email format.**";
    }
    else{

        $email = validate_input($_POST["Email"]);
    }
//////////////////////////////////////////////////////USERS PASSWORDvalidating that input was put into the field, and checking that its over 4 characters///////////////////////  
    if(empty(trim($_POST["Password"])))
    {
        $passErr ="**Password is required.**";
    }else{
        $pass = validate_input($_POST["Password"]);
        if (strlen($pass) < 2){
            $passNumErr = "Your password must be greater than 4 characters.";
        }
    }
    
    
//////////////////////////////////////////////////CONFIRMING PASSWIRD validation that ur password is the same as before///////////////////////////    
    if(empty(trim($_POST["password-repeat"])))
    {
        $cpassErr ="**Confirm is required.**";
    }else{
        $cpass = validate_input($_POST["password-repeat"]);
        if ($pass != $cpass){
            $cpassErr ="**NOT MATCH.**";
        }
    }
/////////////////////////////////////////////////////////////////////////////
if ($fnameErr == "" && $emailErr == "" && $fnamelengthErr == "" && $lnameErr == "" && $lnamelengthErr == "" &&$dobErr == "" &&$dobAgeErr == "" && 
$sadressErr =="" && $sadresslengthErr =="" && $provErr =="" && $postalErr == "" &&$postalNumErr =="" && $coutnryErr =="" && $userErr == "" &&$userlengthErr == "" &&
$usernumErr =="" && $passErr == "" && $passNumErr == "" && $cpassErr == "") {
    
    registerUser($fname,$lname,$dob ,$email, $sadress, $postal, $prov,  $country  , $user , $pass );
   
}
}

}

// validationg form data
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}






?>
<form novalidate="novalidate" id="Register.php" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post' accept-charset='UTF-8'>
  <div style="text-align:center" class="registerForm">
  <fieldset>
  <legend>Welcome, would you like to register for our online catering services?</legend>
    <h1>Registration Below</h1>
    <p>Please fill in the information below to create an free account.</p>
    
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            <table border=0 align="center">
            </td></tr><tr><td bgcolor="gray" colspan=2>
            <center>Personal Information</center>
            </td></tr><tr><td>    
            <tr><td>
    <label for="firstname"><b>First Name :</b></label>
    <input type="text" placeholder="Enter your first name" name="First_Name">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <?php echo $fnameErr ?> </span>
    <span class = "error"> <?php echo $fnamelengthErr ?> </span>
    </br>
    </br>
    <label for="lastname"><b>Last Name :</b></label>
    <input type="text" placeholder="Enter your first name" name="Last_Name">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <?php echo $lnameErr ?> </span>
    <span class = "error"> <?php echo $lnamelengthErr ?> </span>
    </br>
    </br>
    <label for="dateofbirth"><b>Date of birth :</b></label>
    <input type="date" placeholder="yyyy/mm/dd" name="Date_Of_Birth">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <?php echo $dobErr ?> </span>
    <span class = "error"> <?php echo $dobAgeErr ?> </span>
    </br>
    </br>
    <label for="email"><b>Email :</b></label>
    <input type="text" placeholder="Enter Email" name="Email">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class="error"><?php echo $emailErr ?> </span> 
    </br>
    </br>
    <input type='hidden' name='submitted' id='submitted' value='1'/>
    <table border=0 align="center">
    </td></tr><tr><td bgcolor="gray" colspan=2>
    <center>Adress Information</center>
    </td></tr><tr><td>    
     <tr><td>
    
    <label for="streetadress"><b>Street Adress :</b></label>
    <input type="text" placeholder="Enter street adress" name="Street_Address">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <?php echo $sadressErr ?> </span>
    <span class = "error"> <?php echo $sadresslengthErr ?> </span>
    
    </br>
    </br>
             <label><b>Select Province :</b></label>
             <select id = "myList" name = "Prov">
               <option value = "Ontario">Ontario</option>
               <option value = "Manitoba">Manitoba</option>
               <option value = "British Columbia">British Columbia</option>
               <option value = "Alberta">Alberta</option>
               <option value = "New Brunswick">New Brunswick</option>
               <option value = "Quebec">Quebec</option>
               <option value = "Newfoundland">Newfoundland</option>
               <option value = "Nova Scotia">Nova Scotia</option>
               <option value = "PEI">PEI</option>
               <option value = "Saskatchewn">Saskatchewn</option>
               <option value = "Northwest Territories">Northwest Territories</option>
               <option value = "Nunavut">Nunavut</option>
               <option value = "Yukon">Yukon</option>
             </select>
             <!-- Using my premade errors to spit out to tell the user what that issues is -->
             <span class = "error"> <?php echo $provErr ?> </span>
    </br>
    </br>
    <label for="postalcode"><b>Postal Code :</b></label>
    <input type="text" placeholder="Enter postal code" name="Postal_Code" >
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <?php echo $postalErr ?> </span>
    <span class = "error"> <?php echo $postalNumErr ?> </span>
    </br>
    </br>
    <label for="country"><b>Country :</b></label>
    <input type="text" placeholder="Enter your country" name="Country">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <?php echo $coutnryErr ?> </span>
    </br>
    <input type='hidden' name='submitted' id='submitted' value='1'/>
            <table border=0 align="center">
            </td></tr><tr><td bgcolor="gray" colspan=2>
            <center>Login Information</center>
            </td></tr><tr><td>    
            <tr><td>
    <label for="username"><b>Username :</b></label>
    <input type="text" placeholder="Enter your username" name="Username_ID">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <b><?php echo $userErr ?></b> </span>
    <span class = "error"> <b><?php echo $userlengthErr ?></b> </span>
    <span class = "error"> <b><?php echo $usernumErr ?></b> </span>
    </br>
    </br>
    <label for="passsword"><b>Password :</b></label>
    <input type="password" placeholder="Enter Password" name="Password">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <b><?php echo $passErr ?></b> </span>
    <span class = "error"> <b><?php echo $passNumErr ?></b> </span>
    </br>
    </br>
    <label for="passsword-repeat"><b>Confirm Password :</label>
    <input type="password" placeholder="Repeat Password" name="password-repeat">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <?php echo $cpassErr ?> </span>
    </br>
    </br>
    <!-- Register button that will send the information into the database through the DBConn.php -->
    <!-- <button type="submit" class="registerbtn">Register</button> -->
    <input type = "submit" name="Register" type="register" class="register_button"/>
    <!-- Clear button to get rid of everything on the form -->
    <input name="Clear" type="reset" class="reset_button" />
    </br>
  </div>
</fieldset>
  <div style="text-align:center" class="signin">
  <!-- A link to move you into the login page.-->
    <p>Already have an account? <a href="Login.php">Sign in</a>.</p>
  </div>
  
</form>
</html>