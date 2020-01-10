<?php
//ไฟล์ใช้ติดต่อฐานข้อมูล
class Database
{
    private $host = "localhost"; //ที่อยู่
    private $db_name = "memo_kids"; //ชื่อฐานข้อมูล
    private $username = "root"; //ฃื่อที่ใช้ในการเช้าใช้งาน
    private $password = "Ord1996@"; //รหัสผ่านในการเข้าใจงาน DB
    public $conn;
    //ฟังก์ชันที่ใช้ติดต่อฐานข้อมูล
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . "; 
                dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
            //echo "Connection ok: "
        } catch (PDOException $exception) {
            //echo "Connection error: " . $exception->getMessage(); 
        }
        return $this->conn;
    }
}
?>