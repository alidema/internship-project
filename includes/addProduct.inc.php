<?php require_once("dbh.php");  ?>
<?php require_once("functions.inc.php");  ?>
<?php require_once("sessions.php") ?>
<?php 
    $_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
    confirmLogin();
?>
<?php 
    if(isset($_POST["submit"])){
        $itemName = $_POST["item_name"];
        $itemIngridients = $_POST["item_ingridients"];
        $image = $_FILES["image"]["name"];
        $target = "uploads/".basename($_FILES["image"]["name"]);
        $itemPrice = $_POST["item_price"];
        $itemCategorie = $_POST["item_categorie"];
        $businessId = $_SESSION["userid"];

        if(empty($itemName) || empty($itemIngridients) || empty($image) || empty($itemPrice) || empty($itemCategorie)){
            $_SESSION["errorMessage"] = "Fill all fields";
            header("location: posts.php");
        }else{
            $sql = "INSERT INTO product (business_id, item_name, item_picture, item_ingridients, item_price, item_categorie)";
            $sql .= "VALUES (?, ?, ?, ?, ?,? )";
            if($stmt = mysqli_prepare($conn, $sql)){
                $stmt->bind_param("isssis", $business_id, $item_Name, $itemPicture, $item_Ingridients, $item_Price, $item_Categorie);
                
                $business_id = $businessId;
                $item_Name = $itemName;
                $itemPicture = $image;
                $item_Ingridients = $itemIngridients;
                $item_Price = $itemPrice;
                $item_Categorie = $itemCategorie;

                if($Execute = mysqli_stmt_execute($stmt)){
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
                    $_SESSION["successMessage"] = "Product added successfully";
                    header("location: ../add_food.php");
                }else{
                    $_SESSION["errorMessage"] = "Something went wrong. Try again!";
                    header("location: ../add_food.php");
                }
            }else{
                echo "Error Message";
            }
        }
    }
?>