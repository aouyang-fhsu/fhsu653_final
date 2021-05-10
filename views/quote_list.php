<?php
    // Headers
    include('views/header.php');
    
    // Get Author and Category data
    require('config/Database.php');
    require('model/Categories.php');
    require('model/Authors.php');

    // Instantiante DB & Connect
    $database = new Database();
    $db = $database->connect();
    
    // Instantiante Quote
    $category = new Categories($db);
    // Instantiante Quote
    $author = new Authors($db);
    // Categories query
    $result = $category->read();
    $cats = $result->fetchAll(); 
    
    // Author query
    $result1 = $author->read();
    $auths = $result1->fetchAll();
?>

<form  action="." method="GET", id ="Filter">
    <section id='dropmenus'>
        <select name='categoryId'>
            <option value="">View All Category</option>
            <?php foreach ($cats as $cat) : ?>
                <option value=<?php echo $cat['id']; ?>><?php echo $cat['category']; ?></option>
            <?php endforeach; ?>
        </select>

        <select name='authorId'>
            <option value="">View All Authors</option>
            <?php foreach ($auths as $auth) : ?>
                <option value=<?php echo $auth['id']; ?>><?php echo $auth['author']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Submit" class="button blue button-slim">
        <input id="resetVehicleListForm" type="reset" class="button red button-slim">
    </section>
</form>

