<?php
include "database.php";

$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];

mysqli_query ($link, "INSERT INTO `product` (`product_name`, `quantity`, `is_deleted`, `created_date`, `motified_date`) 
                    VALUES ('$product_name','$quantity','0',NOW(),NULL)")
or die(mysqli_error($link));

header("Location:product_list");

?>