<?php

$servername="localhost";
$username="root";
$password="";
$dbname="student";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error)
{
    die("COnnection faild".$conn->connect_error);
}

?>
