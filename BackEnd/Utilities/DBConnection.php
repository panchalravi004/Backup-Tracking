<?php

    class DBConnect{

        public static function connect(){
            $conn = null; 

            include_once dirname(__FILE__).'/DBConstants.php';

            $conn = new MySQLi(DB_HOST,DB_USERNAME, DB_PASSWORD, DB_NAME);

            return $conn;

        }

    }