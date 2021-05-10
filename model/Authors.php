<?php
class Authors {
    //DB
    private $conn;
    private $table = 'authors';

    //Quote Properties
    public $id;
    public $author;
    
    //Constructor with DB

    public function __construct($db) {
        $this->conn = $db;
    }
    
    // get quote
    public function read(){
            $query = 'select 
                a.id,
                a.author 
            from ' . $this->table . ' a';


            $stmt = $this->conn->prepare($query);

            // execute
            $stmt->execute();

            return $stmt;
    }

    //get single quote
    public function read_single(){
        $query = 'select 
            a.id,
            a.author
        from ' . $this->table . ' a
        where a.id = ?';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    // Bind ID
    $stmt->bindParam(1, $this->id);

    // execute
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->author = $row['author'];
    
    }

    public function create(){
        // Query
        $query = 'insert into ' .$this->table .'
            set 
                author = :author';
        
        // Prepare
        $stmt = $this->conn->prepare($query);
    
        //Clean
        $this->author = htmlspecialchars(strip_tags($this->author));
    
        //Bind Data
        $stmt->bindParam(':author', $this->author);
    
        // Execute
        if($stmt->execute()){
            return true;
        }
        echo json_encode(
            array('Error' => $stmt->error)
        );
        return false;   
    }

    public function update(){
        // Query
        $query = 'update ' .$this->table .'
            set 
                author = :author
            where id = :id';
        
        // Prepare
        $stmt = $this->conn->prepare($query);
    
        //Clean
        $this->author = htmlspecialchars(strip_tags($this->author));
    
        //Bind Data
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
    
        // Execute
        if($stmt->execute()){
            return true;
        }
        echo json_encode(
            array('Error' => $stmt->error)
        );
        return false;   
    }

}

  