<?php
$active = "products";
include('header.php');
require_once('config.php');
?>
<main class="flex-shrink-0">
    <div class="container bg-light">
        <h3>Add New Product</h3>
        <?php if (!empty($_GET['info']) && $_GET['info'] == "empty") { ?>
            <div class="alert alert-danger" role="alert">
                Must Complete Data !
            </div>
        <?php  } ?>
        <form method="post" enctype="multipart/form-data" action="product_add.php">
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Name</label>
                    <input required name="name" type="text" class="form-control" id="formControlInput">
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
                            <option value="<?= $all_category['id'] ?>"><?= $all_category['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Unit</label>
                    <select required name="unit" class="form-select" aria-label="Default select">
                        <option value="null">Open this select menu</option>
                        <option value="kg">Kilo</option>
                        <option value="liter">Liter</option>
                        <option value="piece">Piece</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Unit Price</label>
                    <input required name="unit_price" type="number" class="form-control" id="formControlInput">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Images</label>
                    <input name="images[]" multiple class="form-control" type="file" id="formFile">
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Comment</label>
                    <div class="form-floating">
                        <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"></textarea>
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