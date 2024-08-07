<?php
session_start();
require_once 'config.php';
if (empty($_SESSION['user'])) {
    if (!empty($_COOKIE['name']) && !empty($_COOKIE['email']) && !empty($_COOKIE['mobile']) && !empty($_COOKIE['role'])) {
        $_SESSION['user']['name'] = $_COOKIE['name'];
        $_SESSION['user']['email'] = $_COOKIE['email'];
        $_SESSION['user']['mobile'] = $_COOKIE['mobile'];
        $_SESSION['user']['role'] = $_COOKIE['role'];
    } else {
        redirect_page('login_ui.php?status=admins_only');
    }
}
if (!empty($_COOKIE['lang']) && $_COOKIE['lang']  == 'ar') {
    require_once 'lang_ar.php';
} else {
    require_once 'lang_en.php';
}

?>
<!doctype html>
<html lang="<?= $lang['lang'] ?>" dir="<?= $lang['dir'] ?>" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Store</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <?php if ($lang['lang'] == 'ar') { ?>
        <link href="css/bootstrap.rtl.css" rel="stylesheet">
    <?php } else { ?>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    <?php } ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        main>.container {
            padding: 60px 15px 0;
        }
    </style>

</head>

<body class="d-flex flex-column h-100">

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php"><?= $lang['Store'] ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php"><?= $lang['Home'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories_ui.php"><?= $lang['Categories'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products_show.php"><?= $lang['Products'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users_show.php"><?= $lang['users'] ?></a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <h5 class="text-white mt-2 mx-2"><?= $_SESSION['user']['name'] ?></h5>
                        <a href="change_lang.php?lang=<?= $lang['lang_change_key'] ?>" class="btn btn-warning mx-2 fw-bold"><?= $lang['lang_btn'] ?></a>
                        <a href="logout_prosess.php" class="btn btn-success fw-bold"><?= $lang['Logout'] ?></a>
                    </form>
                </div>
            </div>
        </nav>
    </header>