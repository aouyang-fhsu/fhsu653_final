<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    include('views/header.php');
    include('views/quote_list.php');
    require('model/Quotes.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiante Quote
    $quote = new Quote($db);

    // Get Filter Parameters (Author and Category)
    $authorId = filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT);
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);

    if(!empty($authorId)){
        $quote->authorId = $authorId;
    }

    if(!empty($categoryId)){
        $quote->categoryId = $categoryId;
    }

    // Quotes Data
    $result = $quote->read();
    $result_quote = $result->fetchAll();  
?>
<body>
<?php if(!empty($result_quote)) { ?>
        <section>
            <table>
                <tr>
                    <th>Quote</th>
                    <th>Author</th>
                    <th>Category</th>
                </tr>
                <?php foreach ($result_quote as $result) : ?>
                <tr>
                    <td><?php echo $result['quote']; ?></td>
                    <td><?php echo $result['author']; ?></td>
                    <td><?php echo $result['category']; ?></td>
                    </form></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <section>                    
    <?php } else { ?>
        <p>No to do list items exist yet.</p>
    <?php } ?>    
</body>
