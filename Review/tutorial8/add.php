<?php 
  if(isset($_POST["add"])) {
    $name = $_POST["name"];
    $id = $_POST["id"];
    $address = $_POST["address"];
    $phone = $_POST["ph-no"];
    $email = $_POST["email"];

    // name, id and address are mandatory. phone and email are optional
    if($name != null && $id != null && $address != null) { 
      $addQuery = "insert into Student_Info values('$name', '$id', '$address', '$phone', '$email')";
      
      // ececute mysql query
      if($connection->query($addQuery) === true) {
        echo "<p class=result-txt>Add new data successfully!<p>";
      }
      else {
        echo "<p class=result-txt>Error! $connection->error</p>";
      }
    }
    else {
      echo "<p class=result-txt>Fill the required information first!<p>";
    }
  }
?>