<?php

class LGUInformation extends Connection
{
    public $default_table = 'tbl_lgu_information';

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

    public function update($id, $population)
    {
        $sql = "UPDATE $this->default_table 
                SET population = '".$population."'
                WHERE id = '".$id."'";

        $result = $this->db->query($sql);

        return $id;
    }

    public function insert($data) 
    {
        $sql = "INSERT INTO $this->default_table 
                SET region_c = '".$data['region_c']."',
                province_c = '".$data['province']."',
                lgu_c = '".$data['lgu']."',
                population = '".$data['population']."'";

        $getResult = $this->db->query($sql);
        $last_id = $this->db->insert_id;
        
        return $last_id;
    }
}