<?php

namespace App\Models;

use CodeIgniter\Model;

class CollegeStudentModel extends Model
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'id';
	
    public function get_documents_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM dokumen
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function delete_documents($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM dokumen
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data dokumen berhasil dihapus"
        );
        return $result;
    }

    public function edit_documents($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE dokumen SET
                    nama_dokumen='".$db->escapeString($data["nama_dokumen"])."', 
                    deskripsi='".$db->escapeString($data["deskripsi"])."' 
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Dokumen berhasil diupdate"
        );
        return $result;
    }

	public function add_documents($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO dokumen SET
                    nama_dokumen='".$db->escapeString($data["nama_dokumen"])."',
                    deskripsi='".$db->escapeString($data["deskripsi"])."';";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Dokumen berhasil ditambahkan"
        );
        return $result;
    }

    public function get_documents() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM dokumen";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_documents_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM dokumen";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;
    }

    public function add_ijazah($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        
        $sql ="UPDATE mahasiswa SET
                   `no_ijazah`= '".$data["no_ijazah"]."'
               WHERE nim='".$data["nim"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "No Ijazah berhasil diupdate"
        );
        return $result;
    }

	public function get_jurusan_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM jurusan
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }
	
	public function delete_jurusan($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM jurusan
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Jurusan berhasil dihapus"
        );
        return $result;
    }
	
	public function edit_jurusan($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="UPDATE jurusan SET
                    jurusan='".$db->escapeString($data["jurusan"])."' 
                    
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data jurusan berhasil diupdate"
        );
        return $result;
    }

	public function add_jurusan($data) {
        $db = \Config\Database::connect();
        $is_error=0;
        $sql ="INSERT INTO jurusan SET
                    jurusan='".$db->escapeString($data["jurusan"])."';";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Jurusan berhasil ditambahkan"
        );
        return $result;
    }

	public function get_jurusan_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM jurusan
                ORDER BY jurusan asc";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_tahun_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    tahun_akademik
                FROM mahasiswa
                GROUP BY tahun_akademik
                ORDER BY tahun_akademik asc";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }
	
	public function get_jurusan() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM jurusan
                ORDER BY jurusan asc";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_student_by_nim($nim) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    nim, nama_lengkap
                FROM mahasiswa
                WHERE nim='".$nim."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function get_student_select() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    nim, nama_lengkap
                FROM mahasiswa
                ORDER BY nama_lengkap";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_student() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    m.*, j.jurusan
                FROM mahasiswa m
				LEFT JOIN jurusan j ON j.id = m.jurusan_id
                ORDER BY id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_student_detail2($nim) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    nim, nama_lengkap
                FROM mahasiswa
                WHERE nim='".$nim."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function get_student_name($nim) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    nama_lengkap
                FROM mahasiswa
                WHERE nim='".$nim."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results->nama_lengkap;
    }

    public function get_student_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM mahasiswa
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function add_students($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        if(is_array($photo)) {
            $path=FCPATH."/images/foto";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
            if($photo["name"]) {
                move_uploaded_file($photo["tmp_name"],$imgpath."/".$photo["name"]);
                $fields=" photo='".$photo["name"]."', ";
            }
        }    

        if($data["tgl_lahir"]) {
            $tmp = strtotime($data["tgl_lahir"]);
            $data["tgl_lahir"] = date("Y-m-d",$tmp);
        }

        $sql ="INSERT INTO mahasiswa SET
                    nim='".$data["nim"]."', 
                    nama_lengkap='".$db->escapeString($data["nama_mahasiswa"])."', 
                    jenis_kelamin='".$data["jenis_kelamin"]."', 
                    tempat_lahir='".$data["tempat_lahir"]."', 
                    tgl_lahir='".$data["tgl_lahir"]."', 
                    no_identitas='".$data["no_identitas"]."', 
                    nama_ortu='".$data["nama_ortu"]."',
                    alamat_ortu='".$db->escapeString($data["alamat_ortu"])."',
                    jurusan_id='".$data["jurusan_id"]."',
                    ".$fields."
                    tahun_akademik='".$data["tahun_akademik"]."';";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Mahasiswa berhasil ditambahkan"
        );
        return $result;
    }

    public function edit_students($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        if(is_array($photo)) {
            $path=FCPATH."/images/foto";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
            if($photo["name"]) {
                move_uploaded_file($photo["tmp_name"],$imgpath."/".$photo["name"]);
                $fields=" photo='".$photo["name"]."', ";
            }
        }    

        if($data["tgl_lahir"]) {
            $tmp = strtotime($data["tgl_lahir"]);
            $data["tgl_lahir"] = date("Y-m-d",$tmp);
        }
        
        $sql ="UPDATE mahasiswa SET
                    nim='".$data["nim"]."', 
                    nama_lengkap='".$db->escapeString($data["nama_mahasiswa"])."', 
                    jenis_kelamin='".$data["jenis_kelamin"]."', 
                    tempat_lahir='".$data["tempat_lahir"]."', 
                    tgl_lahir='".$data["tgl_lahir"]."', 
                    no_identitas='".$data["no_identitas"]."', 
                    nama_ortu='".$data["nama_ortu"]."',
                    alamat_ortu='".$db->escapeString($data["alamat_ortu"])."',
                    jurusan_id='".$data["jurusan_id"]."',
                    ".$fields."
					tahun_akademik='".$data["tahun_akademik"]."'
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Mahasiswa berhasil diupdate"
        );
        return $result;
    }

    public function delete_student($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM mahasiswa
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Mahasiswa berhasil dihapus"
        );
        return $result;
    }
}
?>