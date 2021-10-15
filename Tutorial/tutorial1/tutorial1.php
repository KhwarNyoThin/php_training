<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial1</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php 
    echo "<table class=chess-board>";
      for($row = 0; $row < 8; $row++) {
        echo "<tr>";
        for($col = 0; $col < 8; $col++) {
          $sum = $row + $col;
          
          if($sum % 2 == 0) {
            echo "<td class=white></td>";
          }
          else {
            echo "<td class=black></td>";
          }         
        }
        echo "</tr>";
      }
    echo "</table>";
  ?>
</body>
</html>

