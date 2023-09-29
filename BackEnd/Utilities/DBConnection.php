<?php

    class DBConnect{

        private $conn;

        public function __construct(){}

        public function connect(){

            include_once dirname(__FILE__).'/DBConstants.php';

            $this->conn = new MySQLi(DB_HOST,DB_USERNAME, DB_PASSWORD, DB_NAME);

            return $this->conn;

        }

    }
    