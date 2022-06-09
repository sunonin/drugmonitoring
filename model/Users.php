<?php

class Users extends Connection
{
    public $default_table = 'tbl_users';

    function __construct()
    {
        if (!isset($this->db)) {
            $conn = new mysqli($this->hostname, $this->dbUser, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Database is not connected: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    public function getUser($username, $password) 
    {
        $sql = "SELECT * FROM $this->default_table 
                WHERE uname = '".$username."' AND password = '".$password."'";
        $getQry = $this->db->query($sql);
        $result = mysqli_fetch_array($getQry);
        
        return $result;
    } 
}