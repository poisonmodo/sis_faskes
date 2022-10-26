<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model
{
    
    public function get_faskes_vaksin() {
        $db = \Config\Database::connect();
            $sql = "SELECT  
                        *                
                    FROM faskes_vaksins 
                    LEFT JOIN vaksin ON vaksin.id=faskes_vaksins.vaksin_id   
                    LEFT JOIN faskes ON faskes.id=faskes_vaksins.faskes_id
                    GROUP BY faskes_vaksins.faskes_id
                    ORDER BY faskes_vaksins.id";
        $query = $db->query($sql);
        $results = $query->getResult();
        // print_r($results);
        // exit
        return $results;;
    }

    public function get_faskes_count() {
        $db = \Config\Database::connect();
        $sql = " SELECT 
                    faskes_type, count(faskes_type) jml 
                 FROM faskes 
                 GROUP BY faskes_type";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_vaksin_count() {
        $db = \Config\Database::connect();
        $sql = " SELECT 
                    vaksin_name, IFNULL(sum(faskes_vaksins.kouta),0) jml 
                 FROM vaksin
                 LEFT JOIN faskes_vaksins ON vaksin.id=faskes_vaksins.vaksin_id   
                 GROUP BY vaksin.id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_vaksin($faskes_id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                   faskes_vaksins.id, vaksin.*, faskes_vaksins.kouta                
                FROM faskes_vaksins 
                LEFT JOIN vaksin ON vaksin.id = faskes_vaksins.vaksin_id
                WHERE faskes_vaksins.faskes_id='".$faskes_id."'    
                ORDER BY faskes_vaksins.id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_vaksin_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM faskes_vaksins
                JOIN faskes ON faskes.id=faskes_vaksins.faskes_id
                LEFT JOIN vaksin ON vaksin.id=faskes_vaksins.vaksin_id   
                WHERE faskes_vaksins.id='".$id."'";
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

    public function add_faskes_vaksin($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        
        $sql2 ="SElECT * FROM faskes_vaksins
                LEFT JOIN faskes ON faskes.id=faskes_vaksins.faskes_id 
                WHERE faskes_vaksins.faskes_id='".$data["faskes_id"]."'
                AND faskes_vaksins.vaksin_id='".$data["vaksin_id"]."';";
        $res = $db->query($sql2);
        $tmp = $res->getResult();
        
        if(count($tmp)<1) {
            $sql ="INSERT INTO faskes_vaksins SET
                        faskes_id='".$data["faskes_id"]."', 
                        vaksin_id='".$data["vaksin_id"]."',
                        kouta='".$data["kouta"]."';";
            $db->query($sql);
            $result = array(
                "is_error" => 0,
                "message" => "Data vaksin berhasil ditambahkan"
            );
        }
        else {            
            
            $q = $res->getRow();
            $result = array(
                "is_error" => 1,
                "message" => "Data vaksin sudah ada di ".$q->faskes_name
            );
        }    
        return $result;
    }

    public function edit_faskes_vaksin($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        
        $sql ="UPDATE faskes_vaksins SET
                    faskes_id='".$data["faskes_id"]."', 
                    vaksin_id='".$data["vaksin_id"]."' 
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
        $sql ="DELETE FROM faskes_vaksins
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data vaksin berhasil dihapus"
        );
        return $result;
    }

    public function delete_faskes_vaksin($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM faskes_vaksins
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data vaksin berhasil dihapus"
        );
        return $result;
    }
}