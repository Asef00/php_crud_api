<?php

class User
{
    // DB Stuff
    private $conn;
    private $table = 'users';

    // Properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $created_at;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }


    //////////////// Methods /////////////////
    // Get Users
    public function read()
    {
        $query = 'SELECT 

            u.id as id,
            u.firstname as firstname,
            u.lastname as lastname,
            u.email as email,
            u.created_at as created_at

            FROM ' . $this->table . ' u
            ORDER BY u.created_at DESC
        ';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Excecute query
        $stmt->execute();

        return $stmt;
    }

    // Create User
    public function create()
    {

        $query = 'INSERT INTO ' . $this->table . '
            SET
                firstname = :firstname,
                lastname = :lastname,
                email = :email
        ';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // validation
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(':firstname',$this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email',$this->email);

        // Excecute query
        if ($stmt->execute())
            return true;

        printf('Error: %s.\n', $stmt->error);

        return false;
    }
}
