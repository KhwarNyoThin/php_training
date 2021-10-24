<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial 9</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
    $connection = mysqli_connect('localhost','root','root','php_training');

    $query = "SELECT * FROM Student_Info";
    echo "<h2>Student Information Table</h2>";
    if ($result = $connection->query($query)) {
        $number = 1;
        echo "<div class=result> <table class=student-info>";
        echo "<tr>";
        echo "<th>No.</th>";
        echo "<th>Student Name</td>";
        echo "<th>Student ID</td>";
        echo "<th>Address</td>";
        echo "<th>Email</td>";
        echo "<th>Phone Number</td>";
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            $field1 = $row["studentName"];
            $field2 = $row["studentID"];
            $field3 = $row["address"];
            $field4 = $row["email"];
            $field5 = $row["phone_no"];
            echo "<tr>";
            echo "<td>$number</td>";
            echo "<td>$field1</td>";
            echo "<td>$field2</td>";
            echo "<td>$field3</td>";
            echo "<td>$field4</td>";
            echo "<td>$field5</td>";
            echo "</tr>";
            $number++;
        }
        echo "</table> </div>";

    /*freeresultset*/
    $result->free();
    }
  ?>
</body>
</html>

