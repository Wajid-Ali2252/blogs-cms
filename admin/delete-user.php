<?php
include "config.php";
$id=$_GET['id'];
$sql2="DELETE FROM user WHERE user_id='$id'";
$data=mysqli_query($conn,$sql2);
if($data)
{
    header('location:users.php');
}
?>