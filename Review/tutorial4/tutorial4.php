<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial 4</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
  <?php 
    session_start();
    $defaultName = "Admin";
    $defaultPwd = "welcome123";

    // if session id exit and not yet login
    if(session_id() == "" || isset($_POST["submit"])) { 

      // after filling name and password
      if(isset($_POST["name"]) && isset($_POST["password"])) { 
        $name = $_POST["name"];
        $password = $_POST["password"];

        // if name and password are correct
        if($name == $defaultName && $password == $defaultPwd) { 
          $_SESSION['name'] = $name;
          header("location: login_page.html");
        }
        else {
          echo "<script>alert('Your name or password is incorrect')</script>";
        }
      }
    }  
  ?>

  <form class="login-form" method="post">
    <input type="text" name="name" placeholder="Name"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="submit" name="submit" value="Login">
  </form> <!-- login form -->
</body>
</html>