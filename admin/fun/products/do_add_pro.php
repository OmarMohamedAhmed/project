<?php

// echo "<pre>";

// print_r($_POST);
// print_r($_FILES);




$name = $_POST['name'];
$price = $_POST['price'];
$count = $_POST['count'];
$descr = $_POST['descr'];
// $image = $_POST['image'];
$category = $_POST['category'];
$brand = $_POST['brand'];


$img_name = $_FILES['image']['name'];
$img_tmp = $_FILES['image']['tmp_name'];
$img_size = $_FILES['image']['size'];


$img_exp = explode(".", $img_name);
$img_ext = end($img_exp);

$allow_ext = ['jpg', 'jpeg', 'png', 'pmb', 'gif', 'webp'];

if (!in_array($img_ext, $allow_ext)) {
    echo "image type error";
    exit();
}

if ($img_size > 3000000) {
    echo "file is too large";
    exit();
}

$new_img_name = time() . rand(1, 100000) . $img_name;
//echo $new_img_name; 

move_uploaded_file($img_tmp, "../../img/$new_img_name");





include("../connect.php");

$insert = "INSERT INTO products( name, price, image, cat, brand, count, descr) VALUES ('$name','$price','$new_img_name','$category','$brand','$count','$descr')";

$conn->query($insert);

header("location:../../products.php");
