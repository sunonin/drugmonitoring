<?php

class StatusChange extends Connection
{
    public $default_table = 'tbl_status_change';

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

    public function update($data)
    {
        $sql = "UPDATE $this->default_table 
                SET prev_status = '".$data['prev_status']."',
                current_status = '".$data['current_status']."',
                region_c = '".$data['region']."',
                province_c = '".$data['province']."',
                lgu_c = '".$data['lgu']."',
                date_updated = NOW()
                WHERE sid = ".$data['id']."";

        $getResult = $this->db->query($sql);
        return $data;
    }

    public function insert($data) 
    {
        $sql = "INSERT INTO $this->default_table 
                SET sid = '".$data['id']."',
                prev_status = '".$data['current_status']."',
                current_status = '".$data['current_status']."',
                region_c = '".$data['region']."',
                province_c = '".$data['province']."',
                lgu_c = '".$data['lgu']."',
                date_created = NOW()";

        $getResult = $this->db->query($sql);
        $last_id = $this->db->insert_id;
        
        return $last_id;
    }
}