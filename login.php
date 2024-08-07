<?php
require_once 'config.php';
if (!empty($_POST['user']) && !empty($_POST['password'])) {
    $email = '';
    $mobile = '';
    $password = htmlspecialchars($_POST['password']);
    // Filter on Form
    $filtered_email = htmlspecialchars(trim(filter_var($_POST['user'], FILTER_SANITIZE_EMAIL)));
    if ($valid_email = filter_var($filtered_email, FILTER_VALIDATE_EMAIL)) {
        $email = $valid_email;
        echo $email;
    } elseif ($valid_mobile = filter_var(htmlspecialchars(filter_var($_POST['user'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^(\+2)\d{11}$/']])))) {
        $mobile  = $valid_mobile;
        echo $mobile;
    } else {
        redirect_page('login_ui.php?status=invalid');
    }
    //Connect DB
    $connect = db_connect();
    $sql = "SELECT `name`,`email`,`mobile`,`role` FROM users WHERE (email = '$email' or mobile = '$mobile') and password = md5('$password')";
    $result = mysqli_query($connect, $sql);
    if ($user = mysqli_fetch_assoc($result)) {
        if ($user['role'] == 'admin') {
            if (!empty($_POST['remember_me'])) {
               setcookie('name',$user['name'],time()+60*60+24*30);
               setcookie('email',$user['email'],time()+60*60+24*30);
               setcookie('mobile',$user['mobile'],time()+60*60+24*30);
               setcookie('role',$user['role'],time()+60*60+24*30);
            }
            session_start();
            $_SESSION['user'] = $user;
            require_once 'mail.php';
            // sendMail($user['email'],$user['name'],'Login Mail!',"Welcome ".$user['name'] . " Some One Try To login to your account in store in " . date('Y-m-d h:i:s a'));
            redirect_page('home.php');
        }else{
            redirect_page('login_ui.php?status=not_auth');    
        }
    } else {
        redirect_page('login_ui.php?status=user_not_found');
    }
} else {
    redirect_page('login_ui.php?status=empty');
}
