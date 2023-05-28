<?php
    $server = "localhost";
    $uname = "root";
    $pwd = "";
    $db = "users123";

    $conn = mysqli_connect($server,$uname,$pwd,$db);

    if(!$conn)
    {
    //     echo "Success";
    // }
    // else
    // {
        die("Error" .mysqli_connect_error());
    }
?>