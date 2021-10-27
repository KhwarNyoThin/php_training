<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial 5</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form class="file-upload" method="post" enctype="multipart/form-data">
    <input type="file" name="file"> <br>
    <input type="submit" name="upload" value="upload">
  </form> <!-- input form -->

  <?php 
    include "phpexcelreader/excel_reader.php";
    
    // if click the upload button
    if(isset($_POST["upload"]) ) { 
      $file = $_FILES["file"];

      // check if the file is chosen or not
      if($file["name"] === "") { 
        echo "<div class=result>choose the file first!</div>";
      } 
      else {
        $file_name = $_FILES["file"]["name"];
        $file_ext = pathinfo($_FILES["file"]["name"])["extension"];
        $source = $_FILES["file"]["tmp_name"];
        $destination = "fileToOpen/".$file_name;

        // copy the file to the destination folder
        if(copy($source, $destination)) {  
          echo "Uploaded successfully to the folder 'fileToOpen'";
        }
        $file = fopen("fileToOpen/$file_name", "r");
        $content = "";
    
        if($file_ext == "xlsx" || $file_ext == "xls") {
          
          $excelReader = new PhpExcelReader();  // create an object to read excel file
          $excelReader->read("fileToOpen/$file_name");
          $nr_sheets = count($excelReader->sheets);  // gets the number of sheets
          $content = "";     // to store tables for all sheets

          // set the data from all sheets
          for($i = 0; $i < $nr_sheets; $i++) {
            $content .= "<h2>Sheet ".($i + 1)."</h2>". readExcelSheet($excelReader->sheets[$i]) ."<br/>";  
          }
        }
        else {
          if($file) {

            // read line by line from txt file
            while (!feof($file)) {  
              $content .= fgets($file). "<br>";
            }
            fclose($file);         
          }
          else {
            echo "There is no such file in this path. Can't open the file";
          }
        }
        echo "<div class=result>$content</div>";
      } 
      
    }
    
  ?>

<?php 
  // function to display table for the given sheet
  function readExcelSheet($sheet) {
    $table = "<table>"; // start creating table to show excel sheet
    $row = 1;

    while ($row <= $sheet["numRows"]) {
      $table .= "<tr>\n";
      $col = 1;

      while ($col <= $sheet["numCols"]) {
        $cell = isset($sheet["cells"][$row][$col]) ? $sheet["cells"][$row][$col] : "&ensp;";
        $table .= "<td>$cell</td>\n";
        $col++;
      }
      $table .= "</tr>";
      $row++;
    }
    $table .= "</table>";
    return $table;
  }
?>  
  
  

   
</body>
</html>