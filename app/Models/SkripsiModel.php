<?php

namespace App\Models;

use CodeIgniter\Model;

class SkripsiModel extends Model
{
    protected $table      = 'skripsi';
    protected $primaryKey = 'id';
    
    public function get_payment()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                    * 
				FROM pembayaran 
				LEFT JOIN mahasiswa ON mahasiswa.nim=pembayaran.nim";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }     

    public function delete_skripsi_dosen($skripsi_id,$id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM skripsi_dosen
               WHERE skripsi_id='".$skripsi_id."' 
               AND id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Skripsi berhasil dihapus"
        );
        return $result;
    }

    public function edit_skripsi_dosen($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE skripsi_dosen SET
                    `nik`='".$data["nik"]."',
                    `posisi`='".$data["posisi"]."',
                    `deskripsi`='".$data["deskripsi"]."'
               WHERE skripsi_id='".$data["skripsi_id"]."'
               AND id='".$data["id"]."'";
        //print_r($sql);        
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Dosen berhasil diupdate"
        );
        return $result;
    }

    public function add_skripsi_dosen($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO skripsi_dosen SET
                    `skripsi_id`='".$data["skripsi_id"]."',            
                    `nik`='".$data["nik"]."',
                    `posisi`='".$data["posisi"]."',
                    `deskripsi`='".$data["deskripsi"]."'";
        //print_r($sql);        
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Dosen berhasil ditambahkan"
        );
        return $result;
    }

    public function get_skripsi_dosen_detail($skripsi_id,$id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                   skripsi_dosen.*, dosen.nama_dosen  
				FROM skripsi_dosen 
				LEFT JOIN dosen ON dosen.nik=skripsi_dosen.nik
                WHERE skripsi_dosen.skripsi_id='".$skripsi_id."'
                AND skripsi_dosen.id";
               
        $query = $db->query($sql);
        $results = $query->getRow();
        return $results;
    }

    public function get_skripsi_dosen($id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                   skripsi_dosen.*, dosen.nama_dosen  
				FROM skripsi_dosen 
				LEFT JOIN dosen ON dosen.nik=skripsi_dosen.nik
                WHERE skripsi_dosen.skripsi_id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }

    public function get_skripsi()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                   skripsi.*,mahasiswa.nama_lengkap  
				FROM skripsi 
				LEFT JOIN mahasiswa ON mahasiswa.nim=skripsi.nim";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }

    public function get_skripsi_detail($id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM skripsi WHERE id ='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        
        return $results;
    }

    public function add_skripsi($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO skripsi SET
                    `judul_skripsi`='".$db->escapeString($data["judul_skripsi"])."',            
                    `nim`='".$data["nim"]."',
                    `deskripsi`='".$data["deskripsi"]."'";
        //print_r($sql);        
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Skripsi berhasil ditambahkan"
        );
        return $result;
    }

    public function edit_skripsi($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE skripsi SET
                    `judul_skripsi`='".$db->escapeString($data["judul_skripsi"])."',            
                    `nim`='".$db->escapeString($data["nim"])."'
                WHERE id='".$data["id"]."'";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Skripsi berhasil diupdate"
        );
        return $result;
    }

    public function delete_skripsi($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM skripsi
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Skripsi berhasil dihapus"
        );
        return $result;
    }
}