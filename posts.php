<?php
// Start import database
$connect = new PDO('mysql:dbname=;host=127.0.0.1', "root", "");
$show_databases = $connect->query("show databases");
$show_databases->execute();
$all_db = [];
while ($result = $show_databases->fetchObject()) {
    $all_db[$result->Database] = true;
}
if (empty($all_db["posts"])) {
    $sql = file_get_contents('posts.sql');
    $result = $connect->exec($sql);
    echo "<hr> Data Imported ! <hr>";
}
$connect->exec('use posts');
// End import database



//Start Delete Post

/* if (!empty($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $connect->exec('delete from posts where id = ' . $del_id); // SQL injection
} */



//With PDO Class Prepare Statment
if (!empty($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $statment = $connect->prepare('delete from posts where id = :id and name = :x');
    $statment->bindValue('id', $del_id);
    $statment->bindValue('x', 'ahmed');
    $statment->execute();
}



//With mysqli class Prepare Statment
/* if (!empty($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $conn_class = new mysqli('localhost', 'root', '', 'posts');
    $statment = $conn_class->prepare("delete from posts where id = ?");
    $statment->bind_param("i", $del_id);
    //  i refrance for datatype 
    // The argument may be one of four types:
    //     i - integer
    //     d - double
    //     s - string
    
    $statment->execute();
} */
//END Delete Post




$offset = !empty($_GET['offset']) ? $_GET['offset'] : 0;

echo "<h4>paginated Posts Data</h4> <hr>";

if ($offset >= 0) {
    $statment = $connect->query("select * from posts limit 10 offset $offset");
} else {
    $statment = $connect->query("select * from posts limit 10 offset 0");
}
while ($d = $statment->fetchObject()) {
    $id = $d->id;
    echo $id, "-", $d->name, " || ", date_format(date_create($d->created_at), "d-m-Y | h:i:s a"),
    "<a style='margin:10px' href='posts.php?del_id=$id'>Delete</a>" . "<br>";
}

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <br>
    <a href="posts.php?offset=<?= $offset + 10 ?>">Next</a> &nbsp; &nbsp;
    <a href="posts.php?offset=<?= $offset - 10 ?>">prv</a>
</body>

</html>