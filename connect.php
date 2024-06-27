<?php 

     //Connection to database
     
    $con = new mysqli('localhost', 'root', '', 'portfolio');

    if(!$con) {
    die(mysqli_error($con));
    }

?>