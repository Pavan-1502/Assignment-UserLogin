<?php
$servername="localhost";
$username="root";
$password="";
$database="user_journey";
$con=mysqli_connect($servername,$username,$password,$database);
if(!$con)
{
    die("error detected".mysqli_error($con));
}
else
{
    echo"connection established successfully";

}
?>