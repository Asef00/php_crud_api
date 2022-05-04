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
}
