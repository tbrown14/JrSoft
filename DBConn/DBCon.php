<?php
session_start();

$db = mysqli_connect('localhost', 'tbrown14', 'Travis321', 'Catering_System');


//REGISTER CODE  - TRAVIS BROWN
function registerUser($fname,$lname,$dob ,$email, $sadress, $postal, $prov,  $country  , $user , $pass )
{

    

    global $db;
    global $Address_ID;
    $errors = array();

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $sql = "INSERT INTO `Address_Info`(`Street_Address`, `Postal_Code`, `Prov`, `Country`) VALUES ('$sadress','$postal','$prov','$country');";
    $result = mysqli_query($db, $sql);
    $Address_ID = mysqli_insert_id($db);
    
    
     $sql ="INSERT INTO `Login_Info`(`Username_ID`, `Password`) VALUES ('$user', '$pass');";

    $sql .="INSERT INTO User_Info(First_Name, Last_Name, Date_Of_Birth, Email, Username_ID, Address_ID) VALUES ('$fname','$lname','$dob','$email', '$user','$Address_ID');";
    
    $data = mysqli_fetch_assoc($result);  
        if ($db->multi_query($sql) === TRUE) {
            echo "New records created successfully";
            //header('location: ../profile.php');
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
        
        $db->close();
    



}




//WHOS LOGGED IN CODE - TRAVIS BROWN
function loginUser($username , $password)
{
    global $db;
    $errors = array();

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    // first check the database to make sure 
    // a user does not already exist with the same username
    $sql = "SELECT * FROM `Login_Info` WHERE Username_ID ='$username' LIMIT 1";
    $result = mysqli_query($db, $sql);
    if (!$result) { die("SQL:".$sql  ."<br/>Error:". mysqli_error($db));}
    $data = mysqli_fetch_assoc($result);   
    var_dump($data);
    
    if ($data) { // if user exists    
        if ($data['Username_ID'] == $username && $data['Password'] === $password ) {
            $_SESSION['Username_ID'] = $username;
         
            $user= $username;
            var_dump("It works");
            header('location: ./profile.php');
           
        }
        else{
            var_dump('first error');
            $errors['login']= "Invalid username or password";
            return $errors;
        }
    }
   
}



//WHOS LOGGED IN CODE - TRAVIS BROWN
function userLoggedIn1(){




    $username = $_SESSION['Username_ID'];
   



     global $db;
    
    $errors = array();

     if ($db->connect_error) {
         die("Connection failed: " . $db->connect_error);
     }
    
    $sql = "SELECT * FROM `User_Info` WHERE Username_ID = '$username' ";
    $result = mysqli_query($db, $sql);

     $data = mysqli_fetch_array($result);  


    
        
     return  $data;
     $db->close();
        


}
//WHOS LOGGED IN CODE - TRAVIS BROWN
function userLoggedIn2($sadress){

    global $db;
   
   $errors = array();

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
   
   $sql = "SELECT * FROM Address_Info WHERE Address_ID = '$sadress' ";
   $result = mysqli_query($db, $sql);

    $data = mysqli_fetch_array($result);  


   
       
    return  $data;
    $db->close();
    
}
//WHOS LOGGED IN CODE - TRAVIS BROWN
    function userLoggedIn3(){




        $userName = $_SESSION['Username_ID'];
       
    
    
    
         global $db;
        
        $errors = array();
    
         if ($db->connect_error) {
             die("Connection failed: " . $db->connect_error);
         }
        
        $sql = "SELECT * FROM User_Info WHERE Username_ID = '$userName' LIMIT 1";
        $result = mysqli_query($db, $sql);
    
         $data = mysqli_fetch_array($result);  
    
    
        
            
         return  $data['Address_ID'];
         $db->close();
    
    }
       




    //IMAGE UPLOAD CODE - TRAVIS BROWN
function imageUp($target_dir, $addressID){
           
                
    global $db;
    $errors = array();

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    
      
       
           // Insert record
          
          // $sql = "INSERT INTO `Images`(`Img_Path`, `Username_ID`) VALUES ('$target_dir','$addressID');";

           $sql = "UPDATE `Images` SET `Img_Path` = '$target_dir' , `Username_ID` = '$addressID';";

           $result = mysqli_query($db, $sql);
    
           $data = mysqli_fetch_array($result);  
           if (!$result) { die("SQL:".$sql  ."<br/>Error:". mysqli_error($db));}

           if ($db->mysqli_query($sql) === TRUE) {
               
            //    header('location: ./LoginRegister/profile.php');
            

           } else {
               echo "Error: " . $sql . "<br>" . $db->error;
           }
           
           $db->close();
        
          
        
      
        
       
     
}
//SHOW IMAGE CODE TRAVIS BROWN
    function showImg($user){



        global $db;
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $sql = "SELECT `Img_Path`, `Username_ID` FROM `Images` WHERE Username_ID = '$user'";
        $result = mysqli_query($db, $sql);
        if (!$result) { die("SQL:".$sql  ."<br/>Error:". mysqli_error($db));}
        $data = mysqli_fetch_assoc($result);
        return $data;
}




//CHANGE PASSWORD CODE- TRAVIS BROWN

function updatePassword($pass){
    $userName = $_SESSION['Username_ID'];
  
    global $db;
    $errors = array();
    
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    
      
           

           
          $sql = " UPDATE `Login_Info` SET `Password`= '$pass' WHERE `Username_ID` = '$userName';";
           $result = mysqli_query($db, $sql);
    
           $data = mysqli_fetch_array($result);  
           if (!$result) { die("SQL:".$sql  ."<br/>Error:". mysqli_error($db));}

           if ($db->mysqli_query($sql) === TRUE) {
               
            
          
            

           } else {
               echo "Error: " . $sql . "<br>" . $db->error;
           }
           
           $db->close();

}
//ADD PACKAGE CODE - TRAVIS BROWN
function addPackage($packDesc, $packCost){
    
  
    global $db;
    $errors = array();
    
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    
      
           

     $sql=  "INSERT INTO `Food_Packages`(`Package_Desc`, `Package_Cost`) VALUES ('$packDesc', '$packCost');";

         // $sql = " INSERT INTO `Food_Packages` (`Package_Desc`, `Package_Cost`) VALUES (`$packDesc`, '$packCost' );";
           $result = mysqli_query($db, $sql);
    
           $data = mysqli_fetch_array($result);  
           if (!$result) { die("SQL:".$sql  ."<br/>Error:". mysqli_error($db));}

           if ($db->mysqli_query($sql) === TRUE) {
               
            
          
            

           } else {
               echo "Error: " . $sql . "<br>" . $db->error;
           }
           
           $db->close();
}


   


?>