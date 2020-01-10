<?php

class Member
{
    private $conn;

    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $passwords;
    public $email;
    public $contact;
    public $birth;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function signin()
    {
        $query = "SELECT * FROM members WHERE username=:username AND
        passwords=:passwords";

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->passwords = htmlspecialchars(strip_tags($this->passwords));

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":passwords", $this->passwords);

        $stmt->execute();

        return $stmt;
    }

    public function signup(){


        if($this->isAlreadyExist()){
            return false;
        }

        $query = "INSERT INTO members SET 
        firstname=:firstname,
        lastname=:lastname,
        username=:username,
        passwords=:passwords,
        email=:email,
        contact=:contact,
        birth=:birth
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":passwords", $this->passwords);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":birth", $this->birth);

        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    public function getAllUser(){
        $query = "SELECT * FROM members";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                members 
            WHERE
                username='".$this->username."'
                OR
                email='".$this->email."'
                ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
