<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    public function get_group_all() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    * 
                FROM groups 
                ORDER BY id";
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;    
    }
    
    public function add_users($data)
    {
        $is_error = 0;
        $session = session();
        $sess = $session->get('security');
        $db = \Config\Database::connect();
        $sql = "INSERT INTO users SET 
                    username='" . $data["username"] . "',
                    userpass='" . $data["userpass"] ."',
                    `group_id`='" . $data["group_id"] ."'";
          
        $db->query($sql);
        $uid = $db->insertID();
    

        $result = array(
            "is_error" => $is_error,
            "message" => "User berhasil ditambahkan"
        );
        return $result;
    }

    public function edit_users($data)
    {
        $is_error = 0;
        $session = session();
        $sess = $session->get('security');
        $db = \Config\Database::connect();
        $fields="";
        if($data["userpass"]) {
           $fields="userpass='" . $data["userpass"] ."', ";
        }
        $sql = "UPDATE users SET "
                    .$fields."
                    `group_id`='" . $data["group_id"] ."' 
                WHERE id='".$data["id"]."'";
        //print_r($sql);        
        $db->query($sql);
    
        $result = array(
            "is_error" => $is_error,
            "message" => "User berhasil diupdate"
        );
        return $result;
    }

    public function delete_users($id)
    {
        $is_error = 0;
        $session = session();
        $sess = $session->get('security');
        $db = \Config\Database::connect();
        $sql = "DELETE FROM users WHERE id='".$id."'";
        $db->query($sql);
        
        $sql2 = "DELETE FROM user_groups WHERE `user_id` ='".$id."'";
        //print_r($sql2);
        
        $db->query($sql2);

        $result = array(
            "is_error" => $is_error,
            "message" => "User berhasil dihapus"
        );
        return $result;
    }

    public function get_user_list() {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    users.*, groups.nama_group
                FROM users
                LEFT JOIN groups ON groups.id=users.group_id
                ORDER BY users.id"; 
        $query = $db->query($sql);
        $results = $query->getResult();
        //print_r($results);
        return $results;    
    }

    public function get_user_detail($id) {
        $db = \Config\Database::connect();
        $sql = "SELECT  
                    * 
                FROM users
                LEFT JOIN groups ON groups.id=users.group_id
                WHERE users.id='".$id."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        //print_r($results);
        return $results;    
    }

    public function changepass($dat)
    {
        $session = session();
        $sess = $session->get('security');
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM users WHERE username='".$sess["uname"]."' AND userpass='".$dat["oldpass"]."'";

        $query = $db->query($sql);
        $results = $query->getRow();
        if($results) {
            $sql = "UPDATE users SET 
                        userpass='".$dat["newpass1"]."' 
                    WHERE username='".$sess["uname"]."'";

        $query = $db->query($sql);
            
            $tmp = array(
                "is_error" => 0,
                "message" => "Ganti Password berhasil",
            );
        }   
        else {
            $tmp = array(
                "is_error" => 1,
                "message" => "Password Lama Anda Salah"
            );
        } 
        return $tmp;
    }

    public function checklogin($dat)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM users 
                WHERE email='".$dat["username"]."' 
                AND password='".$dat["userpass"]."'";
        $query = $db->query($sql);
        $results = $query->getRow();
        if($results) {
            $tmp = array(
                "is_error" => 0,
                "message" => "Login valid",
                "data" => $results
            );
        }   
        else {
            $tmp = array(
                "is_error" => 1,
                "message" => "Username atau Password Anda Salah"
            );
        } 
        return $tmp;
    }
}
?>