<?php

include_once dirname(__FILE__) . "/NotORM.php";

class Connection {

    private static $instancia;
    private $server;
    private $user;
    private $password;
    private $library;
    private $dbh;

    private function __construct() {

// $this->server = 'mysql:host=localhost;dbname=oxiris_biblioteca';
// $this->user = 'oxiris_bibli';
//  $this->password = 'biblioteca';
        $this->server = 'mysql:host=localhost;dbname=biblioteca';
        $this->user = 'root';
        $this->password = 'quisquella';

        $structure = new NotORM_Structure_Convention(
                $primary = "id_%s", // id_$table
                $foreign = "id_%s", // id_$table
                $table = "%ss", // {$table}
                $prefix = "" // wp_$table
        );

        $this->dbh = new PDO($this->server, $this->user, $this->password, array(PDO::ATTR_PERSISTENT => true));
        $this->library = new NotORM($this->dbh, $structure);
//        $this->library->debug = false;
//        $this->library->debug=true;
    }

    public static function getInstance() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    public function getLibrary() {
        return $this->library;
    }

    function query($query) {
        try {
            $stmt = $this->dbh->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
        }
        return null;
    }

}
