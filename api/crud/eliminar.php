<?php

    include '../conexion.php';

    $id   = $con->real_escape_string( htmlentities( $_GET['id'] ) );

    $del = $con->prepare( "DELETE FROM snippets WHERE id = ?" );

    $del->bind_param("i",$id);

    if( $del->execute() ) {
        echo 'success';
    } else {
        echo 'fail';
    }

    $del->close();
    $con->close();

?>
