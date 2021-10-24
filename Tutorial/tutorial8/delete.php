<?php 
  $delete = false;
  if(isset($_POST["delete"])) {
    $id = $_POST["delete-id"];
    if($id != null) {
      $delete = true;
      $deleteQuery = "delete from Student_Info where studentID='$id'";

      // execute mysql query
      if($connection->query($deleteQuery) === true && $delete = true) {     
        echo "<p class=result-txt>delete the student '$id' successfully!<p>";
        $delete = false;
      }
      else {
        echo "<p class=result-txt>Error! $connection->error</p>";
      }
    }
    else {
      echo "<p class=result-txt>Empty student ID!</p>";
    }
  }
  
?>