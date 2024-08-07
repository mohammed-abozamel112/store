<?php
include('header.php');
require_once('config.php');
require_once('User.php');
if (!empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user = User::find($user_id);
}
?>
<main class="flex-shrink-0">
    <div class="container bg-light">
        <h3>Full Details Of User</h3>
        <div class="card">
            <div class="row g-0">
                <div class="col-12">
                    <div class="card-body">
                        <h2 class="card-title mb-5">Name: <?= $user->name ?></h2>
                        <h2 class="card-title mb-5">Email: <?= $user->email ?></h2>
                        <h2 class="card-title mb-5">Role: <?= $user->role ?></h2>
                        <h2 class="card-title mb-5">Mobile: <?= $user->mobile ?></h2>
                        <h2 class="card-title mb-5">Created At : <?= date_format(date_create($user->created_at), 'F j, Y, g:i a') ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('footer.php');
?>