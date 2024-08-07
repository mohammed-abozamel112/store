<?php
include_once 'header.php';
require_once 'config.php';
$connect = db_connect();
$get_main_categories_result = mysqli_query($connect, "select * from categories where category_id is null");
$get_select_main_categories_result = mysqli_query($connect, "select * from categories where category_id is null");
$edit_name = '';
$edit_category_id = '';
if (!empty($_GET['edit_cat_id'])) {
    $get_edit_category_result = mysqli_query($connect, 'select * from categories where id= ' . $_GET['edit_cat_id']);
    if ($edit_category = mysqli_fetch_assoc($get_edit_category_result)) {
        $edit_name = $edit_category['name'];
        $edit_category_id = $edit_category['category_id'];
    }
}
?>
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Categories</h1>

        <div class="rounded border p-3">
            <h5>Add New Category</h5>
            <form method="post" action="categories.php">
                <?php if (!empty($_GET['edit_cat_id'])) { ?>
                    <input type="hidden" value="<?= $_GET['edit_cat_id'] ?>" name="edit_cat_id">
                <?php } ?>
                <?php if (!empty($_GET['status']) && $_GET['status'] == 'empty') { ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Name is Empty</strong>
                    </div>
                <?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'done') { ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Category Added</strong>
                    </div>
                <?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'done_delete') { ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Category Deleted</strong>
                    </div>
                <?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'updated') { ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Category Updated</strong>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="<?= $edit_name ?>" type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Name Of Category">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Main Category</label>
                            <select class="form-select form-select-lg" name="category_id" id="category_id">
                                <option selected value="">Select one</option>
                                <?php while ($main_category = mysqli_fetch_assoc($get_main_categories_result)) {
                                    $main_category_name = $main_category['name'];
                                    $main_category_id = $main_category['id'];
                                    $selected = $main_category_id == $edit_category_id ? "selected" : '';
                                    echo "<option $selected value='$main_category_id'>$main_category_name</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <?= !empty($_GET['edit_cat_id']) ? "update" : 'Save' ?>
                    </button>
                </div>
            </form>
        </div>

        <div class="m-2">
            <div class="row">
                <?php while ($main_category = mysqli_fetch_assoc($get_select_main_categories_result)) {
                    $get_sub_categories_result = mysqli_query($connect, "select * from categories where category_id = " . $main_category['id']);
                ?>
                    <div class="col-md-4 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title text-primary"><?= $main_category['name'] ?></h4>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="categories_ui.php?edit_cat_id=<?= $main_category['id'] ?>">
                                            <i class="fa-solid fa-pen-to-square fa-bounce mx-2" style="color: #2270f7;font-size: 18px"></i>
                                        </a>
                                        <a href="categories.php?del_cat_id=<?= $main_category['id'] ?>">
                                            <i class="fa-solid fa-trash fa-shake" style="color: #a81a1a;font-size: 18px;"></i>
                                        </a>
                                    </div>
                                </div>

                                <?php while ($sub_cateogry = mysqli_fetch_assoc($get_sub_categories_result)) {
                                    $sub_cateogry_name = $sub_cateogry['name']; ?>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class='card-text text-success fw-bold'>- <?= $sub_cateogry_name ?></p>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a href="categories_ui.php?edit_cat_id=<?= $sub_cateogry['id'] ?>">
                                                <i class="fa-solid fa-pen-to-square fa-bounce mx-2" style="color: #2270f7;font-size: 18px"></i>
                                            </a>
                                            <a href="categories.php?del_cat_id=<?= $sub_cateogry['id'] ?>">
                                                <i class="fa-solid fa-trash fa-shake" style="color: #a81a1a;font-size: 18px;"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php include_once 'footer.php' ?>