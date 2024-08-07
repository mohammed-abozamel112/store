<?php
$active = "products";
include('header.php');
require_once('config.php');
if (!empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $connect = db_connect();
    $select_query = "select  * from products where  id = '$product_id' ";
    $result = mysqli_query($connect, $select_query);
    $product = mysqli_fetch_assoc($result);
    mysqli_close($connect);
    $connect_2 = db_connect();
    $category_id = $product['category_id'];
    $select_query_category = "select  * from categories where  id = '$category_id' ";
    $result_2 = mysqli_query($connect_2, $select_query_category);
    $category = mysqli_fetch_assoc($result_2);
    mysqli_close($connect_2);

    $connect3 = db_connect();
    $porduct_images_qry = "SELECT * FROM `product_images` where product_id = '$product_id'";
    $result_3 = mysqli_query($connect3, $porduct_images_qry);
    mysqli_close($connect3);
}
?>
<main class="flex-shrink-0">
    <div class="container bg-light">
        <h3>Full Details Of Product</h3>
        <div class="card">
            <div class="row g-0">
                <div class="col-7">
                    <div class="row">
                        <?php
                        while ($image = mysqli_fetch_assoc($result_3)) {
                        ?>
                            <img src="<?= $image['url'] ?>" class="img-thumbnail border-1 col-6" alt="...">
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card-body">
                        <h2 class="card-title mb-5">Name: <?= $product['name'] ?></h2>
                        <h2 class="card-title mb-5">Category: <?= $category['name'] ?></h2>
                        <h2 class="card-title mb-5">Price: <?= $product['unit_price'] ?> per <?= $product['unit_type'] ?></h2>
                        <h2 class="card-title mb-5">Created At : <?= date_format(date_create($product['created_at']), 'F j, Y, g:i a') ?></h2>
                        <h6 class="card-title mb-5">Description: <?= $product['comment'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('footer.php');
?>