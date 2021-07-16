<?php

  include '../conexion.php';

  $token = $con->real_escape_string( htmlentities( $_GET['token'] ) );

  $sel = $con->query("SELECT `id` FROM users WHERE token = '$token'");

  if(  $results = $sel->fetch_assoc() ) {
    $id = $results['id'];
    $up = $con->query("UPDATE users SET token = null WHERE id = '$id'");
    if( $up ) {
      echo 'success';
    } else {
      echo 'fail';
    }
}

?>
