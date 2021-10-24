<?php 
  if(isset($_POST["update"])) {
    $id = $_POST["edit-id"];
    
    $field = array("studentName", "address", "email", "phone_no");
    if($id != null){
      $empty = true;
      $edit[0] = $_POST["edit-name"];
      $edit[1] = $_POST["edit-address"];
      $edit[2] = $_POST["edit-ph-no"];
      $edit[3] = $_POST["edit-email"];

      // check all the fields are empty or not
      for($index = 0 ; $index < count($edit) ; $index++) {
        if($edit[$index] != null) {
          $empty = false;
          break;
        }
      }
      
      if(!$empty) {
        // write mysql query
        $editField = "";
        for($index = 0 ; $index < count($edit); $index++) {
          if($edit[$index] != null) {
            if($editField != "") {
              $editField .= ", ";
            }
            $editField .= "$field[$index] = '$edit[$index]'";
            
          }
        }
        if($editField != null) {
          $updateQuery = "update Student_Info set ".$editField." where studentID='$id'";
        }
        
        // execute the query
        if($connection->query($updateQuery) === true) {
          echo "<p class=result-txt>Update Successfully</p>";
        }
        else {
          echo "<p class=result-txt>Update Failed <br> Error! $connection->error </p>";
        }
      }
      else {
        echo "<p class=result-txt>Empty field! Fill the field to update</p>";
      }
      
    }
    
  }
?>