<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckListModel extends Model
{
    protected $table      = 'skripsi';
    protected $primaryKey = 'id';

    public function edit_checklist($data,$docs) {
        $db = \Config\Database::connect();
        $is_error=0;
        if(is_array($docs)) {
            $path=FCPATH."/images/documents";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
        
            if($docs["name"]) {
                move_uploaded_file($docs["tmp_name"],$imgpath."/".$docs["name"]);
                $sql="UPDATE mahasiswa_berkas SET 
                        parameter_id='".$data["param_id"]."',
                        foto='".$docs["name"]."',
                        updated_at=NOW()
                      WHERE id='".$data["id"]."';";
                $db->query($sql);        
            }
            
            $result = array(
                "is_error" => $is_error,
                "message" => "Dokumen berhasil ditambahkan"
            );
          
        }
        
    }

     public function add_checklist($data,$docs) {
        $db = \Config\Database::connect();
        $is_error=0;
        if(is_array($docs)) {
            $path=FCPATH."/images/documents";
            $imgpath = $path."/".$data["nim"];
            
            if(!file_exists($imgpath)) {
                mkdir($imgpath);
            }
        
            if($docs["name"]) {
                move_uploaded_file($docs["tmp_name"],$imgpath."/".$docs["name"]);
                $sql="INSERT INTO mahasiswa_berkas SET 
                        nim='".$data["nim"]."',
                        skripsi_id='".$data["skripsi_id"]."',
                        parameter_id='".$data["param_id"]."',
                        foto='".$docs["name"]."',
                        created_at=NOW(),
                        updated_at=NOW();";
                $db->query($sql);        
            }
            
            $result = array(
                "is_error" => $is_error,
                "message" => "Dokumen berhasil ditambahkan"
            );
          
        }
        
    }

    public function get_checklist($skripsi_id) {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                    mahasiswa_berkas.*,parameter_checklist.param_name
				FROM mahasiswa_berkas
                LEFT JOIN parameter_checklist ON parameter_checklist.id=mahasiswa_berkas.parameter_id
                WHERE mahasiswa_berkas.skripsi_id='".$skripsi_id."'
               
			   ";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }

    public function get_checklist_detail($skripsi_id,$id) {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                    mahasiswa_berkas.*,parameter_checklist.param_name
				FROM mahasiswa_berkas
                LEFT JOIN parameter_checklist ON parameter_checklist.id = mahasiswa_berkas.parameter_id
                WHERE mahasiswa_berkas.id='".$id."'";
        
        $query = $db->query($sql);
        $param = $query->getRow();
   
        $data = $param;

        return $data;
    }

    public function get_parameter() {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                    * 
				FROM parameter_checklist
			   ";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }

    public function get_parameter_count() {
        $db = \Config\Database::connect();
        $sql = "SELECT 
                    count(*) jml 
				FROM parameter_checklist
			   ";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);    
        return $results;
    }

    public function get_mhs_parameter_count($nim) {
        $db = \Config\Database::connect();
        $sql_syarat ="SELECT count(*) total_syarat FROM parameter_checklist";
        $query2 = $db->query($sql_syarat);
        $results2 = $query2->getRow();
        if($results2) {
            $total_syarat= $results2->total_syarat;
        }
        else {
            $total_syarat=0;
        }
        
        $sql = "SELECT 
                    * 
				FROM mahasiswa_berkas 
                JOIN parameter_checklist ON parameter_checklist.id = mahasiswa_berkas.parameter_id
                WHERE mahasiswa_berkas.nim='".$nim."'
                ";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r(count($results));
        if($results) {
            $jml = count($results);
            if($jml<$total_syarat) {
                $msg ="Dokumen kurang lengkap";
                $lengkap=0;
            }
            else {
                $lengkap=1;
                $msg ="Dokumen lengkap";    
            }
            $tmp=array(
                "is_error" => 0,
                "lengkap" => $lengkap,
                "message" => $msg,
                "total" => $jml
            );
            return $tmp;
        }
        else {
            $tmp=array(
                "is_error" => 1,
                "lengkap" => 0,
                "message" => "Dokumen kurang lengkap",
                "total" => 0
            );
            return $tmp;
        }    
    }
    
    public function delete_checklist($skripsi_id,$id) {
        $db = \Config\Database::connect();
        $sql ="DELETE FROM mahasiswa_berkas
               WHERE id='".$id."'
               AND skripsi_id='".$skripsi_id."';";
        $db->query($sql);
        $result = array(
            "is_error" => 0,
            "message" => "Dokumen berhasil dihapus"
        );
        return $result;
    }
}