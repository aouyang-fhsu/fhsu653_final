<?php
class Quote {
    //DB
    private $conn;
    private $table = 'quotes';
    private $table2 = 'categories';
    private $table3 = 'authors';

    //Quote Properties
    public $id;
    public $categoryId;
    public $authorId;
    public $quote;
    public $category;
    public $author;
    public $lim;

    //Constructor with DB

    public function __construct($db) {
        $this->conn = $db;
    }
    
    // get quote
    public function read(){
        if($this->authorId > 0 && $this->categoryId > 0){
        //if (true){
            $query = 'select 
                q.id,
                q.quote,
                a.author as author,
                c.category as category
            from ' . $this->table . ' q
            left join ' . $this->table2 . ' c on q.categoryId = c.id
            left join ' . $this->table3 . ' a on q.authorId = a.id
            WHERE q.authorId = :authorId and q.categoryId = :categoryId';
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Bind ID
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            // execute
            $stmt->execute();

            return $stmt;
        } else if($this->authorId && $this->authorId > 0){
            $query = 'select 
                q.id,
                q.quote,
                a.author as author,
                c.category as category
            from ' . $this->table . ' q
            left join ' . $this->table2 . ' c on q.categoryId = c.id
            left join ' . $this->table3 . ' a on q.authorId = a.id
            WHERE q.authorId = :authorId';
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Bind ID
            $stmt->bindParam(':authorId', $this->authorId);
            // execute
            $stmt->execute();

            return $stmt;
        } else if($this->categoryId && $this->categoryId > 0){
            $query = 'select 
                q.id,
                q.quote,
                a.author as author,
                c.category as category
            from ' . $this->table . ' q
            left join ' . $this->table2 . ' c on q.categoryId = c.id
            left join ' . $this->table3 . ' a on q.authorId = a.id
            WHERE q.categoryId = :categoryId';
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Bind ID
            $stmt->bindParam(':categoryId', $this->categoryId);
            // execute
            $stmt->execute();

            return $stmt;        
        } else if($this->lim && $this->lim > 0){
            $query = 'select 
                q.id,
                q.quote,
                a.author as author,
                c.category as category
            from ' . $this->table . ' q
            left join ' . $this->table2 . ' c on q.categoryId = c.id
            left join ' . $this->table3 . ' a on q.authorId = a.id
            limit :lim';
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Bind ID

            $stmt->bindParam(':lim', intval($this->lim, 10), \PDO::PARAM_INT);
            // execute
            $stmt->execute();

            return $stmt;        
        
        }  else {
            $query = 'select 
                q.id,
                q.quote,
                a.author as author,
                c.category as category
            from ' . $this->table . ' q
            left join ' . $this->table2 . ' c on q.categoryId = c.id
            left join ' . $this->table3 . ' a on q.authorId = a.id';
                
            $stmt = $this->conn->prepare($query);

            // execute
            $stmt->execute();

            return $stmt;
        }
        
    }

    //get single quote
    public function read_single(){
        $query = 'select 
            q.id,
            q.quote,
            a.author as author,
            c.category as category
        from ' . $this->table . ' q
        left join ' . $this->table2 . ' c on q.categoryId = c.id
        left join ' . $this->table3 . ' a on q.authorId = a.id
        where q.id = ?';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    // Bind ID
    $stmt->bindParam(1, $this->id);

    // execute
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->quote = $row['quote'];
    $this->author = $row['author'];
    $this->category = $row['category'];

    }
    public function create(){
        // Query
        $query = 'insert into ' .$this->table .'
            set 
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId';
        
        // Prepare
        $stmt = $this->conn->prepare($query);
    
        //Clean
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
    
        //Bind Data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
    
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
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId
            where id = :id';
        
        // Prepare
        $stmt = $this->conn->prepare($query);
    
        //Clean
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        //Bind Data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':categoryId', $this->categoryId);
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