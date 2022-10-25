<?php

namespace App\Models;

use CodeIgniter\Model;

class LecturersModel extends Model
{
    protected $table      = 'dosen';
    protected $primaryKey = 'id';

    public function get_lecturers() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM dosen
                ORDER BY id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_lecturer_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    nik, nama_dosen
                FROM dosen
                ORDER BY nama_dosen";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_lecturer_detail2($nik) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM dosen
                WHERE nik='".$nik."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function get_lecturer_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM dosen
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function add_lecturer($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO dosen SET
                    nik='".$data["nik"]."', 
                    nama_dosen='".$db->escapeString($data["nama_dosen"])."'";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Dosen berhasil ditambahkan"
        );
        return $result;
    }

    public function edit_lecturer($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE dosen SET
                    nama_dosen='".$db->escapeString($data["nama_dosen"])."' 
               WHERE id='".$data["id"]."';";
              
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Dosen berhasil diupdate"
        );
        return $result;
    }

    public function delete_lecturer($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM dosen
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Dosen berhasil dihapus"
        );
        return $result;
    }
}
?>