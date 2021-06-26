<?php require_once("includes/dbh.php");  ?>
<?php 
    if(isset($_POST["submit"])){
        $itemName = $_POST["item_name"];
        $itemIngridients = $_POST["item_ingridients"];
        $image = $_FILES["image"]["name"];
        $target = "uploads/".basename($_FILES["image"]["name"]);
        $itemPrice = $_POST["item_price"];
        $itemCategorie = $_POST["item_categorie"];

        if(empty($itemName) ){
            echo "Field can't be empty";
        }
            $sql = "INSERT INTO product (business_id, item_name, item_picture, item_ingridients, item_price, item_categorie)";
            $sql .= "VALUES (?, ?, ?, ?, ?,? )";
            if($stmt = mysqli_prepare($conn, $sql)){
                $stmt->bind_param("isssis", $business_id, $item_Name, $itemPicture, $item_Ingridients, $item_Price, $item_Categorie);
                
                $business_id = 1;
                $item_Name = $itemName;
                $itemPicture = $image;
                $item_Ingridients = $itemIngridients;
                $item_Price = $itemPrice;
                $item_Categorie = $itemCategorie;
                $dateAdded = $dateTime;

                

                if($Execute = mysqli_stmt_execute($stmt)){
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
                    echo "Success";
                    header("location: add_food.php");
                    exit();
                }else{
                    echo "failed";
                }
            }else{
                echo "Error Message";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="item_name" id="item_name" placeholder="Item Name">
        <input type="text" name="item_ingridients" id="item_ingridients" placeholder="Item Ingridients">
        <input type="text" name="item_price" id="item_price" placeholder="Item Price">
        <select name="item_categorie" id="item_categorie">
            <option value="Salad">Salad</option>
            <option value="Pizza">Pizza</option>
            <option value="Pasta">Pasta</option>
            <option value="Meat">Meat</option>
        </select>
        <input class="custum-file-input" type="file" name="image" id="imageSelect">
        <button type="submit" name="submit" class="">Submit</button>
    </form>
</body>
</html>