<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="post" action="login.php">

            <img class="mb-4" src="store.webp" alt="" width="150">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <?php if (!empty($_GET['status']) && $_GET['status'] == 'empty') { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Email - Mobile & Password Is required</strong>
                </div>
            <?php }elseif (!empty($_GET['status']) && $_GET['status'] == 'invalid') { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Invalid Data</strong>
                </div>
            <?php }elseif (!empty($_GET['status']) && $_GET['status'] == 'user_not_found') { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>user not found</strong>
                </div>
            <?php }elseif (!empty($_GET['status']) && $_GET['status'] == 'not_auth') { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Not Auth</strong>
                </div>
            <?php }elseif (!empty($_GET['status']) && $_GET['status'] == 'admins_only') { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>admins only</strong>
                </div>
            <?php } ?>
            <div class="form-floating">
                <input type="text" name="user" class="form-control" id="floatingInput" placeholder="x">
                <label for="floatingInput">Email - Mobile</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="1" name="remember_me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy;<?= date('Y') ?></p>
        </form>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>