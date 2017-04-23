<?php

require_once ('config/connection.php');

class DB {

    private static $instance = null ;

    final private function __construct($h, $u, $p, $db){

        $this->connection = new mysqli($h, $u, $p, $db);
        $this->connection->query('SET NAMES \'utf8\'');

    }

    public static function getInstance(){

        if (self::$instance == null){

            self::$instance = new self(HOST, USER, PASS, DB);

        }

        return self::$instance ;

    }

    private function __clone() {
    }

    private function __wakeup() {
    }

}