<?php
function connection()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db_segegresado";

    $cnx = mysqli_connect($host, $user, $pass, $db);

    return $cnx;
}
