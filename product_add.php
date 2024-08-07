<?php
require_once('config.php');
// Add new Product
echo "<pre>";
var_dump($_FILES['images']);
echo "</pre>";
if (!(empty($_POST['name']) && empty($_POST['category_id']) && empty($_POST['unit']) && empty($_POST['unit_price']))) {
    $name = trim($_POST['name']);
    $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $unit = (empty($_POST['unit']) ? 'null' : $_POST['unit']);
    $unit_price = (empty($_POST['unit_price']) ? 'null' : $_POST['unit_price']);
    $comment = (empty($_POST['comment']) ? 'null' : $_POST['comment']);
    $connect = db_connect();
    $query_insert = "insert into products  (name , category_id , unit_type , unit_price  , comment)
                    values ('$name', $category_id , '$unit' , $unit_price  ,'$comment')";
    $result = mysqli_query($connect, $query_insert);
    $product_id = mysqli_insert_id($connect);
    if (!empty($_FILES['images'])) {
        $i = 1;
        foreach ($_FILES['images']['name'] as $key => $name) {
            $file_name = "product_images/" . date('Ymdhis') . '_' . $i++ . "_" . $name;
            move_uploaded_file($_FILES['images']['tmp_name'][$key], $file_name);
            $product_image_qry = "INSERT INTO `product_images`(`product_id`, `url`) VALUES ('$product_id','$file_name')";
            $product_image_qry_result = mysqli_query($connect, $product_image_qry);
        }
    }

    if ($result) {
        header('location:product_details_ui.php?product_id=' . $product_id);
    } else {
        header('location:product_add_ui.php?info=empty');
    }
}
//Delete Product
if (!empty($_GET['delete_product_id'])) {
    $delete_product_id = $_GET['delete_product_id'];
    $connect = db_connect();
    $delete_query = "delete from products where id = '$delete_product_id'";
    $data_result = mysqli_query($connect, "select * from products where id = $delete_product_id");

    $porduct_images_qry = "SELECT * FROM `product_images` where product_id = '$delete_product_id'";
    $result_images_qry = mysqli_query($connect, $porduct_images_qry);
    while ($image = mysqli_fetch_assoc($result_images_qry)){
        unlink($image['url']);
    }
    $result_delete_images = mysqli_query($connect, "delete from product_images where product_id = '$delete_product_id'");

    $result = mysqli_query($connect, $delete_query);
    if (mysqli_error($connect) == "") {
        header('location:products_show.php?success=deleted');
    } else {
        header('location:products_show.php?err=' . mysqli_errno($connect));
    }
    mysqli_close($connect);
}
