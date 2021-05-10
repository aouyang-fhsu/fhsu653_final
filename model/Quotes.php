<?php
class Quote {
    //DB
    private $conn;
    private $table = 'quotes';
    private $table2 = 'categories';
    private $table3 = 'authors';

    //Quote Properties
    public $quote_id;
    public $category_id;
    public $author_id;
    public $quote;
    public $category;
    public $author;

    //Constructor with DB

    public function __construct($db) {
        $this->conn = $db;
    }

    // get posts
    public function read(){
        $query = 'select 
            q.id as quote_id,
            q.quote,
            a.author as author,
            c.category as category
        from ' . $this->table . ' q
        left join ' . $this->table2 . ' c on q.categoryId = c.id
        left join ' . $this->table3 . ' a on q.authorId = a.id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute
        $stmt->execute();

        return $stmt;
    }
}

?>