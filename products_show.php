<?php
$active = "products";
include('header.php');
require_once('config.php');
?>
<main class="flex-shrink-0">
    <div class="container">
        <?php if (!empty($_GET['success']) && $_GET['success'] == "added") { ?>
            <div class="alert alert-success" role="alert">
                New Product Added !
            </div>
        <?php  } elseif (!empty($_GET['success']) && $_GET['success'] == "deleted") { ?>
            <div class="alert alert-warning" role="alert">
                Product Deleted !
            </div>
        <?php } ?>

        <div class="d-flex justify-content-between mb-3">
            <h3>All Products</h3>

            <form class="d-flex" method="post" action="products_show.php">
                <input name="name_search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div>
                <a href="product_add_ui.php" role="button" class="btn btn-secondary">Add new Product</a>
            </div>
        </div>
        <table class="table table-hover table-bordered text-center table-primary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Unit price</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $connect = db_connect();
                if (empty($_POST['name_search'])) {
                    $result = mysqli_query($connect, "select * from products");
                } else {
                    $search_name = trim("%" . $_POST['name_search'] . "%");
                    $result = mysqli_query($connect, "select * from products where name like '$search_name'");
                }
                mysqli_close($connect);
                ?>
                <?php
                $i = 1;
                while ($all_products = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td>
                            <a title="Show Details of product" target="_blank" href="product_details_ui.php?product_id=<?= $all_products['id'] ?>" style="text-decoration: none; font-weight: bold;"><?= $all_products['name'] ?> </a>
                        </td>
                        <?php
                        $connect_2 = db_connect();
                        $result_2 = mysqli_query($connect_2, "select  name from categories where  id = " . $all_products['category_id']);
                        mysqli_close($connect_2);
                        ?>
                        <td> <?php if ($category = mysqli_fetch_assoc($result_2)) echo $category['name'] ?> </td>
                        <td> <?= $all_products['unit_type'] ?> </td>
                        <td> <?= $all_products['unit_price'] ?> </td>
                        <td> <?= $all_products['comment'] ?> </td>
                        <td> <?= date_format(date_create($all_products['created_at']), 'F j, Y, g:i a') ?> </td>
                        <td>
                            <div class="d-flex justify-content-center ">
                                <a href="product_edit_ui.php?edit_product_id=<?= $all_products['id'] ?>" title="Edit Product" class="mt-2">
                                    <i class="fa fa-edit" style="font-size:20px;color:darkblue"></i>
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $all_products['id'] ?>">
                                    <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $all_products['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $all_products['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel<?= $all_products['id'] ?>">Delete Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you need to Delete product <?= $all_products['name'] ?> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a role="button" href="product_add.php?delete_product_id=<?= $all_products['id'] ?>" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                if ($result->num_rows  ==  0) echo "<h1> No Products Result.. </h1>";
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php
include('footer.php');
?>