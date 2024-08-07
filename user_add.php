<?php
require_once('config.php');
require_once('User.php');
// Add new User
if (!(empty($_POST['name']) && empty($_POST['email']) && empty($_POST['mobile']) && empty($_POST['role']) && empty($_POST['password']))) {
    $user = new User($_POST['name'], $_POST['email'], $_POST['password']);
    $user->mobile = $_POST['mobile'];
    $user->role = $_POST['role'];
    if ($id = $user->create()) {
        header('location:user_details_ui.php?user_id=' . $id);
    } else {
        header('location:user_add_ui.php?info=empty');
    }
}
//Delete User
if (!empty($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];
    if (User::destroy($delete_user_id)) {
        header('location:users_show.php?success=deleted');
    } else {
        header('location:users_show.php');
    }
}
