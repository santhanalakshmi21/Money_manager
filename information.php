<?php
$Name = $_POST['Name'];
$Phoneno = $_POST['Phoneno'];               
$Bank_accno  = $_POST['Bank_accno'];
$income = $_POST['income'];
$target_savings = $_POST['target_savings'];
$target_period = $_POST['target_period'];
$conn = new mysqli('localhost','root','','information');
$sql = "SELECT SUM(Withdrawal_Amount) from san";
$result = $conn->query($sql);
if($conn->connect_error){
    die('Connection Failed : ' .$conn->connect_error);
}
else {
    $stmt = $conn->prepare("insert into details(Name,Phoneno,Bank_accno,income,target_savings,target_period)
                           values(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$Name,$Phoneno,$Bank_accno,$income,$target_savings,$target_period);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    if($target_period == "monthly"){
        $cal = $income/12;
     
    //display data on web page
    
    //$a = (int)readline('enter your timeline')
        while($row = mysqli_fetch_array($result)){
        $a= $row['SUM(Withdrawal_Amount)'];
            echo "<br>";
    
        }
    $mon=$cal-$a;
    if($mon>=$target_savings){
        header('location:effect.html');
    }
    else{
        header('location:sad.html');
    }
    }
  
    if($target_period == "weekly"){
        $div = $income/52;
    //display data on web page
    
    //$a = (int)readline('enter your timeline')
        while($row = mysqli_fetch_array($result)){
        $a= $row['SUM(Withdrawal_Amount)'];
            echo "<br>";
           
        }
    $week=$div-$a;
    
    if($week>=$target_savings){
        header('location:effect.html');
         
    }
    else{
        header('location:sad.html');
    }
    }
    if($target_period == "yearly"){
        $yer = $income/2;
     
    //display data on web page
    
    //$a = (int)readline('enter your timeline')
        while($row = mysqli_fetch_array($result)){
        $a= $row['SUM(Withdrawal_Amount)'];
            echo "<br>";
        }
    $yearly=$yer-$a;
    if($yearly>=$target_savings){
        header('location:effect.html');
    }
    else{
        header('location:sad.html');
    }
}
}
?>