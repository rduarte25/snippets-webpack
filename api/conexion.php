<?php
    header('Access-Control-Allow-Origin: *');
    $con = new mysqli( 'localhost', 'root', '', 'db_snippets_webpack' );

    if( $con->connect_errno ) {
        die( 'La conexión no pudo establecerse.' );
    }

?>
