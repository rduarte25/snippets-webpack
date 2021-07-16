<?php

  include '../conexion.php';

  $token = $con->real_escape_string( htmlentities( $_GET['token'] ) );

  $sel = $con->query("SELECT `user` FROM users WHERE token = '$token'");

  if(  $results = $sel->fetch_assoc() ) {
    $user = $results['user'];
  }
  echo $user;

?>
