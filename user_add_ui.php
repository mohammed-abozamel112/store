<?php
include('header.php');
require_once('config.php');
?>
<main class="flex-shrink-0">
    <div class="container bg-light">
        <h3>Add New User</h3>
        <?php if (!empty($_GET['info']) && $_GET['info'] == "empty") { ?>
            <div class="alert alert-danger" role="alert">
                Must Complete Data !
            </div>
        <?php  } ?>
        <form method="post" action="user_add.php">
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Name</label>
                    <input required name="name" type="text" class="form-control" id="formControlInput">
                </div>

            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Email</label>
                    <input required name="email" type="email" class="form-control" id="formControlInput">
                </div>

            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Password</label>
                    <input required name="password" type="password" class="form-control" id="formControlInput">
                </div>

            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Mobile</label>
                    <input required name="mobile" type="text" class="form-control" id="formControlInput">
                </div>

            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Role</label>
                    <select required name="role" class="form-select" aria-label="Default select">
                        <option value="null">Open this select menu</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
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