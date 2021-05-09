<?php
class Quotes {
    //DB
    private $conn;
    private $table = 'quotes';

    //Quote Properties
    public $quote_id;
    public $category_id;
    public $author_id;
    public $quote;
    public $category_name;
    public $author_name;
    public $;

    //Constructor with DB

    public function __construct($db) {
        $this->conn = $db;
    }

    // get posts
    public function quotes(){
        $query = 'select 
            q.id as quote_id,
            q.quote,
            a.author,
            c.category
        from gic4xphvg8gbi3j6.quotes q
        left join gic4xphvg8gbi3j6.categories c on q.categoryId = c.id
        left join gic4xphvg8gbi3j6.authors a on q.authorId = a.id
                    '
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // execute
        $stmt->execute();

        return $stmt;
    }
}