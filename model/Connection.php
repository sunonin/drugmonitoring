<?php

class Connection
{
	public $hostname 		= 'localhost';
	public $dbUser	 		= 'root';
	public $dbPassword 		= '';
	public $dbName 			= 'drms';

	public function find($id) 
	{
		$sql = "SELECT * FROM $this->default_table WHERE id = $id";
		$getQry = $this->db->query($sql);
        $result = mysqli_fetch_array($getQry);
        
        return $result;
	}

	public function fetch() 
	{
		$sql = "SELECT * FROM $this->default_table";
		$getQry = $this->db->query($sql);
        $data = [];
        
        while($result = mysqli_fetch_array($getQry)) {
        	$data[] = $result;
        }
        
        return $data;
	}

    public function delete($id)
    {
    	$sql = "DELETE FROM $this->default_table WHERE id = $id";
        $getResult = $this->db->query($sql);

    	return $id;
    }

}
