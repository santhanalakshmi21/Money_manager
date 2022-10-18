<?php      
    include('checkhis.php');  
    $password = $_POST['pass'];  
      
        //to prevent from mysqli injection  
       
        $password = stripcslashes($password);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from history where password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header("Location: new.html"); 
            exit;
        }
        else{  
            header("Location: moneymanager.html"); 
            exit;
        }     
?>  