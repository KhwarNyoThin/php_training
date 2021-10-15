<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial 2</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="diamond">
    <?php 
      $size = 5;
      for($i = 1; $i <= $size; $i++) {
        for($j = 0; $j < $size-$i; $j++) {
          echo "&nbsp;&nbsp;";
        }
        for($k = 1; $k <= 2*$i-1; $k++) {
          echo "*";
        }
        echo nl2br("\n");
      }

      for($i = $size-1; $i >= 1; $i--) {
        for($j = 1; $j <= $size-$i; $j++) {
          echo "&nbsp;&nbsp;";
        }
        for($k = 1; $k <= 2*$i-1; $k++) {
          echo "*";
        }
        echo nl2br("\n");
      }
    ?> 
  </div>
</body>
</html>