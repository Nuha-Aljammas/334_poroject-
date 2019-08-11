<?php

class Connection
{
    private $user;
    private $password;
    private $db;
    private $host;

    private static $instance;

    private function __construct()
    {
    }

    public static function instance()
    {
        if (empty(self::$instance)) {
            self::$instance = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
        return self::$instance;
    }

    public static function insert($table, $array)
    {
        $cols = "";
        $qmarks = "";
        foreach ($array as $column_name => $column_value) {
            $qmarks .= "?,";
            $cols .= self::$instance->real_escape_string($column_name) . ",";
        }
        $qmarks = trim($qmarks, ",");
        $cols = trim($cols, ",");

        $prepare_string = "INSERT INTO " . self::$instance->real_escape_string($table) ."(" . $cols . ")" . " values ($qmarks) ";

        return $prepare_string;
    }
}
