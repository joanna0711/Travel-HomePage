<?php
  session_start();
  session_destroy();
  header( 'Location: \5015\main\main.php' );
?>