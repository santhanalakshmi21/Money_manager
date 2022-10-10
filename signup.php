<?php
$username = $_POST['username'];
$gender = $_POST['gender'];               
$email  = $_POST['email'];
$password = $_POST['password'];
$confirmpassword=$_POST['confirmpassword'];
$conn = new mysqli('localhost','root','','signup');
if($conn->connect_error){
    die('Connection Failed : ' .$conn->connect_error);
}
else {
    $stmt = $conn->prepare("insert into registration(username,gender,email,password,confirmpassword)
                           values(?,?,?,?,?)");
    $stmt->bind_param("sssss",$username,$gender,$email,$password,$confirmpassword);
    $stmt->execute();
    header("Location: new.html"); 
    exit;
    $stmt->close();
    $conn->close();

}
?>