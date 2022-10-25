<?php

namespace App\Models;

use CodeIgniter\Model;

class ExportModel extends Model
{
    //get students into Excel
    public function get_student_xls($dat) {
        $db = \Config\Database::connect();
        $where="";
        if(isset($dat["nim"])) {
            if(!$where) {
               $where =" WHERE nim LIKE '%".$dat["nim"]."%'";     
            }
            else {
                $where.=" AND nim LIKE '%".$dat["nim"]."%'";
            }
        }
        if(isset($dat["nama"])) {
            if(!$where) {
               $where =" WHERE nama_lengkap LIKE '%".$dat["nama"]."%'";     
            }
            else {
                $where.=" AND nama_lengkap LIKE '%".$dat["nama"]."%'";
            }
        }
        if(isset($dat["jurusan"]) && $dat["jurusan"]!="Semua Jurusan") {
            if(!$where) {
               $where =" WHERE jurusan_id='".$dat["jurusan"]."'";     
            }
            else {
                $where.=" AND jurusan_id='".$dat["jurusan"]."'";
            }
        }
        if(isset($dat["tahun_akademik"]) && $dat["jurusan"]!="Semua Tahun Aakademik") {
            if(!$where) {
               $where =" WHERE tahun_akademik='".$dat["tahun_akademik"]."'";     
            }
            else {
                $where.=" AND tahun_akademik='".$dat["tahun_akademik"]."'";
            }
        }
        $sql = "SELECT 
                    *
				FROM mahasiswa 
                LEFT join jurusan ON jurusan.id=mahasiswa.jurusan_id ".$where;
        //echo $sql;
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }
    
    //get ijazah into Excel
    public function get_student_ijazah_xls($dat) {
        $db = \Config\Database::connect();
        $where="";
        //print_r($dat);
        if(isset($dat["nim"]) && $dat["nim"]!="") {
            if(!$where) {
               $where =" AND ijazah.nim LIKE '%".$dat["nim"]."%'";     
            }
            else {
                $where.=" AND ijazah.nim LIKE '%".$dat["nim"]."%'";
            }
        }
        if(isset($dat["nama"]) && $dat["nama"]!="") {
            if(!$where) {
               $where =" AND mahasiswa.nama_lengkap LIKE '%".$dat["nama"]."%'";     
            }
            else {
                $where.=" AND mahasiswa.nama_lengkap LIKE '%".$dat["nama"]."%'";
            }
        }
        if(isset($dat["jurusan"]) && $dat["jurusan"]!="Semua Jurusan") {
            if(!$where) {
               $where =" AND mahasiswa.jurusan_id='".$dat["jurusan"]."'";     
            }
            else {
                $where.=" AND mahasiswa.jurusan_id='".$dat["jurusan"]."'";
            }
        }
        if(isset($dat["thn_ajaran"]) && $dat["thn_ajaran"]!="") {
            if(!$where) {
               $where =" AND mahasiswa.tahun_akademik='".$dat["thn_ajaran"]."'";     
            }
            else {
                $where.=" AND mahasiswa.tahun_akademik='".$dat["thn_ajaran"]."'";
            }
        }
        if(isset($dat["no_ijazah"]) && $dat["no_ijazah"]!="") {
            if(!$where) {
               $where =" AND ijazah.no_ijazah LIKE '%".$dat["no_ijazah"]."%'";     
            }
            else {
                $where.=" AND ijazah.no_ijazah LIKE '%".$dat["no_ijazah"]."%'";
            }
        }
        if(isset($dat["thn_lulus"]) && $dat["thn_lulus"]!="") {
            if(!$where) {
               $where =" AND year(ijazah.tanggal_yudisium)='".$dat["thn_lulus"]."'";     
            }
            else {
                $where.=" AND year(ijazah.tanggal_yudisium)='".$dat["thn_lulus"]."'";
            }
        }
        $sql = "SELECT 
                    *
				FROM ijazah 
                LEFT join mahasiswa ON mahasiswa.nim=ijazah.nim 
                LEFT join jurusan ON jurusan.id=mahasiswa.jurusan_id 
                WHERE ijazah.no_ijazah IS NOT NULL ".$where;
        //echo $sql;
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);    
        return $results;
    }
}