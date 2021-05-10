<?php include('header.php') ?>
<nav>
    <form action="." method="get" id="make_selection">
        <section id="dropmenus" class="dropmenus">
            <?php if ($makes) { ?>
            <label>View All Authors</label>
            <select name="authors">
                <option value="0">View all Authors</option>
                <?php foreach ($makes as $make) : ?>
                    <?php if ($make['ID'] == $make_id) { ?>
                <option value="<?= $make['ID']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $make['ID']; ?>">
                    <?php } ?>                    
                    <?= $make['Make']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>


            <?php if ($types) { ?>
            <label>View all Categories</label>
            <select name="type_id">
                <option value="0">View all Categories</option>
                <?php foreach ($types as $type) : ?>
                    <?php if ($type['ID'] == $type_id) { ?>
                <option value="<?= $type['ID']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $type['ID']; ?>">
                    <?php } ?>                    
                    <?= $type['Type']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>

            <?php if ($classes) { ?>
            <label>Class:</label>
            <select name="class_id">
                <option value="0">View All Classes</option>
                <?php foreach ($classes as $class) : ?>
                <?php if ($class['ID'] == $class_id) { ?>
                <option value="<?= $class['ID']; ?>" selected>
                    <?php } else { ?>
                <option value="<?= $class['ID']; ?>">
                    <?php } ?>                    
                    <?= $class['Class']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <?php } ?>
        </section>
    </form>
</nav>
