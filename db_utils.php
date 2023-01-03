<?php
require_once("constants.php");

class Database
{
    private $hashing_salt = "dsaf7493^&$(#@Kjh";

    private $conn;

    public function __construct($configFile = "config.ini")
    {
        if ($config = parse_ini_file($configFile)) {
            $host = $config["host"];
            $database = $config["database"];
            $user = $config["user"];
            $password = $config["password"];
            $this->conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    function insertUser($name,$surname, $email, $password, $address, $phone_number)
    {
        try {
            $sql_existing_user = "SELECT * FROM " . TBL_ACCOUNT . " WHERE " . COL_USER_EMAIL . "= :email";
            $st = $this->conn->prepare($sql_existing_user);
            $st->bindValue(":email", $email, PDO::PARAM_STR);
            $st->execute();
            if ($st->fetch()) {
                return false;
            }
            
            $passwordHash = crypt($password, $this->hashing_salt);

            $sql_insert = "INSERT INTO " . TBL_ACCOUNT . " (".COL_ACCOUNT_NAME.","
                                                          .COL_ACCOUNT_SURNAME.","
                                                          .COL_ACCOUNT_EMAIL.","
                                                          .COL_ACCOUNT_PASSWORD.","
                                                          .COL_ACCOUNT_PHONE_NUMBER.","
                                                          .COL_ACCOUNT_ADDRESS.","
                                                          .COL_ACCOUNT_ROLE_ID.")"
                        ." VALUES (:name, :surname, :email, :password, :phone_number, :address,2)";

            $st = $this->conn->prepare($sql_insert);
            $st->bindValue("name", $name, PDO::PARAM_STR);
            $st->bindValue("surname", $surname, PDO::PARAM_STR);
            $st->bindValue("email", $email, PDO::PARAM_STR);
            $st->bindValue("password", $passwordHash, PDO::PARAM_STR);
            $st->bindValue("phone_number", $phone_number, PDO::PARAM_STR);
            $st->bindValue("address", $address, PDO::PARAM_STR);
            
            return $st->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function checkLogin($email, $password)
    {
        try {
            $hashed_password = crypt($password, $this->hashing_salt);
            $sql = "SELECT * FROM " . TBL_USER . " WHERE " . COL_ACCOUNT_USERNAME . "=:email and " . COL_ACCOUNT_PASSWORD . "=:password";
            $st = $this->conn->prepare($sql);
            $st->bindValue("email", $email, PDO::PARAM_STR);
            $st->bindValue("password", $hashed_password, PDO::PARAM_STR);
            $st->execute();
            return $st->fetch();
        } catch (PDOException $e) {
            return null;
        }
    }

    public function insertArticle($name,$price,$quantity,$description,$way_of_use,$article_type,$image)
    {
        try {
            $sql = "INSERT INTO " . TBL_ARTICLE . " (".COL_ARTICLE_NAME.","
                                                          .COL_ARTICLE_PRICE.","
                                                          .COL_ARTICLE_DESCRIPTION.","
                                                        .COL_ARTICLE_QUANTITY.","
                                                        .COL_ARTICLE_WAY_OF_USE.","
                                                        .COL_ARTICLE_IMAGE.","
                                                        .COL_ARTICLE_TYPE.")"
                          ."VALUES (:name, :price, :quantity,:description,:way_of_use,:image,:article_type)";
            
            $st = $this->conn->prepare($sql);
            $st->bindValue("name", $name, PDO::PARAM_STR);
            $st->bindValue("price", $price, PDO::PARAM_STR);
            $st->bindValue("description", $description, PDO::PARAM_STR);
            $st->bindValue("quantity", $quantity, PDO::PARAM_STR);
            $st->bindValue("way_of_use", $way_of_use, PDO::PARAM_STR);
            $st->bindValue("image", $image, PDO::PARAM_INT);
            $st->bindValue("article_type",$article_type,PDO::PARAM_STR);
            return $st->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateArticle($id,$name,$price,$quantity,$description,$way_of_use,$image,$article_type){
        try {
            $sql = "UPDATE " . TBL_ARTICLE . "SET ".
                   COL_ARTICLE_NAME. "=:name ". "," .COL_ARTICLE_PRICE."=:price ". ","
                    .COL_ARTICLE_DESCRIPTION."=:description ". ","
                    .COL_ARTICLE_WAY_OF_USE."=:way_of_use ". ","
                    .COL_ARTICLE_TYPE."=:article_type ". ","
                    .COL_ARTICLE_IMAGE."=:image "." WHERE " . COL_ARTICLE_ID . "=:id";

            $st = $this->conn->prepare($sql);
            $st->bindValue("id",$id,PDO::PARAM_INT);
            $st->bindValue("name",$name, PDO::PARAM_STR);
            $st->bindValue("price",$price,PDO::PARAM_STR);
            $st->bindValue("quantity",$quantity,PDO::PARAM_STR);
            $st->bindValue("description",$description,PDO::PARAM_STR);
            $st->bindValue("way_of_use",$way_of_use,PDO::PARAM_STR);
            $st->bindValue("image",$image,PDO::PARAM_STR);

            return $st->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    public function deleteArticle($id){
        try{
            $sql = "UPDATE ". TBL_ARTICLE ."SET ". COL_ARTICLE_DELETED ."=:deleted ".
                    " WHERE ". COL_ARTICLE_ID ."=:id";
            $st = $this->conn->prepare($sql);
            $st->bindValue("id",$id,PDO::PARAM_INT);
            $st->bindValue("deleted",1,PDO::PARAM_INT);

            return $st->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    public function getArticles()
    {
        try {
            $sql = "SELECT * FROM " . TBL_ARTICLE;
            $st = $this->conn->prepare($sql);
            $st->execute();
            return $st->fetchAll();
        } catch (PDOException $e) {
            return array();
        }
    }

    public function getArticlesByType($article_type){
        try{
            $sql = "SELECT * FROM " .TBL_ARTICLE . " WHERE " .COL_ARTICLE_TYPE."=:article_type";
            $st = $this->conn->prepare($sql);
            $st->bindValue("article_type",$article_type,PDO::PARAM_STR);
            $st->execute();
            return $st->fetchAll();
        }catch (PDOException $e){
            return false;
        }
    }

    /*ORDER AND ORDER ITEM*/
    public function createOrderAndOrderItems(array $articles){

    }
}