<?php

$servername = "localhost";
$username = "root";
$password ="";

$dbname="coaching-datbase";

$conn=mysqli_connect($servername , $username , $password ,$dbname);

if($conn)
{
    // echo "successfully connected with server";
}
else{
    echo "connection failed !".mysqli_connect_error();
}

?>