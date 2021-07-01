<?php require_once("includes/dbh.php");  ?>
<?php require_once("includes/addProduct.inc.php");  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/addProduct.css">
</head>
<body>
    <div class="header">
            <h2>Add new product</h2>
    </div>
    <div class="add-forme">
        <form id="add-form" action="includes/addProduct.inc.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <input class="input-form" type="text" name="item_name" placeholder="Item Name">
            </div>
            <div class="input-group">
                <input class="input-form" type="text" name="item_ingridients"  placeholder="Item Ingridients">
            </div>
            <div class="input-group">
                <input class="input-form" type="text" name="item_price" placeholder="Item Price">
            </div>
            <div class="input-group">
                <select class="input-form" name="item_categorie" >
                    <option value="Salad">Salad</option>
                    <option value="Pizza">Pizza</option>
                    <option value="Pasta">Pasta</option>
                    <option value="Meat">Meat</option>
                </select>
            </div>
            <div class="input-group">
                <input class="input-form" class="custum-file-input" type="file" name="image" >
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Submit</button>
            </div>
        </form>

        <li class="nav-item ">
                            <a class="nav-link text-danger" href="includes/logout.inc.php">
                                <i class="fas fa-user-times"></i>Logout</a>
        </li>
    </div>
</body>
</html>