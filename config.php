<?php
const HOSTNAME = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'store';

const DSN = "mysql:host=localhost;dbname=store";

function db_connect()
{
    return mysqli_connect(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
}

function redirect_page($url)
{
    header('location:' . $url);
    exit();
}

function pdo_connect()
{
    return new PDO(DSN, DB_USERNAME, DB_PASSWORD);
}
