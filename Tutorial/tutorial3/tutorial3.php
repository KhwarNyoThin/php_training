<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial 3</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php	
    $submit = false;
    if (isset($_POST["submit"])){
      $bd = $_POST["bd"];
      $dob = new DateTime($bd);
      $today = new DateTime();
      $age = date_diff($dob, $today);
      $dob_msg = "<p class=dob> Date Of Birth is $bd </p>";
      if($age->y > 0) {        
        $age_msg = "<p class=age>Your age is : $age->y years </p>";
      }
      else {
        $age_msg = "<p class=age>Your age is : $age->m months , $age->d days </p>";
      }
      $submit = true;
    }  
	?>

  <div class="age-calculation">
    <h2>Choose your birthday to calculate your age</h2>
    <form class="input-box" name="form" aciton="" method="post">
      <input type="date" name="bd">
      <input type="submit" name="submit" placeholder="Calculate">
    </form>
    <?php 
      if($submit){
        echo "<div class='result'> $dob_msg $age_msg </div>";
      }
    ?>
  </div>
</body>
</html>