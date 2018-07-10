<?php

define('DB_MAIN', 'localhost|root|root|grundkurs');

// Connect to database db1
$db = new my_db(DB_MAIN);

$rows = $db->fetchAll('SELECT * FROM pages');

var_dump($rows);

class my_db{

    private static $databases;
    private $connection;

    public function __construct($connDetails){
        if(!is_object(self::$databases[$connDetails])){
            list($host, $user, $pass, $dbname) = explode('|', $connDetails);
            $dsn = "mysql:host=$host;dbname=$dbname";
            self::$databases[$connDetails] = new PDO($dsn, $user, $pass);
        }
        $this->connection = self::$databases[$connDetails];
    }

    public function fetchAll($sql){
        $args = func_get_args();
        array_shift($args);
        $statement = $this->connection->prepare($sql);
        $statement->execute($args);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}