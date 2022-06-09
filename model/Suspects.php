<?php

class Suspects extends Connection
{
    public $default_table = 'tbl_suspects';

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
                SET lastname = '".$data['lastname']."',
                firstname = '".$data['firstname']."',
                middlename = '".$data['middlename']."',
                birthdate = '".$data['birthdate']."',
                gender = '".$data['gender']."',
                street = '".$data['street']."',
                region_c = '".$data['region']."',
                province_c = '".$data['province']."',
                lgu_c = '".$data['lgu']."',
                contact_information = ".$data['contact_no'].",
                status = '".$data['current_status']."',
                date_updated = NOW()
                WHERE id = ".$data['id']."";

        $getResult = $this->db->query($sql);
        return $data;
    }

    public function insert($data) 
    {
        $sql = "INSERT INTO $this->default_table 
                SET lastname = '".$data['lastname']."',
                firstname = '".$data['firstname']."',
                middlename = '".$data['middlename']."',
                gender = '".$data['gender']."',
                street = '".$data['street']."',
                region_c = '".$data['region']."',
                province_c = '".$data['province']."',
                lgu_c = '".$data['lgu']."',
                contact_information = '".$data['contact_no']."',
                birthdate = '".$data['birthdate']."',
                status = '".$data['current_status']."',
                date_created = NOW()";

        $getResult = $this->db->query($sql);
        $last_id = $this->db->insert_id;
        
        return $last_id;
    }
}