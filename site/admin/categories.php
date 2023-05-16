<?php
include 'adminInclude/dataBaseConnect.php';

if (isset($_POST['name'])) {
    if ($_GET['id']) {
        $sql = 'UPDATE categories SET name=?, url=?, numSort=? WHERE id=? LIMIT 1';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssii', $_POST['name'], $_POST['url'], $_POST['numSort'], $_GET['id']);
    } else {
        $sql = 'INSERT INTO categories (name,url,numSort) VALUES (?,?,?)';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssi', $_POST['name'], $_POST['url'], $_POST['numSort']);
    }

    $stmt->execute();
    $stmt->close();

    header('Location: /site/admin/categories.php');
} else {

    function printCategoryTable($parent = 0)
    {
        global $mysqli;

        if ($parent == 0) {
            $sql = 'SELECT id,name,url FROM categories WHERE parentCategory IS NULL ORDER BY numSort DESC';
        } else {
            $sql = 'SELECT id,name,url FROM categories WHERE parentCategory=? ORDER BY numSort DESC';
        }

        $stmt = $mysqli->prepare($sql);
        if ($parent) {
            $stmt->bind_param('i', $parent);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        while ($row = $res->fetch_assoc()) {
            echo <<<EOT
        <tr>
            <td>id: {$row['id']};</td>
            <td>name: {$row['name']};</td>
            <td>url: {$row['url']};</td>
            <td><a href="categories.php?id={$row['id']}">Edit</a></td>
            <td><a href="categories.php?id=0">Add</a></td>
            <td><a href="categories.php?deleteId={$row['id']}">Delete</a></td>
        </tr>        
EOT;
            printCategoryTable($row['id']);
        }
    }


    function printEditForm($id)
    {
        global $mysqli;

        $name  = '';
        $url = '';
        $numSort = '';
        if ($id) {
            $sql = 'SELECT name,url,numSort FROM categories WHERE id=?';
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->bind_result($name, $url, $numSort);
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
            <h2><?= $id ? 'Edit category ' . $id : 'Add category' ?></h2>
            <div class="editForm-field">
                <div class="editForm-field-label">
                    <label for="name">
                        Category name
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
            <div class="editForm-field">
                <div class="editForm-field-label">
                    <label for="url">
                        URL
                    </label>
                </div>
                <div class="editForm-field-input">
                    <select name="Parent category">
                        <optinon value="">root</optinon>
                        <?php
                        $sql = 'SELECT id,name FROM categories WHERE id<>?';
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param('i', $id);
                        $stmt->bind_result($resId, $resName);
                        $stmt->execute();
                        while ($stmt->fetch()) {
                            echo '<option value="', $resId, '">', $resName, '</option>';
                        }
                        $stmt->close();
                        ?>
                    </select>
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

        $sql = 'DELETE FROM categories WHERE id=? LIMIT 1';
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
        printCategoryTable();
        echo '</table>';
        echo '<div class="adminMainAdd"><a href="categories.php?id=0" class="adminMainAddButton">Add</a></div>';
    }
}
?>