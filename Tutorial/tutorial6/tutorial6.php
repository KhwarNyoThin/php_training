<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial 6</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php 
      $upload = false;

      // if click the upload button
      if(isset($_POST["upload"])) { 
        $folder = $_POST["folder"];
        $image = $_FILES["image"];
        $success = "";
        
        // if folder or image is empty
        if($folder == NULL || $image == NULL){ 
          echo "<script>alert('Fill the required data')</script>";
        }
        else {          
          $extension = array("jpg", "jpeg", "png");
          $file_name = $_FILES['image']['name'];
          $file_ext = pathinfo($_FILES["image"]["name"])['extension'];

          // only the jpg and png are allowed
          if(in_array($file_ext, $extension) === false) { 
            echo "<script>alert('Only JPEG and PNG files are allowed')</script>";
          }
          else {
            mkdir($folder);
            $source = $_FILES['image']['tmp_name'];
            $destination = $folder."/".$file_name;

            // copy the file to the destination folder
            if(copy($source, $destination)) {  
              echo "<div class=result>Uploaded successfully to the folder '$folder'</div>";
            }
            else {
              echo "<div class=result>Upload failed!</div>";
            }
          }
                
        }
        
      }
  ?>

  <form class="file-upload" method="post" enctype="multipart/form-data">
    <input type="file" name="image"> <br>
    <input type="text" name="folder" placeholder="Enter the folder name"> <br>
    <input type="submit" name="upload" value="upload">
  </form> <!-- input form -->
  
  
  <?php 
    if($upload && $success != "") {
      
    }
   ?> <!-- result -->
</body>
</html>