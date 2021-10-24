<?php
  $connection = mysqli_connect('localhost','root','root','php_training');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Student Information CRUD</h1>
  <p>You can choose the operation you want to do</p>
  <!-- <div class="operation"> -->
    <button class="op-btn" onclick="chooseOperation(event, 'create')">Create</button>
    <button class="op-btn" onclick="chooseOperation(event, 'read')">Read</button>
    <button class="op-btn" onclick="chooseOperation(event, 'update')">Update</button>
    <button class="op-btn" onclick="chooseOperation(event, 'delete')">Delete</button>

    <div id="create" class="edit-blk create">
      <p>Fill the required information to add new student information</p>
      <form method="post">
        <label>Student Name *</label> <br>
        <input type="text" name="name"> <br>
        <label>Student ID *</label> <br>
        <input type="text" name="id"> <br>
        <label>Address *</label> <br>
        <input type="text" name="address"> <br>
        <label>Phone Number</label> <br>
        <input type="text" name="ph-no"> <br>
        <label>Email</label> <br>
        <input type="text" name="email"> <br>
        <input id="add" type="submit" name="add" value="Add"> <br>
      </form>
      <?php include "add.php"; ?>
    </div>
    
    
    <div id="read" class="edit-blk">
      <form method="post">
        <label>Enter the Student ID you want to view</label> <br>
        <input type="text" name="view-id"> <br>
        <input type="submit" name="view" value="View"> <br>
      </form>
      <?php include "read.php"; ?>
    </div>
    

    
    <div id="update" class="edit-blk">
      <form method="post">
        <label>Enter the Student ID you want to update</label> <br>
        <input type="text" name="edit-id"> <br>
        <label>Fill the field you want to update</label> <br>
        <label>Student Name</label> <br>
        <input type=text name=edit-name> <br>
        <label>Address</label> <br>
        <input type=text name=edit-address> <br>
        <label>Phone Number</label> <br>
        <input type=text name=edit-ph-no> <br>
        <label>Email</label> <br>
        <input type=text name=edit-email> <br>
        <input type="submit" name="update" value="edit"> <br>
      </form> 
      <?php include "update.php" ?>
    </div>

    <div id="delete" class="edit-blk" action="<?php echo !$_SERVER['PHP_SELF']; ?>">
      <form method="post">
        <label>Enter the Student ID you want to delete</label> <br>
        <input type="text" name="delete-id"> <br>
        <input type="submit" name="delete" value="Delete"> <br>
      </form>
      <?php include "delete.php" ?>
    </div>
    
  <script src="js/tabBtn.js"></script>
  <script src="js/library/jquery-3.4.1.min.js"></script>
  <script src="js/preventDefault.js"></script>
</body>
</html>