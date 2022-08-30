<?php
include "config.php";


$id=$_GET['id'];
$sql="DELETE FROM category WHERE category_id=$id";
$query=mysqli_query($conn,$sql) or die('query failed');
if($query)
{
    header('location:category.php');
}

?>