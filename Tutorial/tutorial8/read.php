<?php 
  if(isset($_POST["view"])) {
    $id = $_POST["view-id"];
    if($id != null) {

      $viewQuery = "Select* from Student_Info where studentID='$id'";

      // excute mysql query
      if($result = $connection->query($viewQuery)) {
        $row = $result->fetch_assoc();
        if($row != null) {
          $field1 = $row["studentName"];
          $field2 = $row["studentID"];
          $field3 = $row["address"];
          $field4 = $row["email"];
          $field5 = $row["phone_no"];

          // create table to show the information
          echo "<p><br> The information for the student $id </p>;
          <table class=student-info>
            <tr>
              <th>Student Name</td>
              <th>Student ID</td>
              <th>Address</td>
              <th>Email</td>
              <th>Phone Number</td>
            </tr>

            <tr>
              <td>$field1</td>
              <td>$field2</td>
              <td>$field3</td>
              <td>$field4</td>
              <td>$field5</td>
            </tr>
          </table> ";
        }
        else {
          echo "<br> There is no student '$id' <br>";
        }
        
      }
      else {
        echo "<p class=result-txt>Error: $connection->error</p>";
      }
    }
  }
  
?>