<?php
require_once('config.php');
// Edit Product
if (!empty($_POST['edit_product_id'])) {
    $edit_product_id = $_POST['edit_product_id'];

    if (!(empty($_POST['name']) && empty($_POST['category_id']) && empty($_POST['unit']) && empty($_POST['unit_price']))) {
        $name = trim($_POST['name']);
        $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
        $unit = (empty($_POST['unit']) ? 'null' : $_POST['unit']);
        $unit_price = (empty($_POST['unit_price']) ? 'null' : $_POST['unit_price']);
        $comment = (empty($_POST['comment']) ? 'null' : $_POST['comment']);

        $connect = db_connect();
        $query_update = "update  products  set name = '$name' , category_id = $category_id , unit_type = '$unit' , unit_price = $unit_price ,  comment = '$comment'
                     where id = " . $edit_product_id;
        $result = mysqli_query($connect, $query_update);
        if ($result) {
            header('location:product_details_ui.php?product_id=' . $edit_product_id);
        } else {
            echo mysqli_error($connect);
            header('location:product_edit_ui.php?info=' . mysqli_errno($connect) . '&edit_product_id=' . $edit_product_id);
        }
    }
}
