<?php

namespace App\Models;

use CodeIgniter\Model;

class YudisiumModel extends Model
{
    protected $table      = 'yudisium';
    protected $primaryKey = 'id';

    public function get_ijazah_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM ijazah
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function delete_ijazah($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM ijazah
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data ijazah berhasil dihapus"
        );
        return $result;
    }

    public function edit_ijazah($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        if(is_array($photo)) {
            $path=FCPATH."/images/ijazah";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
            if($photo["name"]) {
                $tmp = explode(".",$photo["name"]);
                $namafile = sha1($tmp[0].date("YmdHis")).".".$tmp[1];
                move_uploaded_file($photo["tmp_name"],$imgpath."/".$namafile);
                $fields=", filename='".$namafile."', real_filename='".$photo["name"]."', tanggal_upload=NOW()";
            }
        }    

        if($data["tanggal_yudisium"]) {
            $tmp = strtotime($data["tanggal_yudisium"]);
            $data["tanggal_yudisium"] = date("Y-m-d",$tmp);
        }

        if($data["tanggal_ijazah"]) {
            $tmp = strtotime($data["tanggal_ijazah"]);
            $data["tanggal_ijazah"] = date("Y-m-d",$tmp);
        }

        $sql ="UPDATE ijazah SET
                    nim='".$db->escapeString($data["nim"])."',
                    tanggal_yudisium='".$data["tanggal_yudisium"]."',
                    tanggal_ijazah='".$data["tanggal_ijazah"]."',
                    no_ijazah='".$data["no_ijazah"]."'
                    ".$fields."  
               WHERE id ='".$data["id"]."'";
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Ijazah berhasil ditambahkan"
        );
        return $result;
    }

	public function add_ijazah($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;
        $fields="";
        if(is_array($photo)) {
            $path=FCPATH."/images/ijazah";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
            if($photo["name"]) {
                $tmp = explode(".",$photo["name"]);
                $namafile = sha1($tmp[0].date("YmdHis")).".".$tmp[1];
                move_uploaded_file($photo["tmp_name"],$imgpath."/".$namafile);
                $fields=", filename='".$namafile."', real_filename='".$photo["name"]."', tanggal_upload=NOW()";
            }
        }    

        if($data["tanggal_yudisium"]) {
            $tmp = strtotime($data["tanggal_yudisium"]);
            $data["tanggal_yudisium"] = date("Y-m-d",$tmp);
        }

        if($data["tanggal_ijazah"]) {
            $tmp = strtotime($data["tanggal_ijazah"]);
            $data["tanggal_ijazah"] = date("Y-m-d",$tmp);
        }

        $sql ="INSERT INTO ijazah SET
                    nim='".$db->escapeString($data["nim"])."',
                    tanggal_yudisium='".$data["tanggal_yudisium"]."',
                    tanggal_ijazah='".$data["tanggal_ijazah"]."',
                    no_ijazah='".$data["no_ijazah"]."'
                    ".$fields;
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Ijazah berhasil ditambahkan"
        );
        return $result;
    }

    public function get_ijazah($nim) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    ijazah.*, mahasiswa.nama_lengkap
                FROM ijazah
                LEFT JOIN mahasiswa ON mahasiswa.nim=ijazah.nim 
                WHERE ijazah.nim='".$nim."'" ;
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }

    public function get_yudisium_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    *
                FROM yudisium
                WHERE id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;
    }

    public function delete_yudisium($id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM yudisium
               WHERE id='".$id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Data Yudisium berhasil dihapus"
        );
        return $result;
    }

    public function edit_yudisium($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;$fields="";
        if(is_array($photo)) {
            $path=FCPATH."/images/yudisium";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
            if($photo["name"]) {
                $tmp = explode(".",$photo["name"]);
                $namafile = sha1($tmp[0].date("YmdHis")).".".$tmp[1];
                move_uploaded_file($photo["tmp_name"],$imgpath."/".$namafile);
                $fields=", filename='".$namafile."', real_filename='".$photo["name"]."', ";
            }
        } 
        $sql ="UPDATE yudisium SET
                    nim='".$db->escapeString($data["nim"])."',
                    id_dokumen='".$data["id_dokumen"]."',
                    ".$fields." 
               WHERE id='".$data["id"]."';";
        //print_r($sql);       
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Yudisium berhasil diupdate"
        );
        return $result;
    }

	public function add_yudisium($data,$photo) {
        $db = \Config\Database::connect();
        $is_error=0;$fields="";
        if(is_array($photo)) {
            $path=FCPATH."/images/yudisium";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
            if($photo["name"]) {
                $tmp = explode(".",$photo["name"]);
                $namafile = sha1($tmp[0].date("YmdHis")).".".$tmp[1];
                move_uploaded_file($photo["tmp_name"],$imgpath."/".$namafile);
                $fields=", filename='".$namafile."', real_filename='".$photo["name"]."', tanggal_upload=NOW() ";
            }
        }    

        $sql ="INSERT INTO yudisium SET
                    nim='".$db->escapeString($data["nim"])."',
                    id_dokumen='".$data["id_dokumen"]."'
                    ".$fields;
        $db->query($sql);
        $result = array(
            "is_error" => $is_error,
            "message" => "Data Dokumen berhasil ditambahkan"
        );
        return $result;
    }

    public function get_yudisium($nim) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    yudisium.*, mahasiswa.nama_lengkap, dokumen.nama_dokumen
                FROM yudisium
                LEFT JOIN dokumen ON dokumen.id=yudisium.id_dokumen 
                LEFT JOIN mahasiswa ON mahasiswa.nim=yudisium.nim 
                WHERE yudisium.nim='".$nim."'" ;
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;;
    }
}