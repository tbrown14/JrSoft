
<!DOCTYPE html>
<html>
<!-- 
    //////////////////////////////////// 
    // Course code : CP470 
    // Student Name: TRAVIS BROWN CODE
    ////////////////////////////////////
    -->
<?php include '../DBConn/DBCon.php';?>

<title> Registration Page Online Catering Service </title>
<!-- making my error messages turn red to catch the users attention -->
<style>
.error {color:#ff0000;}
</style>
<?php


$packDescError = $packCostError = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['Add']))
 

    
/////////////////////////////////////////////////////
    if(empty(trim($_POST["Package_Desc"])))     
    {
        $packDescError ="**Package is required.**";
       
    }else{
        
        $packDesc = validate_input($_POST["Package_Desc"]);

       
    }
   
//////////////////////////////////////////////////////
    if(empty(trim($_POST["Package_Cost"])))
    {
        $packCostError ="**Package Cost required.**";

    }else{
        $packCost = validate_input($_POST["Package_Cost"]);
    }
    
    

 if ($packCostError == "" && $packDescError == "" ) {
    
    $float_value_of_var = floatval($packCost);
   
    addPackage($packDesc, $packCost);

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
<form novalidate="novalidate" id="adminPage.php" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post' accept-charset='UTF-8'>
  <div style="text-align:center" class="registerForm">
  <fieldset>
  <legend>Add Food Packages</legend>
    
            
    <label for="packDesc"><b>Package Description: </b></label>
    <input type="text" placeholder="Enter The Description." name="Package_Desc">
    </br>
    <span class = "error"> <?php echo $packDescError ?> </span>
  
    </br>
    </br>
    <label for="lastname"><b>Package Cost: </b></label>
    <input type="text" placeholder="Enter The Total Cost." name="Package_Cost">
    </br>
    <span class = "error"> <?php echo $packCostError ?> </span>


    </br>
    <input type = "submit" name="Add" type="register" class="register_button" value="Add Package"/>
    <!-- Clear button to get rid of everything on the form -->
    <input name="Clear" type="reset" class="reset_button" value="Clear"  />
    </br>
  </div>
</fieldset>
 
  </div>
  
</form>
</html>