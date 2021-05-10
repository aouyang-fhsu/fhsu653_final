<?php
class Categories {
    //DB
    private $conn;
    private $table = 'categories';

    //Quote Properties
    public $id;
    public $category;
    
    //Constructor with DB

    public function __construct($db) {
        $this->conn = $db;
    }
    
    // get quote
    public function read(){
            $query = 'select * from ' . $this->table . ' c';


        $stmt = $this->conn->prepare($query);

        // execute
        $stmt->execute();

        return $stmt;    
    }

    //get single quote
    public function read_single(){
        $query = 'select 
            c.id,
            c.category
        from ' . $this->table . ' c
        where c.id = ?';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    // Bind ID
    $stmt->bindParam(1, $this->id);

    // execute
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->category = $row['category'];
    
    }

    public function create(){
        // Query
        $query = 'insert into ' . $this->table .'
            set 
                category = :category';
        
        // Prepare
        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->category = htmlspecialchars(strip_tags($this->category));
        
        //Bind Data
        $stmt->bindParam(':category', $this->category);
        
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
        $query = 'update ' . $this->table .'
            set 
                category = :category
            where id = :id ';
        
        // Prepare
        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->category = htmlspecialchars(strip_tags($this->category));
        
        //Bind Data
        $stmt->bindParam(':category', $this->category);
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
    // delete
    public function delete(){
        // Query
        $query = 'delete from ' . $this->table . ' where id = :id';

        // Prepare
        $stmt = $this->conn->prepare($query);

        //Clean
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        //Bind Data
        //$stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':id', intval($this->id, 10), \PDO::PARAM_INT);

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