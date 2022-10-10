<?php
session_start();
$con=mysqli_connect("localhost","root","","signup");
$msg='';
if(isset($_POST['submit'])){
	$time=time()-30;
	$ip_address=getIpAddr();
	$check_login_row=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as total_count from login_log where try_time>$time and ip_address='$ip_address'"));
	$total_count=$check_login_row['total_count'];
	if($total_count==3){
		$msg="To many failed login attempts. Please login after 30 sec";
	}else{
		$email=mysqli_real_escape_string($con,$_POST['user']);
		$password=mysqli_real_escape_string($con,$_POST['pass']);
		$sql="select * from registration where email='$email' and  password='$password'";
		$res=mysqli_query($con,$sql);
		if(mysqli_num_rows($res)){
			$_SESSION['IS_LOGIN']='yes';
			mysqli_query($con,"delete from login_log where ip_address='$ip_address'");
			?>
			<script>
				window.location.href='dashboard1.php';
			</script>
			<?php
		}else{
			$total_count++;
			$rem_attm=3-$total_count;
			if($rem_attm==0){
				$msg="To many failed login attempts. Please login after 30 sec";
			}else{
				$msg="Please enter valid login details.<br/>$rem_attm attempts remaining";
			}
			$try_time=time();
			mysqli_query($con,"insert into login_log(ip_address,try_time) values('$ip_address','$try_time')");
			
		}
	}
}

function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
       $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
       $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
       $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
   return $ipAddr;
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Login Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <style type="text/css">
         body {margin: 0;padding: 0;background-color: #17a2b8;height: 100vh;}
         #login .container #login-row #login-column #login-box {margin-top: 30px;max-width: 600px;height: 360px;border: 1px solid #9C9C9C;background-color: #EAEAEA;}
         #login .container #login-row #login-column #login-box #login-form {padding: 40px;}
		 #result{color:red;}
       #logo{padding-left:20px;
      padding-top:10px;} 
      #login .container{
         padding-top:5px;
      }
      #login h3{
         padding-top:5px;
         color:white;
      }
      </style>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <body>
         <div id="login">
         <div id="logo">
			<img src="mmlogo.png">
         </div>
          <center>  <h3 >Login form</h3></center>
            <div class="container">
               <div id="login-row" class="row justify-content-center align-items-center">
                  <div id="login-column" class="col-md-6">
                     <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post">
                           <div class="form-group">
                              <label for="email" class="text-info">Email:</label><br>
                              <input type="email" name="user" id="user" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <label for="password" class="text-info">Password:</label><br>
                              <input type="password" name="pass" id="pass" class="form-control" required>
                           </div>
                           <div class="form-group">
                              <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                           </div>
                           <a href="forgot-password.php">Forgot Password?</a>
                           <p class="link">Don't have an account?  <a href="signup.html">Sign up </a> here</a>
						   <div id="result"><?php echo $msg?></div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </body>
</html>