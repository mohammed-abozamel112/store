<?php
require_once('config.php');
require_once('User.php');
// Edit User
if (!empty($_POST['edit_user_id'])) {
    $edit_user_id = $_POST['edit_user_id'];

    if (!(empty($_POST['name']) && empty($_POST['email']) && empty($_POST['mobile']) && empty($_POST['role']))) {
        $user  = new User($_POST['name'], $_POST['email']);
        $user->mobile = $_POST['mobile'];
        $user->role = $_POST['role'];
        if ($user->update($edit_user_id)) {
            header('location:user_details_ui.php?user_id=' . $edit_user_id);
        } else {
            header('location:user_edit_ui.php?edit_user_id=' . $edit_user_id);
        }
    }
}
