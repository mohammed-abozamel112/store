<?php
$active = "products";
include('header.php');
require_once('config.php');
if (!empty($_GET['edit_product_id'])) {
    $product_id = $_GET['edit_product_id'];
    $connect = db_connect();
    $select_query = "select  * from products where  id = '$product_id' ";
    $result = mysqli_query($connect, $select_query);
    $product = mysqli_fetch_assoc($result);

    $name = (empty($product['name']) ? '' : $product['name']);
    $category_id = (empty($product['category_id']) ? '' : $product['category_id']);
    $unit = (empty($product['unit_type']) ? '' : $product['unit_type']);
    $unit_price = (empty($product['unit_price']) ? '' : $product['unit_price']);
    $comment = (empty($product['comment']) ? '' : $product['comment']);
}
?>
<main class="container-fluid">
    <div class="bg-light p-5 rounded">
        <h3>Edit Product Data</h3>
        <?php if (!empty($_GET['info']) && $_GET['info'] == "empty") { ?>
            <div class="alert alert-danger" role="alert">
                Must Complete Data !
            </div>
        <?php  } ?>
        <form method="post" enctype="multipart/form-data" action="product_edit.php">
            <?php
            if (!empty($product_id)) {
            ?>
                <input type="hidden" name="edit_product_id" value="<?= $product_id ?>">
            <?php } ?>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Name</label>
                    <input required name="name" type="text" class="form-control" id="formControlInput" value="<?= $name ?>">
                </div>
                <div class="col-6">
                    <?php
                    $connect = db_connect();
                    $result = mysqli_query($connect, "select * from categories");
                    mysqli_close($connect);
                    ?>
                    <label for="formControlInput" class="form-label">Category</label>
                    <select required name="category_id" class="form-select" aria-label="Default select">
                        <option value="null">Open this select menu</option>
                        <?php while ($all_category = mysqli_fetch_assoc($result)) { ?>
                            <option <?php if ($all_category['id'] == $category_id) echo "selected" ?> value="<?= $all_category['id'] ?>"><?= $all_category['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Unit</label>
                    <select required name="unit" class="form-select" aria-label="Default select">
                        <option value="null">Open this select menu</option>
                        <option <?php if ('kg' == $unit) echo "selected" ?> value="kg">Kilo</option>
                        <option <?php if ('liter' == $unit) echo "selected" ?> value="liter">Liter</option>
                        <option <?php if ('piece' == $unit) echo "selected" ?> value="piece">Piece</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Unit Price</label>
                    <input required name="unit_price" type="number" class="form-control" id="formControlInput" value="<?= $unit_price ?>">
                </div>
            </div>
            <div class="row mb-2">

                <div class="col-6">
                    <label for="formControlInput" class="form-label">Comment</label>
                    <div class="form-floating">
                        <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"><?= $comment ?></textarea>
                        <label for="floatingTextarea">Comment</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</main>

<?php
include('footer.php');
?>