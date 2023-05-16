<?php
include 'adminInclude/dataBaseConnect.php';

if (isset($_POST['name'])) {
    if ($_GET['id']) {
        $sql = 'UPDATE products SET name=?, url=?, numSort=?, category=?, price=? WHERE id=? LIMIT 1';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssiiid', $_POST['name'], $_POST['url'], $_POST['numSort'], $_POST['category'], $_POST['price'], $_GET['id']);
    } else {
        $sql = 'INSERT INTO products (name,url,numSort,category,price) VALUES (?,?,?,?,?)';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssiid', $_POST['name'], $_POST['url'], $_POST['numSort'], $_POST['category'], $_POST['price']);
    }

    $stmt->execute();
    $stmt->close();

    header('Location: /site/admin/products.php');
} else {

    function printProductTable($parent = 0)
    {
        global $mysqli;

        $sql = 'SELECT id,name,url,category,price FROM products';


        $stmt = $mysqli->prepare($sql);

        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        // echo '<tr>';
        // $row = $res->fetch_assoc();
        // foreach ($row as $i => $b) {

        //     echo "<td>$i</td>";
        // }
        // echo '</tr>';


        while ($row = $res->fetch_assoc()) {
            $sql = 'SELECT name FROM categories WHERE id=?';
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $row['category']);
            $stmt->bind_result($tmpCat);
            $stmt->execute();
            $stmt->store_result();
            $stmt->fetch();

            echo <<<EOT
        <tr>
            <td>id: {$row['id']}</td>
            <td>name: {$row['name']}</td>
            <td>url: {$row['url']}</td>
            <td>category: {$tmpCat}</td>
            <td>price: {$row['price']}</td>
            <td><a href="products.php?id={$row['id']}">Edit</a></td>
            <td><a href="products.php?id=0">Add</a></td>
            <td><a href="products.php?deleteId={$row['id']}">Delete</a></td>
        </tr>
        
EOT;
        }
    }


    function printEditForm($id)
    {
        global $mysqli;

        $name  = '';
        $url = '';
        $numSort = '';
        $category = '';
        $price = NULL;

        if ($id) {
            $sql = 'SELECT name,url,numSort,category,price FROM products WHERE id=?';
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->bind_result($name, $url, $numSort, $category, $price);
            $stmt->execute();
            $stmt->store_result();
            $stmt->fetch();

            if ($stmt->num_rows() == 0) {
?>
                <h1>404</h1>
                <form action="categories.php" method="GET">
                    <input type="submit" value="Back" />
                </form>

        <?php
                return;
            }
        }

        ?>
        <form method="POST" action="">
            <h2><?= $id ? 'Edit product' . $id : 'Add product' ?></h2>
            <div class="editForm-field">
                <div class="editForm-field-label">
                    <label for="name">
                        Product name
                    </label>
                </div>
                <div class="editForm-field-input">
                    <input type="text" id="name" name="name" value="<?= $name; ?>" />
                </div>
            </div>
            <div class="editForm-field">
                <div class="editForm-field-label">
                    <label for="url">
                        URL
                    </label>
                </div>
                <div class="editForm-field-input">
                    <input type="text" id="url" name="url" value="<?= $url; ?>" />
                </div>
            </div>
            </div>
            <div class="editForm-field">
                <div class="editForm-field-label">
                    <label for="price">
                        Price
                    </label>
                </div>
                <div class="editForm-field-input">
                    <input type="text" id="price" name="price" value="<?= $price; ?>" />
                </div>
            </div>
            <div class="editForm-field">
                <div class="editForm-field-label">
                    <label for="category">
                        Parent category
                    </label>
                </div>
                <div class="editForm-field-input">
                    <input type="text" id="category" name="category" value="<?= $category; ?>" />
                </div>
            </div>
            <div class="editForm-field">
                <div class="editForm-field-label">
                    <label for="numSort">
                        Sort number
                    </label>
                </div>
                <div class="editForm-field-input">
                    <input type="text" id="numSort" name="numSort" value="<?= $numSort; ?>" />
                </div>
            </div>
            <input type="submit" value="<?= $id ? 'Edit' : 'Add' ?>" />
        </form>

<?php
    }


    function deleteCategory($id)
    {
        global $mysqli;

        $sql = 'DELETE FROM products WHERE id=? LIMIT 1';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }


    include 'adminInclude/pageStart.php';


    if (isset($_GET['deleteId'])) {
        deleteCategory($_GET['deleteId']);
    }
    if (isset($_GET['id'])) {
        printEditForm($_GET['id']);
    } else {
        echo '<table class="adminTable">';
        printProductTable();
        echo '</table>';
        echo '<a href="products.php?id=0" class="adminMainAddButton">Add</a>';
    }
}
