<?php
require 'config.php';

// Delete Category
if (!empty($_GET['del_cat_id'])) {
    $connect = db_connect();
    if (mysqli_query($connect, "delete from categories where id = " . $_GET['del_cat_id'])) {
        redirect_page('categories_ui.php?status=done_delete');
    } else {
        echo "Error in delete";
    }
    mysqli_close($connect);
}


// Insert And Update categories
if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'] ? $_POST['category_id'] : 'null';
    $name = htmlspecialchars($name);
    $connect = db_connect();
    if (empty($_POST['edit_cat_id'])){
        $status = 'done';
        $sql = "INSERT INTO `categories`(`name`,`category_id`) VALUES ('$name',$category_id)";
    }else{
        $status = 'updated';
        $sql= "UPDATE `categories` SET `name`='$name',`category_id`=$category_id WHERE id= ".$_POST['edit_cat_id'];
    }

    if (mysqli_query($connect, $sql)) {
        redirect_page('categories_ui.php?status='.$status);
    } else {
        echo "Error";
    }
    mysqli_close($connect);
} else {
    redirect_page('categories_ui.php?status=empty');
}
