<?php
require_once 'config.php';

class User
{
    public $name, $email, $mobile, $role, $created_by;
    private $password;

    public function __construct($name, $email, $password = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = md5($password);
    }

    public function create()
    {
        try {
            $connect = pdo_connect();
            $statement = $connect->prepare("insert into users (name, email, password, mobile,role) values (:name,:email,:password,:mobile,:role);");
            $statement->bindValue('name', $this->name);
            $statement->bindValue('email', $this->email);
            $statement->bindValue('password', $this->password);
            $statement->bindValue('mobile', $this->mobile);
            $statement->bindValue('role', $this->role);
            $statement->execute();
            return $connect->lastInsertId();
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }

    public static function destroy($id)
    {
        try {
            $connect = pdo_connect();
            $statement = $connect->prepare("delete from users where id = :id");
            $statement->bindValue('id', $id);
            $statement->execute();
            $connect = null;
            return true;
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }

    public static function find($id)
    {
        try {
            $connect = pdo_connect();
            $statement = $connect->prepare("select * from users where id = :id");
            $statement->bindValue('id', $id);
            $statement->execute();
            $connect = null;
            if ($user = $statement->fetchObject()) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }

    public static function all()
    {
        try {
            $users = [];
            $connect = pdo_connect();
            $statement = $connect->prepare("select * from users");
            $statement->execute();
            $connect = null;
            while ($user = $statement->fetchObject()) {
                $users[] = $user;
            }
            return $users;
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }

    public function update($id)
    {
        try {
            $connect = pdo_connect();
            $statement = $connect->prepare("UPDATE `users` SET `name`=':name',`email`=':email',`mobile`=':mobile',`role`=':role' WHERE id = 1");
            // $statement->bindValue('id', $id);
            $statement->bindValue('name', $this->name);
            $statement->bindValue('email', $this->email);
            $statement->bindValue('mobile', $this->mobile);
            $statement->bindValue('role', $this->role);
            $statement->execute();
            $connect = null;
            return true;
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }
}

$user = new User('test', 'test@mail.com');
$user->role = 'admin';
$user->mobile = '+2010076512';
var_dump($user->update(1));
