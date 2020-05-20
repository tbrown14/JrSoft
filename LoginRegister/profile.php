<!DOCTYPE html>
<?php session_start();?>
    <head>
        <meta charset="utf-8">
        <?php include '../DBConn/DBCon.php';?>
       
        <title>Welcome </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
    </head>
    <body>
       


       <form action="profile.php" enctype="multipart/form-data" method="post">
       
       <h1>Welcome, <?php echo $_SESSION['Username_ID']; 
        ?></h1>
       <p>Youre logged in, here is your user info <p>
       <p>Select a Profile picture <p>
       
       <form method="post" action="profile.php" enctype='multipart/form-data'>
        <input type='file' name='file' />
        <input type='submit' value='Upload' name='but_upload'>
        </form>

    


        <div id="test">
        <?php $user = showImg($_SESSION['Username_ID']);
        
        
        
        
            $src = $user['Img_Path'];
        
       

        
        ?>
        
        <img src =   "<?php echo $src; ?>" style=" width:300px;"    />
   </div>





       <?php 





                    $sadress = userLoggedIn1()['Address_ID'];    
                    
                    $userInfo = userLoggedIn1();
                    $addressInfo =  userLoggedIn2($sadress);

                    echo "Name: ";
                    echo $userInfo['First_Name'];
                    echo" ";
                    echo $userInfo['Last_Name'];
                    echo "</br>";
                    echo " Birthday: ";
                    
                    echo $userInfo['Date_Of_Birth'];
                    echo "</br> ";
                    echo "Email: ";
                    echo $userInfo['Email']; 
                    echo "<br/>";
                    echo "Street Address: ";
                    echo $addressInfo["Street_Address"];
                    

                    echo "<br/>";
                    echo "Postal Code: ";
                    echo $addressInfo["Postal_Code"];
                    echo "<br/>";
                    echo "Province: ";
                    echo $addressInfo["Prov"];
                    echo "<br/>";
                    echo "Country: ";
                    echo $addressInfo["Country"];
                   
               
             



                      if(isset($_POST['but_upload'])){
 
                        $name = $_FILES['file']['name'];
                        $target_dir = "uploadImage/".basename($name);

                        $target_file = ($_FILES["file"]["tmp_name"]);
                        $size = $_FILES["file"]["size"];
                      
                        // Select file type
                       
                       
                        // Valid file extensions
                        //$extensions_arr = array("jpg","jpeg","png","gif");

                        $file_type = $_FILES['file']['type'];
                      
                        // Check extension
                        

                        $allowed = array("image/jpeg", "image/png", "image/jpg");
                        if(!in_array($file_type, $allowed)) {
                            echo "<br>";
                          echo 'You can only upload jpg, jpeg, and png files';
                          
                        } 

                        
                        
                           // Upload file
                           move_uploaded_file($_FILES['file']['tmp_name'],$target_dir);
                           echo "<br>";
                            echo "Your profile picture has been uploaded. ";
                      

                            if($size > 3*1024*1024){
                                echo "</br>"; 
                               echo "the image is too large";   
                            }
                            
                            imageUp($target_dir, $_SESSION['Username_ID']);
                            
                            refrsh();
                       
                     }

                    






                      
                      ?>
<br>

<?php

$fname = $email = $lname = $dob = $sadress = $prov = $postal = $country = $user = $pass = $cpass = "";
// error handlers
 
$sadressErr = $sadresslengthErr = $provErr = $postalErr = $postalNumErr = $coutnryErr = $passErr = $passNumErr = $cpassErr ="";




// this is just a basic field required validation to make sure that everything there is suppose to be there, and has certian errors to prevent users error or less then needed information or misinformation.
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['Register']))
{ 

   


/////////////////////////////////////////////////////////DATE OF BIRTRHvalidating that input was put into the field, and checking that its over 18 years of age//////////////////// 
  

    

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
    
/////////////////////////////////////////////////////////////////////////////
if ( $passNumErr == ""  ) {

 //updateStreeAdd( $sadress, $postal,  $prov, $country );
 updatePassword($pass);
  
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
<form novalidate="novalidate" id="profile.php" method='post' accept-charset='UTF-8'>
 
  <fieldset>
  <legend>Would you like to update your information</legend>
  
    <p>Please fill in the information below</p>
    
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            
   
   
    <label for="passsword"><b>Password :</b></label>
    <input type="password" placeholder="Enter Password" name="Password">
    <!-- Using my premade errors to spit out to tell the user what that issues is -->
    <span class = "error"> <b><?php echo $passErr ?></b> </span>
    <span class = "error"> <b><?php echo $passNumErr ?></b> </span>
    </br>
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

  
</form>

    </body>

    
    <p>
  		  <a href="./registration/login.php">Sign Out</a>
           
  	 </p>
</html>