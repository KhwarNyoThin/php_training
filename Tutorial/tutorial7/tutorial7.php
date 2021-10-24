<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khwar Nyo Thin Tutorial 7</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>Hello</h1>
  <form class="input" method="post">
    <input type="text" name="text" placeholder="Type the text to generate QR Code"> <br>
    <input type="submit" name="submit" value="Generate">
  </form>
  <?php
    include ("phpqrcode/qrlib.php");
    
    if(isset($_POST["text"])) {
      echo "start <br>";
      $text = $_POST["text"];
      echo $text;
      $folder = "qrcode/";
      $file_name = $folder."qr.png";
      $ecc = 'H';
      $pixel_size = 20;
      $frame_size = 5;
      QRcode::png($text, $file_name, $ecc, $pixel_size, $frame_size);
      echo "finish";
      echo "<img src=qrcode/qr.png alt='qr code'>";
      QRcode::png($text);
    }

	?>
</body>
</html>