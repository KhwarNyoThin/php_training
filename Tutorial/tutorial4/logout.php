<?php 
  session_start();
  setcookie(session_name(), "", time() - 1);
  session_destroy(); //remove sid-login from server storage
  session_write_close();
  header("Location: tutorial4.php");
?>