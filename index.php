<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Signup</title>
</head>
<body>
    <form method="POST">
    <h5>Welcome</h5>
    <h4>Create your account</h4><br>
    <label>Name</label>
    <input type="text" placeholder="Enter your name" name="uname" required="">
    <label>Email</label>
    <input type="email" placeholder="Enter your email" name="email" required="">
    <label>Password</label>
    <input type="password" placeholder="Enter your password" name="pasword" required="">
    <button class="button" type="submit" value="Register">Create aacount</button><br>
    <nav>
        <ul>
            <li><a href="/Singin/index.html" target="_blank">Already have an account?</a></li>
            <li><a href="/signin/index.html" target="_blank"><span>sign In</span></a></li>
        </ul>
    </nav>
    </form>
    
    <?php

// $uname = $_POST['uname'];
// $email  = $_POST['email'];
// $pasword = $_POST['pasword'];





if (!empty($uname) || !empty($email) || !empty($pasword))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (uname , email ,pasword)values('?','?','?')";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $uname1,$email,$pasword);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
</body>
</html>