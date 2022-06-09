<?php

class DRCMSManager extends Connection
{
    function __construct() {
        if (!isset($this->db)) {
            $conn = new mysqli($this->hostname, $this->dbUser, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Database is not connected: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

	public function addFlash($type, $message) 
    {
        $data = [
            'type'      => $type, // or 'success' or 'info' or 'warning'
            'title'     => $type == 'success' ? 'Success' : 'Error',
            'message'   => $message,
            'icon'		=> $type == 'success' ? 'check' : 'ban'
        ];

        return $data;
    }

    public function customFetch($name=null, $bdate=null) 
    {
        $sql = "SELECT 
                    o.id,
                    CONCAT(o.lastname, ', ', o.firstname, ' ', substring(o.middlename, 1, 1)) AS name,
                    IF(o.lgu_c != '', CONCAT(o.street, ', ', c.citymun_m, ', ', p.province_m, ', ', r.region_m), '') AS address,
                    o.contact_information AS contact_no,

                    o.status,
                     DATE_FORMAT(o.birthdate, '%m/%d/%Y') as birthdate,
                     CAST(YEAR(NOW()) - YEAR(o.birthdate) AS INT) AS age
                FROM tbl_suspects o
                LEFT JOIN tblregion r ON r.region_c = o.region_c
                LEFT JOIN tblprovince p ON p.province_c = o.province_c
                LEFT JOIN tblcitymun c ON c.citymun_c = o.lgu_c AND c.province_c = o.province_c";

        if (!empty($name) AND !empty($bdate)) {
            $sql .= " WHERE firstname like '%$name%' OR lastname like '%$name%' AND birthdate = '".$bdate."'";
        } elseif (!empty($name)) {
            $sql .= " WHERE firstname like '%$name%' OR lastname like '%$name%'";
        } elseif (!empty($bdate)) {
            $sql .= " WHERE birthdate = '".$bdate."'";
        }

        $getQry = $this->db->query($sql);
        $data = [];
        
        while($result = mysqli_fetch_array($getQry)) {
            $data[] = $result;
        }
        
        return $data;
    }

    public function generateRegions()
    {
        $sql = "SELECT * FROM tblregion";
        $getQry = $this->db->query($sql);
        $regions = [];

         while($result = mysqli_fetch_array($getQry)){
            $regions[$result['region_c']] = $result['region_m'];
        }

        return $regions;
    }


    public function generateProvince($region=null) 
    {
        $sql = "SELECT province_c, province_m FROM tblprovince";
        if (!empty($region)) {
            $sql .= " WHERE region_c = '".$region."'";
        }
         
        $getQry = $this->db->query($sql);
        $data = [];

         while($result = mysqli_fetch_array($getQry)){
            $data[$result['province_c']] = $result['province_m'];
        }

        return $data;
    }

    public function generateLGU($province=null) 
    {
        $sql = "SELECT citymun_c, citymun_m FROM tblcitymun";
        if (!empty($province)) {
            $sql .= " WHERE province_c = '".$province."'";
        }

        $getQry = $this->db->query($sql);
        $data = [];

         while($result = mysqli_fetch_array($getQry)){
            $data[$result['citymun_c']] = $result['citymun_m'];
        }

        return $data;
    }

    public function findSuspect($id) 
    {
        $sql = "SELECT 
                    o.id,
                    o.lastname, 
                    o.firstname, 
                    o.middlename,
                    o.street, 
                    o.gender, 
                    o.lgu_c, 
                    o.province_c, 
                    o.region_c,
                    o.contact_information AS contact_no,
                    o.status,
                     DATE_FORMAT(o.birthdate, '%m/%d/%Y') as birthdate,
                     CAST(YEAR(NOW()) - YEAR(o.birthdate) AS INT) AS age
                FROM tbl_suspects o
                LEFT JOIN tblregion r ON r.region_c = o.region_c
                LEFT JOIN tblprovince p ON p.province_c = o.province_c
                LEFT JOIN tblcitymun c ON c.citymun_c = o.lgu_c AND c.province_c = o.province_c
                WHERE id = $id";

        $getQry = $this->db->query($sql);
        
        $result= mysqli_fetch_array($getQry);
        
        return $result;
    }

    public function findLGUInfo($data) 
    {
        $sql = "SELECT id, population FROM tbl_lgu_information WHERE region_c = '".$data['region']."' AND province_c = '".$data['province']."' AND citymun_c = '".$data['lgu']."'";

        $getQry = $this->db->query($sql);
        $result= mysqli_fetch_array($getQry);
        
        return $result;
    }

    public function fetchSuspects($region=null, $province=null, $lgu=null) 
    {
        $sql = "SELECT 
                    o.id,
                    CONCAT(o.lastname, ', ', o.firstname, ' ', substring(o.middlename, 1, 1)) AS name,
                    IF(o.lgu_c != '', o.street, '') AS street,
                    IF(o.lgu_c != '', c.citymun_m, '') AS lgu,
                    IF(o.lgu_c != '', p.province_m, '') AS province,
                    IF(o.lgu_c != '', r.region_m, '') AS region,
                    IF(o.lgu_c != '', CONCAT(o.street, ', ', c.citymun_m, ', ', p.province_m, ', ', r.region_m), '') AS address,
                    o.contact_information AS contact_no,
                    o.status,
                    DATE_FORMAT(o.birthdate, '%m/%d/%Y') AS birthdate, 
                    CAST(YEAR(NOW()) - YEAR(o.birthdate) AS INT) AS age,
                    o.gender 
                FROM tbl_suspects o
                LEFT JOIN tblregion r ON r.region_c = o.region_c
                LEFT JOIN tblprovince p ON p.province_c = o.province_c
                LEFT JOIN tblcitymun c ON c.citymun_c = o.lgu_c AND c.province_c = o.province_c";

        if (!empty($region) AND !empty($province) AND !empty($lgu)) {
            $sql .= " WHERE o.region_c = '".$region."' AND o.province_c = '".$province."' AND o.lgu_c = '".$lgu."'";
        } elseif (!empty($region) AND !empty($province)) {
            $sql .= " WHERE o.region_c = '".$region."' AND o.province_c = '".$province."'";
        } elseif (!empty($region)) {
            $sql .= " WHERE o.region_c = '".$region."'";
        }

        $getQry = $this->db->query($sql);
        $data = [];
        
        while($result = mysqli_fetch_array($getQry)) {
            $data[] = $result;
        }
        
        return $data;
    }


    public function fetchStatisticsStatus($region=null, $province=null, $lgu=null) 
    {
        $sql = "SELECT 
                    o.id,
                    c.citymun_m AS lgu,
                    p.province_m AS province,
                    r.region_m AS region,
                    o.current_status,
                    COUNT(o.id) AS head_count
                FROM tbl_status_change o
                LEFT JOIN tblregion r ON r.region_c = o.region_c
                LEFT JOIN tblprovince p ON p.province_c = o.province_c
                LEFT JOIN tblcitymun c ON c.citymun_c = o.lgu_c AND c.province_c = o.province_c";

        if (!empty($region) AND !empty($province) AND !empty($lgu)) {
            $sql .= " WHERE o.region_c = '".$region."' AND o.province_c = '".$province."' AND o.lgu_c = '".$lgu."'";
        } elseif (!empty($region) AND !empty($province)) {
            $sql .= " WHERE o.region_c = '".$region."' AND o.province_c = '".$province."'";
        } elseif (!empty($region)) {
            $sql .= " WHERE o.region_c = '".$region."'";
        }

        $sql .= " GROUP BY o.lgu_c, o.province_c, o.region_c, o.current_status";

        $getQry = $this->db->query($sql);
        $data = [];
        
        while($result = mysqli_fetch_array($getQry)) {
            $data[] = $result;
        }
        
        return $data;
    }

    public function fetchSuspectsByStatus($region=null, $province=null, $lgu=null) 
    {
        $sql = "SELECT 
                    o.id,
                    c.citymun_m AS lgu,
                    p.province_m AS province,
                    r.region_m AS region,
                    o.current_status,
                    COUNT(o.id) AS head_count
                FROM tbl_status_change o
                LEFT JOIN tblregion r ON r.region_c = o.region_c
                LEFT JOIN tblprovince p ON p.province_c = o.province_c
                LEFT JOIN tblcitymun c ON c.citymun_c = o.lgu_c AND c.province_c = o.province_c";

        if (!empty($region) AND !empty($province) AND !empty($lgu)) {
            $sql .= " WHERE o.region_c = '".$region."' AND o.province_c = '".$province."' AND o.lgu_c = '".$lgu."'";
        } elseif (!empty($region) AND !empty($province)) {
            $sql .= " WHERE o.region_c = '".$region."' AND o.province_c = '".$province."'";
        } elseif (!empty($region)) {
            $sql .= " WHERE o.region_c = '".$region."'";
        }

        $sql .= " GROUP BY o.lgu_c, o.province_c, o.region_c, o.current_status";

        $getQry = $this->db->query($sql);
        $data = [];
        
        while($result = mysqli_fetch_array($getQry)) {
            $data[] = $result;
        }
        
        return $data;
    }

    public function fetchStatisticsPopulation($region=null, $province=null, $lgu=null) 
    {
        $sql = "SELECT
                    o.id,
                    c.citymun_m AS lgu,
                    p.province_m AS province,
                    r.region_m AS region,
                    o.population,
                    SUM(CASE WHEN status = 'Under Investigation' then 1 else 0 end) AS uiv,
                    SUM(CASE WHEN status = 'Surrendered' then 1 else 0 end) AS sur,
                    SUM(CASE WHEN status = 'Apprehended' then 1 else 0 end) AS apr,
                    SUM(CASE WHEN status = 'Escaped' then 1 else 0 end) AS esc,
                    SUM(CASE WHEN status = 'Deceased' then 1 else 0 end) AS decs
                FROM
                    tbl_lgu_information o
                LEFT JOIN tblregion r ON
                    r.region_c = o.region_c
                LEFT JOIN tblprovince p ON
                    p.province_c = o.province_c
                LEFT JOIN tblcitymun c ON
                    c.citymun_c = o.citymun_c AND c.province_c = o.province_c
                LEFT JOIN tbl_suspects s ON
                    s.lgu_c = o.citymun_c AND s.province_c = o.province_c AND s.region_c = o.region_c
                WHERE o.population > 0";

        if (!empty($region) AND !empty($province) AND !empty($lgu)) {
            $sql .= " AND o.region_c = '".$region."' AND o.province_c = '".$province."' AND o.citymun_c = '".$lgu."'";
        } elseif (!empty($region) AND !empty($province)) {
            $sql .= " AND o.region_c = '".$region."' AND o.province_c = '".$province."'";
        } elseif (!empty($region)) {
            $sql .= " AND o.region_c = '".$region."'";
        }

        $sql .= " GROUP BY o.region_c, o.province_c, o.citymun_c";

        $getQry = $this->db->query($sql);
        $data = [];
        
        while($result = mysqli_fetch_array($getQry)) {
            $data[] = $result;
        }
        
        return $data;
    }

    public function fetchStatisticsAge($region=null, $province=null, $lgu=null) 
    {
        $sql = "SELECT
                    o.id,
                    c.citymun_m AS lgu,
                    p.province_m AS province,
                    r.region_m AS region,
                    SUM(CASE WHEN CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) < 12 then 1 else 0 end) AS bracket1,
                    SUM(CASE WHEN CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) > 12 AND CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) < 19 then 1 else 0 end) AS bracket2,
                    SUM(CASE WHEN CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) > 18 AND CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) < 26 then 1 else 0 end) AS bracket3,
                    SUM(CASE WHEN CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) > 25 AND CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) < 35 then 1 else 0 end) AS bracket4,
                    SUM(CASE WHEN CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) > 35 AND CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) < 51 then 1 else 0 end) AS bracket5,
                    SUM(CASE WHEN CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) > 50 AND CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) < 66 then 1 else 0 end) AS bracket6,
                    SUM(CASE WHEN CAST(YEAR(NOW()) - YEAR(s.birthdate) AS INT) > 65 then 1 else 0 end) AS bracket7

                FROM
                    tbl_lgu_information o
                LEFT JOIN tblregion r ON
                    r.region_c = o.region_c
                LEFT JOIN tblprovince p ON
                    p.province_c = o.province_c
                LEFT JOIN tblcitymun c ON
                    c.citymun_c = o.citymun_c AND c.province_c = o.province_c
                LEFT JOIN tbl_suspects s ON
                    s.lgu_c = o.citymun_c AND s.province_c = o.province_c AND s.region_c = o.region_c
                WHERE o.population > 0";

        if (!empty($region) AND !empty($province) AND !empty($lgu)) {
            $sql .= " AND o.region_c = '".$region."' AND o.province_c = '".$province."' AND o.citymun_c = '".$lgu."'";
        } elseif (!empty($region) AND !empty($province)) {
            $sql .= " AND o.region_c = '".$region."' AND o.province_c = '".$province."'";
        } elseif (!empty($region)) {
            $sql .= " AND o.region_c = '".$region."'";
        }

        $sql .= " GROUP BY o.region_c, o.province_c, o.citymun_c";

        $getQry = $this->db->query($sql);
        $data = [];
        
        while($result = mysqli_fetch_array($getQry)) {
            $data[] = $result;
        }
        
        return $data;
    }   

}   