<?php

include '../conexion.php';

  $email = $con->real_escape_string( htmlentities( $_POST['email'] ) );

  $password = $con->real_escape_string( htmlentities( $_POST['password'] ) );

  $sel = $con->query("SELECT `id`,`user`,`email`,`password`,`foto`,`token` FROM users WHERE email = '$email'");

  if(  $results = $sel->fetch_assoc() ) {
      $id = $results['id'];
      $user = $results['user'];
      $correo = $results['email'];
      $passwordEnc = $results['password'];
      $foto = $results['foto'];
  }

  $passwordEncrypt = password_verify($password, $passwordEnc);

  if( $email == $correo && $passwordEncrypt == true ) {
      $token = sha1(rand(0000,9999));
      $up = $con->query("UPDATE `users` SET `token` = '$token' WHERE `users`.`id` = '$id'");
      if( $up ) {
        $response = array(
          'token'   => $token,
          'response' => 'success',
          'id' => $id
        );
        echo json_encode( $response );
      }

  } else {
    $response = array(
      'token'   => '',
      'response' => 'fail'
    );
    echo json_encode( $response );
  }





?>
