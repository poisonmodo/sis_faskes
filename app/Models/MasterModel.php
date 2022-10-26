<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterModel extends Model
{
    // protected $table      = 'mahasiswa';
    // protected $primaryKey = 'id';

    public function get_faskes_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM faskes
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function delete_faskes($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM faskes
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Faskes berhasil dihapus"
        );
        return $result;
    }

    public function edit_faskes($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE faskes SET
                    faskes_type='".$data["faskes_type"]."',
                    faskes_name='".$db->escapeString($data["faskes_name"])."', 
                    faskes_address='".$db->escapeString($data["faskes_address"])."',
                    faskes_phone='".$db->escapeString($data["faskes_phone"])."',
                    city_id='".$db->escapeString($data["city_id"])."' 
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Faskes berhasil diupdate"
        );
        return $result;
    }

	public function add_faskes($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO faskes SET
                    faskes_type='".$data["faskes_type"]."',
                    faskes_name='".$db->escapeString($data["faskes_name"])."', 
                    faskes_address='".$db->escapeString($data["faskes_address"])."',
                    faskes_phone='".$db->escapeString($data["faskes_phone"])."',
                    city_id='".$db->escapeString($data["city_id"])."';";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Kota berhasil ditambahkan"
        );
        return $result;
    }

    public function get_faskes() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    faskes.*, cities.city
                FROM faskes
                LEFT JOIN cities ON cities.id=faskes.city_id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;
    }

	
    public function get_city_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM cities
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function delete_city($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM cities
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Faskes berhasil dihapus"
        );
        return $result;
    }

    public function edit_city($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE cities SET
                    city='".$db->escapeString($data["city"])."', 
                    province_id='".$data["province_id"]."' 
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Kota berhasil diupdate"
        );
        return $result;
    }

	public function add_city($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO cities SET
                    province_id='".$db->escapeString($data["province_id"])."',
                    city='".$db->escapeString($data["city"])."';";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Kota berhasil ditambahkan"
        );
        return $result;
    }

    public function get_cities() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    cities.*, provinces.province
                FROM cities
                LEFT JOIN provinces ON provinces.id=cities.province_id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_city_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM cities";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;
    }

    public function get_province_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM provinces";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;
    }

	public function get_province_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM provinces
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }
	
	public function delete_province($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM provinces
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Provinsi berhasil dihapus"
        );
        return $result;
    }
	
	public function edit_province($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE provinces SET
                    province='".$db->escapeString($data["province"])."' 
                    
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Provinsi berhasil diupdate"
        );
        return $result;
    }

	public function add_province($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO provinces SET
                    province='".$db->escapeString($data["province"])."';";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Provinsi berhasil ditambahkan"
        );
        return $result;
    }

	public function get_provinces() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM provinces
                ORDER BY province asc";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_province() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM provinces
                ORDER BY province asc";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }


    public function get_vaksin_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    vaksin_type, vaksin_name
                FROM vaksin
                ORDER BY vaksin_name";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_vaksin() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *                
                FROM vaksin    
                ORDER BY id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_vaksin_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM vaksin
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function get_vaksin_name($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    vaksin_name
                FROM vaksin
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results->vaksin_name;
    }

    public function add_vaksin($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        // if(is_array($photo)) {
        //     $path=FCPATH."/images/foto";
        //     $imgpath = $path."/".$data["id"];
            
        //     if(!file_exists($imgpath)) {
        //         mkdir($imgpath);
        //     }
        //     if($photo["name"]) {
        //         move_uploaded_file($photo["tmp_name"],$imgpath."/".$photo["name"]);
        //         $fields=" photo='".$photo["name"]."', ";
        //     }
        // }    

        $sql ="INSERT INTO vaksin SET
                    vaksin_type='".$data["vaksin_type"]."', 
                    vaksin_name='".$db->escapeString($data["vaksin_name"])."';";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data vaksin berhasil ditambahkan"
        );
        return $result;
    }

    public function edit_vaksin($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        // if(is_array($photo)) {
        //     $path=FCPATH."/images/foto";
        //     $imgpath = $path."/".$data["id"];
            
        //     if(!file_exists($imgpath)) {
        //         mkdir($imgpath);
        //     }
        //     if($photo["name"]) {
        //         move_uploaded_file($photo["tmp_name"],$imgpath."/".$photo["name"]);
        //         $fields=" photo='".$photo["name"]."', ";
        //     }
        // }    

        // if($data["tgl_lahir"]) {
        //     $tmp = strtotime($data["tgl_lahir"]);
        //     $data["tgl_lahir"] = date("Y-m-d",$tmp);
        // }
        
        $sql ="UPDATE vaksin SET
                    vaksin_type='".$data["vaksin_type"]."', 
                    vaksin_name='".$db->escapeString($data["vaksin_name"])."' 
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Vaksin berhasil diupdate"
        );
        return $result;
    }

    public function delete_vaksin($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM vaksin
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data vaksin berhasil dihapus"
        );
        return $result;
    }
}
?>